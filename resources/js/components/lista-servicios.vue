<template>
    <div>
        <div class="col">
            <button class="btn btn-success"  data-toggle="modal" data-target=".bd-example-modal-lg" v-on:click="nuevo">Agregar</button>
            <br><br>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nuevo servicio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form v-on:submit.prevent="enviar">
                                <img :src="codeQr.imagen" class="rounded mx-auto d-block" style="max-height: 200px"/>
                                <div class="form-group">
                                    <label class="col-form-label">Código:</label>
                                    <input type="text" class="form-control" v-validate="'required'" name="code" v-model="code" v-on:blur="generarQr(code)"/>
                                    <div class="text-danger" v-show="errors.has('code')">{{ errors.first('code') }}</div>
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
                            <button type="button" class="btn btn-primary" v-on:click="enviar">Guardar</button>
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
                :onClick="clickear"/>
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
            columns: [
                {
                    label: 'Name',
                    field: 'name',
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter This Thing', // placeholder for filter input
                    }
                },
                {
                    label: 'Age',
                    field: 'age',
                    type: 'number',
                },
                {
                    label: 'Created On',
                    field: 'createdAt',
                    type: 'date',
                    dateInputFormat: 'YYYY-MM-DD',
                    dateOutputFormat: 'MMM Do YY',
                },
                {
                    label: 'Percent',
                    field: 'score',
                    type: 'percentage',
                },
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
        methods:{
            clickear:function(row, index){
                console.log(row.name); //the object for the row that was clicked on
                console.log(index); // index of the row that was clicked on
            },
            nuevo:function(){
                this.generarQr();
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
            enviar:function(){
                this.$validator.validateAll().then((result) => {
                    if (result) {

                    } else {

                    }
                });
            }
        }

    }
</script>

<style scoped>

</style>