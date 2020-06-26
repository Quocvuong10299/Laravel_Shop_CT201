<template>
    <div class="main position-relative">
        <div class="row w-100 mx-0">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white px-0 mx-0 d-flex justify-content-end">
                <button class="btn btn-success my-1 mr-2" @click="priceAdd = true">Thêm mới</button>
            </div>
        </div>
        <div style="height:400px;" class="container-fluid banner__component px-0">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Ngày Khuyến Mãi</th>
                        <th scope="col">% Giảm</th>
                        <th scope="col">Sản Phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Sản Phẩm</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(prices, index) in price" :key="index">
                        <th v-if="prices.date_id == 1" scope="row">Không</th>
                        <th v-else="" scope="row">{{prices.date_start}} đến {{prices.date_end}}</th>
                        <td>{{prices.percent_value}}%</td>
                        <td>{{prices.product_name}}</td>
                        <td>{{prices.unit_price}}</td>
                        <td>
                            <!--<button class="btn btn-warning">Ẩn</button>-->
                            <button @click.prevent="priceEdit = true;setPrice(prices.product_id, prices.percent_value, prices.unit_price, prices.date_id,prices.product_name)" class="btn bg-warning" >Sửa</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="component d-flex justify-content-center mt-5">
<!--            pagination using ajax-->
            <paginate v-if="pagination_price.current_page > 0"
                      :pageCount="pagination_price.last_page"
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
                      :clickHandler="clickCallback_price">
            </paginate>
        </div>

<!--        add-->
        <div class="add_price" v-if="priceAdd" :class="{show_addPrice : priceAdd}">
            <div class="form_edit">
                <h1>Add Price</h1>
                <form>
                    <input type="hidden" disabled class="form-control" required>
                    <div class="form-group">
                        <label for="">Chương trình KM</label>
                        <select v-model="newPrice.date_id" class="form-control" name="">
                            <option v-for="(date_id, index) in dateID" :value="date_id.date_id">
                                {{date_id.date_id}}-
                                <span>(từ {{date_id.date_start}} đến {{date_id.date_end}})</span>
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">% Giam Gia</label>
                            <select v-model="newPrice.percent_sale" class="form-control" name="">
<!--                                <option disabled selected>0</option>-->
                                <option v-for="(percents, index) in percent" :value="percents.percent_value">
                                    {{percents.percent_value}}%
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Sản Phẩm</label>
                            <select v-model="newPrice.productID" class="form-control" name="">
                                <option v-for="(pro, index) in products" :value="pro.product_id">
                                    {{pro.product_name}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Giá</label>
                           <input type="number" v-model="newPrice.unitPrice">
                        </div>
                    </div>
                    <button @click="priceAdd = false" class="btn bg-light">Hủy</button>
                    <button type="submit" class="btn btn-success" @click.prevent="createPrice()">Lưu</button>
                </form>
            </div>
            <div class="overlay_form"></div>
        </div>
<!--        edit-->
        <div class="add_price" v-if="priceEdit" :class="{show_addPrice : priceEdit}">
            <div class="form_edit">
                <h1>Edit Price</h1>
                <form>
                    <input type="hidden" disabled class="form-control" required id="product_sale" :value="this.product_sale">
                    <div class="form-group">
                        <label for="">Chương trình KM</label>
                        <select class="form-control" id="date_of_sale" name="">
                            <option disabled selected :value="this.date_of_sale">{{this.date_of_sale}}</option>
                            <option v-for="(date_id, index) in dateID">
                                {{date_id.date_id}}-
                                <span>(từ {{date_id.date_start}} đến {{date_id.date_end}})</span>
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">% Giam Gia</label>
                            <select id="percent_of_sale" class="form-control" name="">
                                <option disabled selected :value="this.percent_of_sale">{{this.percent_of_sale}}</option>
                                <option v-for="(percents, index) in percent">
                                    {{percents.percent_value}}%
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Sản Phẩm</label>
                            <select id="product_name" class="form-control" name="">
                                <option disabled selected :value="this.product_sale">{{this.pro_name}}</option>
                                <option v-for="(pro, index) in products">
                                    {{pro.product_name}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Giá</label>
                            <input id="price_of_unit" type="number" :value="this.price_of_unit">
                        </div>
                    </div>
                    <button @click="priceEdit = false" class="btn bg-light">Hủy</button>
                    <button type="submit" class="btn btn-success" @click.prevent="editPrice()">Lưu</button>
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
        name: "priceComponent",
        components:{
            Paginate,
        },
        data(){
            return{
                price:[],
                percent:[],
                dateID:[],
                products:[],
                pagination_price:{},
                priceShow:false,
                priceAdd:false,
                priceEdit:false,
                newPrice:{
                    date_id: 1,
                    percent_sale: 0,
                    productID: '',
                    unitPrice: '',
                    promotionPrice:0,
                }
            }
        },
        mounted(){
            this.fetchPrice();
            this.fetchPercent();
            this.fetchDateId();
            this.fetchProduct();
        },
        methods:{
            fetchPrice(url_price){
                url_price = url_price || `${RESOURCE}/prices`;
                axios.get(url_price)
                    .then(res => {
                        this.price = res.data.data;
                        this.pagination_price = {
                            current_page: res.data.current_page,
                            last_page: res.data.last_page,
                            path_page: res.data.path,
                        };
                    })
                    .catch(err => console.log(err));
            },
            fetchPercent(){

                    axios.get(RESOURCE + '/percent')
                    .then(res => {
                        this.percent = res.data;
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            fetchDateId(){

                axios.get(RESOURCE + '/date-sale')
                    .then(res => {
                        this.dateID = res.data;
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            fetchProduct(){
                axios.get(RESOURCE + '/pro-price')
                    .then(res => {
                        this.products = res.data;
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            // CallBack Pagination
            clickCallback_price(pageNum) {
                this.pagination_price.current_page = Number(pageNum);
                this.fetchPrice(this.pagination_price.path_page + '?page=' + this.pagination_price.current_page);
            },
            setPrice(product, percent, price_sale, date,pro_name) {
                this.date_of_sale = date;
                this.percent_of_sale = percent;
                this.product_sale = product;
                this.price_of_unit = price_sale;
                this.pro_name = pro_name;
            },
            createPrice(){
                axios.post(RESOURCE + '/price/add', {date: this.newPrice.date_id, percent_sale: this.newPrice.percent_sale, productID: this.newPrice.productID, unitPrice: this.newPrice.unitPrice,promotionPrice:this.newPrice.promotionPrice})
                    .then( res => {
                        this.fetchPrice();
                        this.priceAdd = false;
                    });
            },
            editPrice(){
                let id_pro = document.getElementById('product_sale').value;
                let percent = document.getElementById('percent_of_sale').value;
                let date = document.getElementById('date_of_sale').value;
                let price = document.getElementById('price_of_unit').value;
                axios.post(RESOURCE + '/price/edit/' + id_pro, {price_1: percent, price_2: date,price_3: price,price_4: id_pro})
                    .then(res => {
                        this.fetchPrice();
                        this.priceEdit=false
                    })
            }
        }
    }
</script>

<style lang="scss">
    .show_addPrice{

    }
</style>
