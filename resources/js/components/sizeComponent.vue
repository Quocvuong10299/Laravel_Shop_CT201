<template>
    <div class="container">
       <div class="row">
           <div class="col-12 col-md-6 col-lg-6 col-xl-6">
               <table class="table">
                   <thead class="thead-dark">
                   <tr>
                       <th scope="col">Size</th>
                   </tr>
                   </thead>
                   <tbody>
                   <tr v-for="(sizes, index) in size" :key="index">
                       <th>{{sizes.size_value}}</th>
                   </tr>
                   </tbody>
               </table>
           </div>
           <div class="col-12 col-md-6 col-lg-6 col-xl-6">
               <div class="my-3 form-group">
                   <label for="size_type">Size</label>
                   <input v-model="type_size" type="text" id="size_type" class="form-control" placeholder="Size" required />
               </div>
               <div>
                   <button class="btn btn-success" @click="addSize()">Thêm</button>
               </div>
           </div>
       </div>
    </div>
</template>

<script>
    import {RESOURCE} from '../api';
    export default {
        name: "size-component",
        data(){
            return{
                size:[],
                type_size:'',
            }
        },
        mounted(){
            this.fetchSize();
        },
        methods:{
            fetchSize(){
                axios.get(RESOURCE + '/sizes')
                    .then(res => {
                        this.size = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            addSize(){
                axios.post(RESOURCE + '/sizes/add', {size: this.type_size})
                    .then(function (response) {
                        this.fetchSize();
                        // console.log(response.data);
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