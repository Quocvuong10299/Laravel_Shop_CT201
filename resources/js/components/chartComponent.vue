<template>
    <div>
        <div class="container-fluid my-2">
            <canvas ref="canvas" width="900" height="400"></canvas>
        </div>
        <div class="">
            <h3 class="d-flex justify-content-center">Doanh thu tuần</h3>
        </div>
    </div>
</template>

<script>
    import { Pie } from 'vue-chartjs'
    export default {
        extends: Pie,
        name: "chart-component",
        data(){
            return{
                datacollection: {
                    //Data to be represented on x-axis
                    labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
                    datasets: [{
                        label: 'Test',
                        backgroundColor: [
                            'rgba(0, 115, 250, 1)',
                            'rgba(248, 231, 28, 1)',
                            'rgba(246, 97, 131, 1)',
                            'rgba(126, 211, 33, 1)',
                            'rgba(208, 2, 27, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(0, 255, 255, 1)',
                        ],
                        // borderColor:'rgb(75, 192, 192)',
                        pointBackgroundColor: 'white',
                        borderWidth: 2,
                        pointBorderColor: '#249EBF',
                        //Data to be represented on y-axis
                        data: [40, 20, 30, 50, 90, 10, 20]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                },
            }
        },
        mounted () {
            this.renderChart(this.datacollection, this.options)
        }
    }
</script>

<style scoped>

</style>