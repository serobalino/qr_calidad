<template>
    <div>
        <div class="col">
            <button class="btn btn-success" v-on:click="nuevo">Agregar</button>
            <br><br>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Servicio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form v-on:submit.prevent="enviar">
                                <img :src="codeQr.imagen" class="rounded mx-auto d-block" style="max-height: 200px"/>
                                <div class="form-group" v-if="nuev">
                                    <label class="col-form-label">Código:</label>
                                    <input type="text" class="form-control" v-validate="'required'" name="code" v-model="code" v-on:blur="generarQr(code)"/>
                                    <div class="text-danger" v-show="errors.has('code')">{{ errors.first('code') }}</div>
                                </div>
                                <div class="form-group" v-if="editado">
                                    <label class="col-form-label">Código:</label>
                                    <input type="text" class="form-control" v-model="code" readonly/>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Título:</label>
                                    <input type="text" class="form-control" v-validate="'required'" name="title" v-model="titulo"/>
                                    <div class="text-danger" v-show="errors.has('title')">{{ errors.first('title') }}</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Descripción:</label>
                                    <input type="text" class="form-control" v-model="descripcion"/>
                                </div>
                                <div class="form-group">
                                    <label  class="col-form-label">Categoria 1</label>
                                    <select class="form-control custom-select" v-validate="'required'" name="categoria1" v-model="cat1">
                                        <option v-for="item in listaCat1" :value="item.id">{{item.name}}</option>
                                    </select>
                                    <div class="text-danger" v-show="errors.has('categoria1')">{{ errors.first('categoria1') }}</div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-form-label">Categoria 2</label>
                                    <select class="form-control custom-select" v-validate="'required'" name="categoria2" v-model="cat2" >
                                        <option v-for="item in listaCat2" :value="item.id">{{item.name}}</option>
                                    </select>
                                    <div class="text-danger" v-show="errors.has('categoria2')">{{ errors.first('categoria2') }}</div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-form-label">Categoria 3</label>
                                    <select class="form-control custom-select" v-validate="'required'" name="categoria3" v-model="cat3">
                                        <option v-for="item in listaCat3" :value="item.id">{{item.name}}</option>
                                    </select>
                                    <div class="text-danger" v-show="errors.has('categoria3')">{{ errors.first('categoria3') }}</div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" v-if="nuev" v-on:click="enviar">Guardar</button>
                            <button type="button" class="btn btn-success" v-if="editado" v-on:click="enviarEditado">Actualizar</button>
                            <button type="button" class="btn btn-danger" v-if="editado" v-on:click="enviarEliminar">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <vue-good-table
                :columns="columns"
                :rows="rows"
                :paginate="true"
                :lineNumbers="true"
                @on-row-click="clickear"/>
    </div>
</template>

