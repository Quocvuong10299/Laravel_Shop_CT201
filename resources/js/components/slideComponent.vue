<template>
    <div>
        <div class="main">
            <div class="row w-100 mx-0">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white px-0 mx-0 d-flex justify-content-end">
                    <button class="btn btn-success my-1 mr-2">Tạo Slide</button>
                </div>
            </div>
            <div style="height:400px;" class="container-fluid banner__component px-0 table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Slide Image</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(slides, index) in slide" :key="index">
                        <th>{{slides.slide_id}}</th>
                        <td><img style="width:400px; height:200px" :src="'/frontend/images/'+ slides.slide_link"/></td>
                        <td><button class="btn btn-warning">Sửa</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="component d-flex justify-content-center mt-5">
                <!--pagination using ajax -->
                <paginate v-if="pagination_slide.current_page > 0"
                          :pageCount="pagination_slide.last_page"
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
                          :clickHandler="clickCallback_slide">
                </paginate>
            </div>
        </div>
    </div>
</template>

<script>
    import Paginate from 'vuejs-paginate';
    import {RESOURCE} from '../api';
    export default {
        name: "slide-component",
        components:{
            Paginate
        },
        data(){
            return{
                slide:[],
                pagination_slide:{},
            }
        },
        mounted(){
            this.fetchSlide();
        },
        methods:{
            fetchSlide(urlBase_slide) {
                urlBase_slide = urlBase_slide || `${RESOURCE}/slides`;
                axios.get(urlBase_slide)
                    .then(res => {
                        this.slide = res.data.data;
                        this.pagination_slide = {
                            current_page: res.data.current_page,
                            last_page: res.data.last_page,
                            path_page: res.data.path,
                        };
                    })
                    .catch(err => console.log(err));
            },
            clickCallback_slide(pageNum) {
                this.pagination_slide.current_page = Number(pageNum);
                this.fetchSlide(this.pagination_slide.path_page + '?page=' + this.pagination_slide.current_page);
            },
        }
    }
</script>

<style scoped>

</style>