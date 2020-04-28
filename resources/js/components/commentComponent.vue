<template>
    <div class="main">
        <div style="height: 100vh" class="container-fluid banner__component px-0">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Thành Viên</th>
                        <th scope="col">Mã SP</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Lời Bình Luận</th>
                        <th scope="col">Times</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(cmt, index) in comments" :key="cmt.comment_id">
                        <th scope="row">{{cmt.comment_id}}</th>
                        <td>{{cmt.user_name}}</td>
                        <td>{{cmt.product_id}}</td>
                        <td :title="cmt.product_name">{{cmt.product_name.slice(0,15)+'. . .'}}</td>
                        <td>
                            <div style="width: 200px;overflow-x: auto; height:100px; overflow-y: auto">
                                {{cmt.comment_content}}
                            </div>
                        </td>
                        <td>{{cmt.created_at}}</td>
                        <td><button class="btn btn-danger" @click="deleteCmt(cmt.comment_id)">Xóa</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="component d-flex justify-content-center mt-5">
            <!--pagination using ajax -->
            <paginate v-if="pagination_cmt.current_page > 0"
                      :pageCount="pagination_cmt.last_page"
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
                      :clickHandler="clickCallback_cmt">
            </paginate>
        </div>
    </div>
</template>

<script>
    import Paginate from 'vuejs-paginate';
    import {RESOURCE} from '../api';
    export default {
        name: "comment-component",
        components:{
            Paginate
        },
        data(){
            return{
              comments:[],
              pagination_cmt:{}
            }
        },
        mounted(){
            this.fetchComments();

        },
        methods:{
            fetchComments(urlBase) {
                urlBase = urlBase || `${RESOURCE}/comments`;
                axios.get(urlBase)
                    .then(res => {
                        this.comments = res.data.data;
                        this.pagination_cmt = {
                            current_page: res.data.current_page,
                            last_page: res.data.last_page,
                            path_page: res.data.path,
                        };
                    })
                    .catch(err => console.log(err));
            },
            clickCallback_cmt(pageNum) {
                this.pagination_cmt.current_page = Number(pageNum);
                this.fetchComments(this.pagination_cmt.path_page + '?page=' + this.pagination_cmt.current_page);
            },
            deleteCmt(id){
                if(confirm('Bạn chắc xóa lời bình luận này chứ?')){
                    axios.delete(`${RESOURCE}/comments/${id}`)
                        .then(res => {
                            this.fetchComments();
                            console.log(res.data.message);
                        })
                }
            }
        }
    }
</script>

<style scoped>

</style>