<script>
    import VueGoodTable from 'vue-good-table';
    import VeeValidate,{Validator} from 'vee-validate';
    import es from 'vee-validate/dist/locale/es';
    Validator.localize('es',es);
    Vue.use(VeeValidate);
    Vue.use(VueGoodTable);
    export default {
        name: "lista-servicios",
        data:()=>({
            nuev:true,
            editado:false,
            columns: [
                {
                    label: 'Código',
                    field: 'codigo_se',
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filtro de código', // placeholder for filter input
                    }
                },
                {
                    label: 'Servicio',
                    field: 'titulo_se',
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filtro de servicio', // placeholder for filter input
                    }
                },
                {
                    label: 'Calificaciones',
                    field: 'calificaciones_count',
                    type: 'number',
                }

            ],
            rows: [],
            descripcion:'',
            code:'',
            titulo:'',

            listaCat1:[],
            listaCat2:[],
            listaCat3:[],

            cat1:null,
            cat2:null,
            cat3:null,

            codeQr:[],
        }),
        watch:{
            cat1:function(val){
                if(val>0)
                    this.cargarC2()
            },
            cat2:function(val){
                if(val>0)
                    this.cargarC3()
            }
        },
        methods:{
            parse:function(objeto){
                return "<a href='"+objeto.ruta_se+"'/>"+objeto.codigo_se+"</a>";
            },
            clickear:function(row){
                this.nuev=false;
                this.editado=true;
                this.descripcion=row.row.descripcion_se;
                this.code=row.row.codigo_se;
                this.titulo=row.row.titulo_se;
                this.cat1=row.row.cat3.cat2.id_c1;
                this.cat2=row.row.cat3.cat2.id_c2;
                this.cat3=row.row.id_c3;
                this.generarQr(row.row.codigo_se);
                this.$validator.reset();
                $('.bd-example-modal-lg').modal('show');
            },
            nuevo:function(){
                this.nuev=true;
                this.editado=false;
                this.descripcion=null;
                this.titulo=null;
                this.cat1=null;
                this.cat2=null;
                this.cat3=null;
                this.generarQr();
                this.$validator.reset();
                $('.bd-example-modal-lg').modal('show');
            },
            generarQr:function(valor){
                axios.get(location.origin+'/api/servicio/codigo', {
                    params: {
                        q: valor,
                    },
                }).then((response) => {
                    this.codeQr=response.data;
                    this.code=response.data.codigo;
                });
            },
            cargarLista:function(){
                axios.options(location.origin+location.pathname)
                    .then((response) => {
                    this.rows=response.data;
                });
            },
            cargarC1:function(){
                axios.get(location.origin+'/api/lista/c1').then((response) => {
                    this.listaCat1=response.data;
                });
            },
            cargarC2:function(){
                axios.get(location.origin+'/api/lista/c2/'+this.cat1).then((response) => {
                    this.listaCat2=response.data;
                });
            },
            cargarC3:function(){
                axios.get(location.origin+'/api/lista/c3/'+this.cat2).then((response) => {
                    this.listaCat3=response.data;
                });
            },
            enviar:function(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post(location.origin+location.pathname,
                            {
                                'codigo'    :this.code,
                                'titulo'  :this.titulo,
                                'descripcion'   :this.descripcion,
                                'categoria' :this.cat3,
                            })
                            .then(response=>{
                                if(response.data.val){
                                    this.descripcion=null;
                                    this.titulo=null;
                                    this.cat1=null;
                                    this.cat2=null;
                                    this.cat3=null;
                                    this.cargarLista();
                                    this.generarQr();
                                    this.errors.clear();
                                    //$('.bd-example-modal-lg').modal('hide');
                                    toast({
                                        type: 'success',
                                        text: response.data.mensaje
                                    });
                                }else{
                                    swal({
                                        text:response.data.mensaje,
                                        type:'error'
                                    });
                                }
                            })
                            .catch((error) => {
                                toastr.error("Vuelva a intentar", "Error");
                            });
                    } else {
                        toast({
                            type: 'error',
                            title: 'Complete el formulario'
                        })
                    }
                });
            },
            enviarEditado:function(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.put(location.origin+location.pathname,
                            {
                                'codigo'    :this.code,
                                'titulo'  :this.titulo,
                                'descripcion'   :this.descripcion,
                                'categoria' :this.cat3,
                            })
                            .then(response=>{
                                if(response.data.val){
                                    this.cargarLista();
                                    $('.bd-example-modal-lg').modal('hide');
                                    toast({
                                        type: 'success',
                                        text: response.data.mensaje
                                    });
                                }else{
                                    swal({
                                        text:response.data.mensaje,
                                        type:'error'
                                    });
                                }
                            })
                            .catch((error) => {
                                toastr.error("Vuelva a intentar", "Error");
                            });
                    } else {
                        toast({
                            type: 'error',
                            title: 'Complete el formulario'
                        })
                    }
                });
            },
            enviarEliminar:function(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.delete(location.origin+location.pathname+'/'+this.code)
                            .then(response=>{
                                if(response.data.val){
                                    this.cargarLista();
                                    $('.bd-example-modal-lg').modal('hide');
                                    toast({
                                        type: 'success',
                                        text: response.data.mensaje
                                    });
                                }else{
                                    swal({
                                        text:response.data.mensaje,
                                        type:'error'
                                    });
                                }
                            })
                            .catch((error) => {
                                toastr.error("Vuelva a intentar", "Error");
                            });
                    } else {
                        toast({
                            type: 'error',
                            title: 'Complete el formulario'
                        })
                    }
                });
            }
        },
        mounted(){
            this.cargarC1();
            this.cargarLista();
        }

    }
</script>

<style scoped>

</style>