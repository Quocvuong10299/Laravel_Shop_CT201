<template>
    <div style="overflow: hidden" class="container-fluid position-relative">
        <!--<photoshop-picker v-model="colors" />-->
        <div class="row w-100 mx-0">
          <div class="col-12 col-md-6 col-lg-6 col-xl-6">
              <div class="my-3">
                  <!--<div style="width: 100px; height: 100px" class="header-bg" :style="{'background-color': bgc}"></div>-->
                  <sketch-picker v-model="colors" />
                  <div class="my-3 form-group">
                      <label for="color_name">Tên Màu</label>
                      <input v-model="name" type="text" id="color_name" class="form-control" placeholder="Color name" required />
                  </div>
                  <div>
                      <button class="btn btn-success" @click="addColor()">Thêm</button>
                  </div>
              </div>
          </div>
          <div style="height: 100vh; overflow-y: auto" class="col-12 col-md-6 col-lg-6 col-xl-6">
              <table class="my-3 table">
                  <thead class="thead-dark">
                  <tr>
                      <th scope="col">Màu</th>
                      <th scope="col">Mã màu</th>
                      <th scope="col">Tên màu</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(color, index) in color_table" :key="index">
                      <th>
                          <div style="width: 20px; height: 20px;border-radius: 100%; border:1px solid #ccc" :style="{'background-color': color.color_value}"></div>
                      </th>
                      <td>{{color.color_value}}</td>
                      <td>{{color.color_name}}</td>
                  </tr>
                  </tbody>
              </table>

          </div>
      </div>
            <div v-if="message.length > 0" class="animation_alert position-absolute" :class="{add_animation_class:is_mess}">
                <p class="m-0">{{message}}</p>
            </div>

    </div>
</template>

<script>
    import { Sketch } from 'vue-color';
    import {RESOURCE} from '../api';
    let defaultProps = {
        hex: '#16422C',
        hsl: {
            h: 150,
            s: 0.5,
            l: 0.2,
            a: 0.9
        },
        hsv: {
            h: 150,
            s: 0.66,
            v: 0.30,
            a: 0.9
        },
        rgba: {
            r: 159,
            g: 96,
            b: 43,
            a: 0.9
        },
        a: 0.9
    };
    export default {
        name: "color-component",
        components: {
            'sketch-picker': Sketch,
        },
        data(){
            return{
                colors:defaultProps,
                name:'',
                color_table:[],
                message:'',
                is_mess:true,
            }
        },
        mounted(){
            this.fetchColors();
        },
        computed:{
            bgc () {
                return this.colors.hex
            }
        },
        methods:{
            fetchColors(url_color){
                url_color = url_color || `${RESOURCE}/colors`;
                axios.get(url_color)
                    .then(res => {
                        this.color_table = res.data;
                    })
                    .catch(err => console.log(err));
            },
            addColor(){
                axios.post(RESOURCE + '/colors/add', {color: this.colors.hex, color_name: this.name})
                    .then(res => {
                        this.fetchColors();
                        this.message = res.data.message;
                        this.name='';
                        setTimeout(()=>{
                           this.is_mess = false
                        }, 2000);
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        }

    }
</script>

<style lang="scss">
.vc-sketch{
    width: 95%!important;
}
.animation_alert{
    width:30%;
    height:60px;
    background:#00C764;
    top:0;
    right:-350px;
    transition:all 0.4s ease-in-out;
    display:flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    opacity: 0;
    font-size: 18px;
}
.add_animation_class{
    right: 0;
    opacity: 1;
}
</style>