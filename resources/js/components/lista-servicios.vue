<template>
    <div>
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
            rows: [
                { id:1, name:"John", age: 20, createdAt: '201-10-31:9: 35 am',score: 0.03343 },
                { id:2, name:"Jane", age: 24, createdAt: '2011-10-31', score: 0.03343 },
                { id:3, name:"Susan", age: 16, createdAt: '2011-10-30', score: 0.03343 },
                { id:4, name:"Chris", age: 55, createdAt: '2011-10-11', score: 0.03343 },
                { id:5, name:"Dan", age: 40, createdAt: '2011-10-21', score: 0.03343 },
                { id:6, name:"John", age: 20, createdAt: '2011-10-31', score: 0.03343 },
            ],
        }),
        methods:{
            clickear:function(row, index){
                console.log(row.name); //the object for the row that was clicked on
                console.log(index); // index of the row that was clicked on
            }
        }

    }
</script>

<style scoped>

</style>