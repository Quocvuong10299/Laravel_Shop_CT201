<template>
    <div class="main position-relative">
        <!--add category-->
        <div class="row w-100 mx-0">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white px-0 mx-0 d-flex justify-content-end">
                <button class="btn btn-success my-1 mr-2" @click="isAdd = true">Thêm mới</button>
            </div>
        </div>
        <!--show category data-->
        <div style="height:400px;" class="container-fluid banner__component px-0">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Loại Sản Phẩm</th>
                        <th scope="col">Dành cho</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(cat, index) in categories" :key="index">
                        <th scope="row">{{cat.category_id}}</th>
                        <td>{{cat.category_name}}</td>
                        <td>{{(cat.category_gender_id === 1) ? 'Nam' : 'Nữ'}}</td>
                        <td>
                            <!--<button class="btn btn-warning">Ẩn</button>-->
                            <button @click="isShow = true; setVal(cat.category_id, cat.category_name, cat.parent_id, cat.category_gender_id, cat.category_show)" class="btn bg-warning" >
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--pagination-->
        <div class="component d-flex justify-content-center mt-5">
            <!--pagination using ajax -->
            <paginate v-if="pagination_cat.current_page > 0"
                      :pageCount="pagination_cat.last_page"
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
                      :clickHandler="clickCallback_cat">
            </paginate>
        </div>
        <!--edit component-->
        <div class="edit_cat" v-if="isShow" :class="{show_edit : isShow}">
            <div class="form_edit">
                <h1>Edit The Category</h1>
                <form @submit.prevent="editCategory">
                    <input type="hidden" disabled class="form-control" id="cat_id" name="id" required :value="this.cat_id">
                    <div class="form-group">
                        <label for="cat_name">Tên Loại</label>
                        <input @keydown.enter.prevent="editCategory" type="text" class="form-control" id="cat_name" :value="this.cat_name" placeholder="Name" required />
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="cat_item">Danh mục</label>
                            <select class="form-control" id="cat_item" name="cat_item">
                                <option :value="this.cat_gender" disabled selected> Chọn Danh Mục </option>
                                <option v-for="cat_parents in category_parent" :value="cat_parents.category_id">{{cat_parents.category_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="cat_gender">Giới tính</label>
                            <select class="form-control" id="cat_gender" name="cat_gender">
                                <option :value="this.cat_gender" disabled selected>{{(this.cat_gender === 1) ? 'Nam' : 'Nữ'}}</option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="cat_show">Ẩn / Hiện</label>
                            <select class="form-control" id="cat_show" name="cat_show">
                                <option :value="this.cat_show" disabled selected>{{(this.cat_show === 1) ? 'Hiện' : 'Ẩn'}}</option>
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <button @click="isShow = false" class="btn bg-light">Hủy</button>
                    <button type="submit" class="btn btn-success" @click="editCategory()">Lưu</button>
                </form>
            </div>
            <div class="overlay_form"></div>
        </div>
        <!--add category component-->
        <div class="show_cat" v-if="isAdd" :class="{show_cat_active : isAdd}">
            <div class="form_add">
                <h1>Add The Category</h1>
                    <input type="hidden" disabled class="form-control" id="id_add" name="id_add" required />
                    <div class="form-group">
                        <label for="name_add">Tên Loại</label>
                        <input v-model="newCat.name" type="text" class="form-control" id="name_add" placeholder="Name" required />
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="item_add">Danh mục</label>
                            <select v-model="newCat.items" class="form-control" id="item_add" name="item_add">
                                <option disabled selected> Chọn Danh Mục </option>
                                <option v-for="cat_parents in category_parent" :value="cat_parents.category_id">{{cat_parents.category_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="gender_add">Giới tính</label>
                            <select v-model="newCat.gender" class="form-control" id="gender_add" name="gender_add">
                                <option>Chọn giới tính</option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="show_add">Ẩn / Hiện</label>
                            <select v-model="newCat.show" class="form-control" id="show_add" name="show_add">
                                <option>Chọn trạng thái</option>
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-light" @click="isAdd = false">Hủy</button>
                    <button type="submit" class="btn btn-success" @click.prevent="createCategory()">Tạo</button>
            </div>
            <div class="overlay_form"></div>
        </div>
    </div>
</template>

<script>
    import Paginate from 'vuejs-paginate';
    import {RESOURCE} from '../api';
    import editCategoryComponent from './editCategoryComponent';
    export default {
        name: "category-component",
        components:{
            Paginate,
            editCategoryComponent
        },
        data(){
          return{
              categories:[],
              category_parent:[],
              pagination_cat:{},
              isShow:false,
              isAdd:false,
              newCat:{
                  name: '',
                  items: '',
                  gender: '',
                  show: 1
              }
          }
        },
        mounted(){
            this.fetchCategories();
        },
        computed:{

        },
        methods:{
            //fetch API
            fetchCategories(url_cat){
                url_cat = url_cat || `${RESOURCE}/category`;
                axios.get(url_cat)
                    .then(res => {
                        this.categories = res.data.category.data;
                        this.category_parent = res.data.category_parent;
                        this.pagination_cat = {
                            current_page: res.data.category.current_page,
                            last_page: res.data.category.last_page,
                            path_page: res.data.category.path,
                        };
                    })
                    .catch(err => console.log(err));
            },
            //CallBack Pagination
            clickCallback_cat(pageNum) {
                this.pagination_cat.current_page = Number(pageNum);
                this.fetchCategories(this.pagination_cat.path_page + '?page=' + this.pagination_cat.current_page);
            },
            //SetValue POST Request Update
            setVal(val_id, val_name, val_item, val_gender, val_show) {
                this.cat_id = val_id;
                this.cat_name = val_name;
                this.cat_item = val_item;
                this.cat_gender = val_gender;
                this.cat_show= val_show;
            },
            //Edit CATEGORY
            editCategory(){
                let id_cat = document.getElementById('cat_id').value;
                let name_cat = document.getElementById('cat_name').value;
                let item_cat = document.getElementById('cat_item').value;
                let gender_cat = document.getElementById('cat_gender').value;
                let show_cat = document.getElementById('cat_show').value;
                    axios.post(RESOURCE + '/category/edit/' + id_cat, {val_1: name_cat, val_2: item_cat,val_3: gender_cat,val_4: show_cat })
                        .then(res => {
                            this.fetchCategories();
                            this.isShow=false
                        });

            },
            //Create CATEGORY
            createCategory(){
                axios.post(RESOURCE + '/category/add', {name: this.newCat.name, items: this.newCat.items, gender: this.newCat.gender, show: this.newCat.show})
                    .then( res => {
                        this.fetchCategories();
                        this.isAdd = false;
                    });
            }
        }
    }
</script>

<style lang="scss">
    .overlay_form{
        width: 100%;
        height: 100vh;
        background: rgba(0,0,0,0.3);
        position:absolute;
        z-index:99;
        top:0;
        left:0;
    }
    .form_edit,.form_add{
        position:absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
        z-index: 999;
        background: #fff;
        padding:20px;
        border-radius: 5px;
        /*height: 300px;*/
        /*overflow-y: auto;*/
    }
    .edit_cat, .show_cat{
       visibility: hidden;
        opacity: 0;
    }
    .show_edit{
        visibility: inherit;
        opacity: 1;
    }
    .show_cat_active{
        visibility: inherit!important;
        opacity: 1!important;
    }
    #close{
        position: absolute;
        top:10px;
        right: 10px;
        cursor:pointer;
    }
</style>
