<template>
    <div class="date_component">
        <div class="p-3">
            <h3>Tạo Ngày Khuyến Mãi</h3>
            <date-picker v-model="date_start" lang="en" valueType="format" fomat="YYYY-MM-DD"></date-picker>
            <date-picker v-model="date_end" lang="en" valueType="format" fomat="YYYY-MM-DD"></date-picker>
            <input type="number" v-model="date_id" style="width: 60px">
            <button class="btn btn btn-success" @click.prevent="createDate()">Tạo Ngày</button>
        </div>

        <div  class="table mt-5">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Mã Ngày KM</th>
                    <th scope="col">Ngày Bắt Đầu</th>
                    <th scope="col">Ngày Kết Thúc</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="day in date_sale">
                    <th scope="row">{{day.date_id}}</th>
                    <td>{{(day.date_start===null)?"0":day.date_start}}</td>
                    <td>{{(day.date_end===null)?"0":day.date_end}}</td>
<!--                    <td><button class="btn btn-warning" @click="date_edit = true">Sửa</button></td>-->
                   <td> <button @click="date_edit = true; setValDate(day.date_id, day.date_start,day.date_end)" class="btn bg-warning" >Sửa</button></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="add_day" v-if="date_edit" :class="{show_addDate : date_edit}">
            <div class="form_edit">
                <h1>Edit Date</h1>
                <form>
                    <input type="hidden" disabled class="form-control" id="day_ID" name="id" required :value="this.day_ID">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Ngày bắt đầu</label>
                            <date-picker v-model="day_edit1" lang="en" valueType="format" fomat="YYYY-MM-DD"></date-picker>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Ngày kết thúc</label>
                            <date-picker v-model="day_edit2" lang="en" valueType="format" fomat="YYYY-MM-DD"></date-picker>
                        </div>
                    </div>
                    <button @click="date_edit = false" class="btn bg-light">Hủy</button>
                    <button type="submit" class="btn btn-success" @click.prevent="editdate()">Lưu</button>
                </form>
            </div>
            <div class="overlay_form"></div>
        </div>
    </div>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import {RESOURCE} from "../api";
    export default {
        name: "date-component",
        components:{
            DatePicker,
        },
        data(){
            return{
                date_start:'',
                date_end:'',
                date_sale:[],
                date_id:'',
                date_edit:false,
                day_edit1:'',
                day_edit2:''
            }
        },
        mounted(){
            this.fetchDate();
        },
        methods:{
            fetchDate(){
                axios.get(RESOURCE + '/date')
                    .then(res => {
                        this.date_sale = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            createDate(){
                axios.post(RESOURCE + '/add_day',{day_id:this.date_id,start:this.date_start,end:this.date_end})
                    .then(res => {
                        this.fetchDate();
                        this.date_start='';
                        this.date_end='';
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            setValDate(val_id, val_start, val_end) {
                this.day_ID = val_id;
                this.day_start = val_start;
                this.day_end = val_end;
            },
            editdate(){
                let id_day = document.getElementById('day_ID').value;
                // let start = document.getElementById('cat_name').value;
                // let end = document.getElementById('cat_item').value;
                axios.post(RESOURCE + '/date-edit/' + id_day, {day_1: this.day_edit1, day_2: this.day_edit2})
                    .then(res => {
                        this.fetchDate();
                        this.date_edit=false
                    });
            }
        }
    }
</script>

<style scoped>

</style>
