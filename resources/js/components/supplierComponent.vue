<template>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th>Nhà cung cấp</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(suppliers, index) in supplier" :key="index">
                        <th>{{suppliers.supplier_id}}</th>
                        <th>{{suppliers.supplier_name}}</th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="my-3 form-group">
                    <input type="hidden" disabled class="form-control" id="id_supplier" name="id_supplier" required />
                    <label for="supplier_name">Tên nhà cung cấp</label>
                    <input type="text"  v-model="name_sup" id="supplier_name" class="form-control" placeholder="Nhà cung cấp" required />
                </div>
                <div>
                    <button class="btn btn-success" @click="createSupplier()">Thêm</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {RESOURCE} from '../api';
    export default {
        name: "supplier-component",
        data(){
            return{
                supplier:[],
                name_sup:''
            }
        },
        mounted(){
            this.fetchSupplier();
        },
        methods:{
            fetchSupplier(){
                axios.get(RESOURCE + '/suppliers')
                    .then(res => {
                       this.supplier = res.data;
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            createSupplier(){
                axios.post(RESOURCE + '/suppliers/add', {name_supplier: this.name_sup})
                    .then(res => {
                        this.fetchSupplier();
                        this.name_sup='';
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        }
    }
</script>

<style scoped>

</style>