<template>
    <div class="main position-relative">
        <div class="row w-100 mx-0">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white px-0 mx-0 d-flex justify-content-end">
                <button class="btn btn-success my-1 mr-2">Thêm mới</button>
            </div>
        </div>
        <!--show category data-->
        <div style="height:400px;" class="container-fluid banner__component px-0">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên SP</th>
                        <th scope="col">Loại SP</th>
                        <th scope="col">Dành cho</th>
                        <th scope="col">Thương hiệu</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(pro, index) in products" :key="pro.product_id">
                        <th scope="row">{{pro.product_id}}</th>
                        <td>{{pro.product_name}}</td>
                        <td>{{pro.category_name}}</td>
                        <td>{{pro.category_gender_name}}</td>
                        <td>{{pro.supplier_name}}</td>
                        <td :class="(pro.product_active === 1) ? 'text-success' : 'text-danger'">{{(pro.product_active === 1) ? 'còn hàng' : 'hết hàng'}}</td>
                        <td>
                            <button class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            <button
                                    @click="showProduct = true;
                                    setValPro(
                                     pro.product_id,
                                     pro.product_name,
                                     pro.category_name,
                                     pro.category_id,
                                     pro.category_gender_id,
                                     pro.supplier_id,
                                     pro.supplier_name,
                                     pro.product_image,
                                     pro.product_description,
                                     pro.product_active,
                                     pro.product_new,
                                     product_show
                                       )"
                                    class="btn btn-warning">
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
            <paginate v-if="pagination_pro.current_page > 0"
                      :pageCount="pagination_pro.last_page"
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
                      :clickHandler="clickCallback_pro">
            </paginate>
        </div>
        <!--edit product-->
        <div class="edit_pro" v-if="showProduct" :class="{show_edit_pro: showProduct}">
            <div class="form_edit_pro">
                <h1>Edit The Product</h1>
                <form @submit.prevent="">
                    <input type="hidden" disabled class="form-control" id="pro_id" name="id" required>
                    <div class="form-group">
                        <label for="pro_name">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" id="pro_name" placeholder="Name" required />
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="cat_item">Danh mục</label>
                            <select class="form-control" id="cat_item" name="cat_item">
                                <option value="" disabled selected> Chọn Danh Mục </option>
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="cat_gender">Dành cho</label>
                            <select class="form-control" id="cat_gender" name="cat_gender">
                                <option value="" disabled selected></option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Thương hiệu</label>
                            <select class="form-control" id="" name="cat_gender">
                                <option value="" disabled selected></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Tồn kho</label>
                            <select class="form-control" name="cat_gender">
                                <option value="" disabled selected></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">SP mới</label>
                            <select class="form-control" name="cat_gender">
                                <option value="" disabled selected></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="cat_show">Ẩn / Hiện</label>
                            <select class="form-control" id="cat_show" name="cat_show">
                                <option value="" disabled selected></option>
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-light" @click="showProduct = false">Hủy</button>
                    <button type="submit" class="btn btn-success">Lưu</button>
                </form>
            </div>
            <div class="overlay_form"></div>
        </div>
    </div>
</template>

<script>
    import Paginate from 'vuejs-paginate';
    import {RESOURCE} from '../api';
    export default {
        name: "products-component",
        components:{
            Paginate,
        },
        data(){
            return{
                products:[],
                category:[],
                gender:[],
                pagination_pro:{},
                showProduct:false
            }
        },
        mounted(){
          this.fetchProducts();
        },
        methods:{
            fetchProducts(url_pro){
                url_pro = url_pro || `${RESOURCE}/products`;
                axios.get(url_pro)
                    .then(res => {
                        this.products = res.data.products.data;
                        this.category = res.data.category;
                        this.gender = res.data.gender;
                        this.pagination_pro = {
                            current_page: res.data.products.current_page,
                            last_page: res.data.products.last_page,
                            path_page: res.data.products.path,
                        };
                    })
                    .catch(err => console.log(err));
            },
            // CallBack Pagination
            clickCallback_pro(pageNum) {
                this.pagination_pro.current_page = Number(pageNum);
                this.fetchProducts(this.pagination_pro.path_page + '?page=' + this.pagination_pro.current_page);
            },

            setValPro(val_id, val_name, val_item, val_gender, val_show) {
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
                if(confirm('Bạn chắc chứ?')){
                    axios.post(RESOURCE + '/category/edit/' + id_cat, {val_1: name_cat, val_2: item_cat,val_3: gender_cat,val_4: show_cat })
                        .then(res => {
                            this.fetchCategories();
                            this.isShow=false
                        });
                }

            },
        }
    }
</script>

<style lang="scss">
    .edit_pro{
        width:100%;
        visibility: hidden;
        opacity: 0;
    }
    .form_edit_pro{
        position:absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
        z-index: 999;
        background: #fff;
        padding:20px;
        border-radius: 5px;
        width: 100%;
    }
    .show_edit_pro{
        visibility: inherit;
        opacity: 1;
    }
</style>