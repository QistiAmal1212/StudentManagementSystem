
var options = {
    series: [{
        name: 'Total student',
        data: totalStudentForEachForm
    },
    {
        name: 'poor student',
        data: totalPoorStudentForEachForm
    }
    ],
    chart: {
        type: 'bar',
        height: 250
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    xaxis: {
        categories: ['Form1', 'Form2', 'Form3', 'Form4', 'Form5', 'Form6']
    },
    yaxis: {
        title: {
            text: 'Total student'
        }
    },
    fill: {
        opacity: 1,
        colors: ['#1f78b4', '#a6cee3']
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return val
            }
        }
    },
    legend: {
        markers: {
            fillColors: ['#1f78b4', '#a6cee3'] // Set your legend marker colors here
        }
    }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();



$(document).ready(function () {
    $('#example').DataTable({
    });
});