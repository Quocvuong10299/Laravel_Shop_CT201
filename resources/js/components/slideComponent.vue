<template>
    <div>
        <div class="main">
            <div class="row w-100 mx-0">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white px-0 mx-0 d-flex justify-content-end">
                    <button class="btn btn-success my-1 mr-2" @click="add = true">Tạo Slide</button>
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
                        <td><img style="width:400px; height:200px" :src="'/storage/uploads/'+ slides.slide_link"/></td>
                        <td><button class="btn btn-warning" @click="see = true; setValSlide(slides.slide_id, slides.slide_show)">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button></td>
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
        <div class="edit_slide" v-if="see" :class="{edit_slide_show : see}">
            <div class="form_edit_slide">
                <h1>Edit The Slide</h1>
                <form @submit.prevent="">
                    <input type="hidden" disabled class="form-control" id="slide_id" name="slide_id" required :value="this.slide_id">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="slide_show">Ẩn / Hiện</label>
                            <select class="form-control" id="slide_show" name="slide_show">
                                <option :value="this.slide_show" disabled selected>{{(this.slide_show === 1) ? 'Hiện' : 'Ẩn'}}</option>
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" @click="see = false" class="btn bg-light">Hủy</button>
                    <button type="submit" class="btn btn-success" @click="editSlide()">Lưu</button>
                </form>
            </div>
            <div class="overlay_form"></div>
        </div>
        <!--add slide-->
        <div class="add_slide" v-if="add" :class="{add_slide_show : add}">
            <div class="form_add_slide">
                    <h1>Add The Slide</h1>
                    <div class="row justify-content-center w-100">
                        <div class="col-md-8">
                            <div class="card card-default">
                                <div class="card-header">File Upload Slide</div>
                                <div class="card-body">
                                    <div class="row w-100">
                                        <div class="col-12 col-md-12 my-3" v-if="">
                                            <img :src="image" class="img-responsive" height="70" width="90">
                                        </div>
                                        <div class="col-12 col-md-12 my-3">
                                            <input type="file" v-on:change="onImageChange" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-12 my-3 d-flex">
                                            <button @click="add = false" class="mr-2 btn bg-light">Hủy</button>
                                            <button class="btn btn-success btn-block" @click="uploadImage()">Upload Slide</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="overlay_form"></div>
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
                see:false,
                add:false,
                image: null,
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
            setValSlide(slide_id, slide_show) {
                this.slide_id = slide_id;
                this.slide_show = slide_show;
            },
            editSlide(){
                let id_show = document.getElementById('slide_id').value;
                let is_show = document.getElementById('slide_show').value;
                axios.post(RESOURCE + '/slides/edit/' + id_show, {val_show: is_show})
                    .then(res => {
                        this.fetchSlide();
                        this.see=false
                    });
            },
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            uploadImage(){
                axios.post(RESOURCE + '/slides/add',{image: this.image})
                    .then(response => {
                        this.fetchSlide();
                        // this.add=false
                    // console.log(response.data);
                });
            }
        }
    }
</script>

<style lang="scss">
    .edit_slide,.add_slide{
        visibility: hidden;
        opacity: 0;
    }
    .edit_slide_show,.add_slide_show{
        visibility: inherit;
        opacity: 1;
    }
    .form_edit_slide,.form_add_slide{
        position:absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
        z-index: 999;
        background: #fff;
        padding:20px;
        border-radius: 5px;
    }
</style>
