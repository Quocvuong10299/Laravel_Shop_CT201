<template>
    <div class="main">
        <div style="height:400px;" class="container-fluid banner__component px-0 table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Mail</th>
                    <th scope="col">SDT</th>
                    <!--<th scope="col">Quyền</th>-->
                    <th scope="col">Ngày Tạo</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(user, index) in users" :key="index">
                    <th>{{user.user_id}}</th>
                    <td>{{user.user_name}}</td>
                    <td>{{user.user_email}}</td>
                    <td>{{user.user_phone}}</td>
                    <!--<td v-if="user.user_role === 0">Khách Hàng</td>-->
                    <!--<td v-else>Admin</td>-->
                    <td>{{user.created_at}}</td>
                    <td><button class="btn btn-danger" @click="deleteUser(user.user_id)">Xóa</button></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="component d-flex justify-content-center mt-5">
            <!--pagination using ajax -->
            <paginate v-if="pagination.current_page > 0"
                      :pageCount="pagination.last_page"
                      :containerClass="'pagination'"
                      :page-class="'page-item'"
                      :page-range="5"
                      :margin-pages="2"
                      :page-link-class="'page-link'"
                      :prev-class="'page-item'"
                      :prev-link-class="'page-link'"
                      :next-class="'page-item'"
                      :next-link-class="'page-link'"
                      :prev-text="'<'"
                      :next-text="'>'"
                      :first-last-button="false"
                      :clickHandler="clickCallback">
            </paginate>
        </div>
    </div>
</template>

<script>
    import Paginate from 'vuejs-paginate';
    import {RESOURCE} from '../api';
    export default {
        name: "users-component",
        components:{
            Paginate
        },
        data(){
            return{
                users:[],
                pagination: {},
            }
        },
        mounted(){
            this.fetchUsers();
        },
        computed:{

        },
        methods:{
            fetchUsers(urlBase) {
                urlBase = urlBase || `${RESOURCE}/users`;
                axios.get(urlBase)
                    .then(res => {
                        this.users =res.data.data;
                        this.pagination = {
                            current_page: res.data.current_page,
                            last_page: res.data.last_page,
                            path_page: res.data.path,
                        };
                    })
                    .catch(err => console.log(err));
            },
            clickCallback(pageNum) {
                this.pagination.current_page = Number(pageNum);
                this.fetchUsers(this.pagination.path_page + '?page=' + this.pagination.current_page);
            },
            deleteUser(id){
                if(confirm('Bạn chắc xóa người dùng này chứ?')){
                    axios.delete(`${RESOURCE}/users/${id}`)
                        .then(res => {
                            this.fetchUsers();
                            console.log(res.data.message);
                        })
                }
            }
        }
    }
</script>

<style scoped>

</style>