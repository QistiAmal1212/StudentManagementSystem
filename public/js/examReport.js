var options = {
    series: [{
        name: 'total average',
        data: reportResult2
    }],
    chart: {
        type: 'bar',
        height: 250
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        },
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
        categories: reportResult1,
    },
    yaxis: {
        title: {
            text: 'total average mark'
        }
    },
    fill: {
        opacity: 1
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return val
            }
        }
    }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();




var options2 = {
    series: reportResult2,
    chart: {
        width: 380,
        type: 'pie',
    },
    labels: reportResult1,
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};

var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
chart2.render();


$(document).ready(function () {
    $('#example').DataTable({

    });


    $(".sidebar-item.active").removeClass("active");
    $("#examReport").addClass("active");


    $('#examSelect').on('change', function () {
        $('#reportform').submit();
    });



});