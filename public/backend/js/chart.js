var ctx = document.getElementById('month__Chart').getContext('2d');
// var ctx_2 = document.getElementById('week__Chart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',
    // The data for our dataset
    data: {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
        datasets: [{
            label: 'Doanh Thu',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            borderColor: 'RGBA(39,199,112,0.56)',
            data: [0, 10, 5, 2, 20, 30, 45,2,5,100,200,200],
            borderWidth: 2
        }]
    },
    // Configuration options go here
    options:{
        title:{
            display:true,
            text:'Doanh Thu Hằng Tháng',
            fontSize:25
        },
        legend:{
            display:true,
            position:'right',
            labels:{
                fontColor:'#000'
            }
        },
        layout:{
            padding:{
                left:50,
                right:0,
                bottom:0,
                top:0
            }
        },
        tooltips:{
            enabled:true
        }
    }
});
//week chart

