<template>
    <div>
        <div class="container-fluid my-2">
            <canvas ref="canvas" width="900" height="400"></canvas>
        </div>
        <div class="">
            <h3 class="d-flex justify-content-center">Doanh thu theo Quí</h3>
        </div>
    </div>
</template>

<script>
    import { Pie } from 'vue-chartjs'
    import {RESOURCE} from '../api';
    export default {
        extends: Pie,
        name: "chart-component",
        data(){
            return{
                datacollection: {
                    //Data to be represented on x-axis
                    labels: ['Quí 1', 'Quí 2', 'Quí 3', 'Quí 4'],
                    datasets: [{
                        label: 'Test',
                        backgroundColor: [
                            'rgba(248, 231, 28, 1)',
                            'rgba(126, 211, 33, 1)',
                            'rgba(208, 2, 27, 1)',
                            'rgba(255, 159, 64, 1)',
                        ],
                        // borderColor:'rgb(75, 192, 192)',
                        pointBackgroundColor: 'white',
                        borderWidth: 2,
                        pointBorderColor: '#249EBF',
                        //Data to be represented on y-axis
                        data: [40, 20, 30, 50]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                },
                test:[]
            }
        },
        mounted () {
            this.renderChart(this.datacollection, this.options)
            this.fetchData();
        },
        methods:{
          fetchData(){
              axios.get(RESOURCE + '/category')
                  .then( res => {
                      console.log(res.data)
                  });
          }
        }
    }
</script>

<style scoped>

</style>
