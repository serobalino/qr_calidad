<template>
    <div>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Búsqueda de servicios</h1>
            <p class="lead">Completa la siguiente información:</p>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Código o nombre del servicio" v-model="buscar" v-on:keyup.enter="enviar"/>
                <div class="input-group-append">
                    <button class="btn btn-outline-info" type="button" v-on:click="enviar">Buscar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group">
        <a :href="item.page_se" class="list-group-item flex-column align-items-start" v-for="item in lista" v-if="lista.length">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{item.codigo_se}}</h5>
            </div>
            <p class="mb-1">{{item.titulo_se}}</p>
        </a>
        <a href="#" class="list-group-item flex-column align-items-start list-group-item-danger"  v-if="!lista.length && buscado">
            <div class="d-flex w-100 text-center">
                <h5 class="mb-1">No existen datos</h5>
            </div>
        </a>
    </div>
    </div>
</template>

<script>
    export default {
        name: "consulta-servicio",
        data:()=>({
            buscar:'',
            lista:[],
            buscado:false
        }),
        methods:{
            enviar:function(){
                if(this.buscar.length>=3){
                    axios.post(location.origin+location.pathname,
                        {
                            'q'    :this.buscar,
                        })
                        .then(response=>{
                            this.lista=response.data;
                        });
                    this.buscado=true;
                }else{
                    toast({
                        type: 'error',
                        text: 'Ingrese un código válido'
                    });
                }
            },
            consulta:function(){
                axios.options(location.origin+location.pathname)
                    .then(response=>{
                        this.lista=response.data;
                    });
            }
        },
        mounted(){
            this.consulta();
        }
    }
</script>

<style scoped>

</style>