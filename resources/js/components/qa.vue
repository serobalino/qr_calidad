<template>
    <div v-if="ya===false">
        <div class="options">
          <span class="reactions">
            <div class="icon-container">
              <span data-popup="Me gusta" class="gusta reaction" v-on:click="reaccion=1"></span>
            </div>
            <div class="icon-container">
              <span data-popup="Me encanta" class="love reaction" v-on:click="reaccion=2"></span>
            </div>
            <div class="icon-container">
              <span data-popup="Me enorgullece" class="thankful reaction" v-on:click="reaccion=3"></span>
            </div>
            <div class="icon-container">
              <span data-popup="Me asombra" class="haha reaction" v-on:click="reaccion=4"></span>
            </div>
            <div class="icon-container">
              <span data-popup="Me divierte" class="wow reaction" v-on:click="reaccion=5"></span>
            </div>
            <div class="icon-container">
              <span data-popup="Me entristece" class="sad reaction" v-on:click="reaccion=6"></span>
            </div>
            <div class="icon-container">
              <span data-popup="Me enoja" class="angry reaction" v-on:click="reaccion=7"></span>
            </div>
          </span>
            <span class="button"> Me gusta</span>
        </div>
        <div class="form-group">
            <textarea class="form-control"  rows="5" placeholder="Que opinas de este servicio" v-model="comentario"></textarea>
        </div>
        <button type="button" class="btn btn-primary" v-on:click="enviar">Enviar</button>
    </div>
    <div v-else>
        <div class="alert alert-success" role="alert">
            <p class="mb-0">Gracias por ayudarnos a mejorar nuetros servicios</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "qa",
        data:()=>({
            comentario:'',
            reaccion:null,
            ya:false,
        }),
        watch:{

        },
        methods:{
            enviar:function(){
                if(this.reaccion>0){
                    axios.post(location.origin+location.pathname,
                        {
                            'reaacion'  :this.reaccion,
                            'comentario':this.comentario,
                        })
                        .then(response=>{
                            if(response.data.val){
                                this.ya=true;
                            }else{
                                toast({
                                    type: 'error',
                                    text: 'Ha ocurrido un erro vuelva a intentar'
                                });
                            }
                        });

                }else{
                    toast({
                        type: 'error',
                        text: 'Debe elegir una reacción'
                    });
                }
            },
            montarReacciones:function(){
                var animateReactionsOn;
                var animateReactionsOut;

                $(function () {
                    $(".options").mouseenter(function () {
                        var parent = $(this)

                        animateReactionsOn = setTimeout(function () {
                            parent.find(".reaction").each(function (index) {
                                var element = $(this);
                                setTimeout(function () {
                                    element.addClass("is-visible");
                                }, index * 60);
                            });
                        }, 500);

                        clearTimeout(animateReactionsOut);
                    });

                    $(".options").mouseleave(function () {
                        var parent = $(this)

                        animateReactionsOut = setTimeout(function () {
                            parent.removeClass("active");
                            parent.find(".reaction").removeClass("is-visible");
                        }, 500);

                        clearTimeout(animateReactionsOn);
                    });
                    var dataPopupOld = null;
                    var dataPopupNew = null;

                    $(".options .button").click(function () {
                        var children = $(this)
                        var parent = $(this).parent()

                        if ($(this).parent().is(".gusta, .encanta, .enorgullece, .asombra, .divierte, .entristece, .enoja")) {
                            parent.removeClass("Me gusta encanta enorgullece asombra divierte entristece enoja");
                            parent.addClass("default");
                            parent.find(".button").text("Me gusta");
                        } else {
                            parent.addClass("Me gusta");
                        }

                        if ($(this).parent().hasClass("default")) {
                            $(this).addClass("Me gusta");
                        }
                    });


                    $(".reaction").click(function () {
                        dataPopupNew = $(this).attr("data-popup");

                        $(".options").removeClass("default");

                        $(".options .button").text(dataPopupNew);

                        $('.options:contains(gusta)').css('color', 'rgb(88, 144, 255)');
                        $('.options:contains(encanta)').css('color', 'rgb(242, 82, 104)');
                        $('.options:contains(enorgullece)').css('color', 'rgb(157, 135, 210)');
                        $('.options:contains(asombra), .options:contains(divierte), .options:contains(entristece)').css('color', 'rgb(240, 186, 21)');
                        $('.options:contains(enoja)').css('color', 'rgb(247, 113, 75)');

                        $(".options").removeClass(dataPopupOld);
                        $(".options").addClass(dataPopupNew);

                        dataPopupOld = dataPopupNew
                    });
                });
            }
        },
        mounted(){
            this.montarReacciones();
        }
    }
