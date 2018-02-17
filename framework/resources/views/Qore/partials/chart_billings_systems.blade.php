<script type="text/javascript">
$(function () {

var gaugeOptions = {

chart: {
    type: 'solidgauge'
},

title: null,

pane: {
    center: ['50%', '85%'],
    size: '140%',
    startAngle: -90,
    endAngle: 90,
    background: {
        backgroundColor: ('#EEE'),
        innerRadius: '60%',
        outerRadius: '100%',
        shape: 'arc'
    }
},

tooltip: {
    enabled: false
},

// the value axis
yAxis: {
    stops: [
        [0.1, '#12ac8e'], // green
        [0.9, '#118f76'] // red
    ],
    lineWidth: 0,
    minorTickInterval: null,
    tickAmount: 2,
    title: {
        y: -70
    },
    labels: {
        y: 16
    }
},

plotOptions: {
    solidgauge: {
        dataLabels: {
            y: 5,
            borderWidth: 0,
            useHTML: true
        }
    }
}
};

// The RPM gauge
var chartRpm = Highcharts.chart('chart_billings_systems', Highcharts.merge(gaugeOptions, {
yAxis: {
    min: 0,
    max: {{ $chart_systems_monthly['total_billings'] }},
    title: {
        text: 'RPM'
    }
},

series: [{
    name: 'RPM',
    data: [ {{ $chart_systems_monthly['total_services'] }} ],
    dataLabels: {
        format: '<div style="text-align:center"><span style="font-size:25px;color:' +
            ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f}</span><br/>' +
               '<span style="font-size:12px;color:silver">* 1000 / min</span></div>'
    },
    tooltip: {
        valueSuffix: ' revolutions/min'
    }
}]

}));

});

</script>