</script>

<style lang="sass">


        .options
            background: white
            width: 150px
            box-shadow: 0 0 0 1px rgba(0, 0, 0, .08), 0 2px 2px rgba(0, 0, 0, .15)
            border-radius: 20px
            padding: 10px 13px
            margin-bottom: 15px
            font:
                size: 0
                family: Helvetica
                weight: bold
            color: #7f7f7f
            position: relative
            cursor: pointer
            text-align: center

            .button
                font-size: 12px
                vertical-align: middle

            &::before
                content: ''
                display: inline-block
                vertical-align: middle
                height: 16px
                width: 16px
                margin-right: 4px
                background:
                    image: url(https://static.xx.fbcdn.net/rsrc.php/v3/y3/r/GLfzuZS5ZZ5.png)
                    size: auto
                    position: 0 -892px

                .reactions
                    opacity: 1
                    transition: .1s .5s

            .reactions
                .icon-container
                    &:hover
                        transform: scale(1.3, 1.3) translateY(-5px)

            &:hover
                .reactions
                    opacity: 1

            &.default
                color: #7f7f7f !important

                &::before
                    background:
                        position: 0 -893px

            &.gusta
                color: rgb(88, 144, 255)

                &::before
                    background:
                        position: 0 -922px

            &.encanta
                &::before
                    background:
                        position: 0 -710px

            &.enorgullece
                &::before
                    background:
                        position: 0 -642px

            &.asombra
                &::before
                    background:
                        position: 0 -795px

            &.divierte
                &::before
                    background:
                        position: 0 -676px


            &.entristece
                &::before
                    background:
                        position: 0 -744px

            &.enoja
                &::before
                    background:
                        position: 0 -608px

            .reactions
                position: absolute
                bottom: 130%
                left: 50%
                transform: translateX(-50%)
                border-radius: 50px
                background: white
                box-shadow: 0 0 0 1px rgba(0, 0, 0, .08), 0 2px 2px rgba(0, 0, 0, .15)
                line-height: 0
                white-space: nowrap
                opacity: 0
                padding: 3px
                pointer-events: none
                transition: .2s .5s

                .icon-container
                    display: inline-block
                    transition: transform .2s ease

                .reaction
                    display: inline-block
                    height: 48px
                    width: 48px
                    transform: perspective(1px) scale(.8, .8) translate(0, 0)
                    transition: transform 0s .7s ease, opacity 0s .7s ease
                    line-height: initial
                    opacity: 0
                    border-radius: 100%
                    background:
                        image: url(https://assets.medinnna.com/facebook-reactions.gif)
                        repeat: no-repeat
                        size: auto

                    &.is-visible
                        transition: opacity .3s ease
                        opacity: 1
                        pointer-events: all
                        animation: testes .6s ease forwards

                        @keyframes testes
                            0%
                                transform: perspective(1px) scale(.8, .8) translate(0, 70px)
                            30%
                                transform: perspective(1px) scale(.87, .87) translate(0, -4px)
                            70%
                                transform: perspective(1px) scale(.8, .8) translate(0, 1px)
                            100%
                                transform: perspective(1px) scale(.8, .8) translate(0, 0)

                        &:hover
                            transform: perspective(1px) scale(1, 1) translate(0, -5px)

                            &::after
                                opacity: 1

                    &::after
                        content: attr(data-popup)
                        position: absolute
                        background: rgba(0, 0, 0, .7)
                        border-radius: 15px
                        color: white
                        font:
                            family: helvetica
                            weight: bold
                            size: 13px
                        padding: 2px 7px
                        top: -25px
                        left: 50%
                        transform: translateX(-50%)
                        white-space: nowrap
                        opacity: 0
                        transition: opacity .07s ease

                    &.gusta
                        background:
                            position: 0 0

                    &.love
                        background:
                            position: -52px 0

                    &.thankful
                        background:
                            position: -314px 0

                    &.haha
                        background:
                            position: -104px 0

                    &.wow
                        background:
                            position: -156px 0

                    &.sad
                        background:
                            position: -208px 0

                    &.angry
                        background:
                            position: -260px 0
</style>