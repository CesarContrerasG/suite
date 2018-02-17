<script type="text/javascript">
$(function () {

    var colors = Highcharts.getOptions().colors,
        categories = ['Servicios', 'Sistemas de la ESuite'],
        data = [{
            <?php
                $total_service = 0;
                if(!empty($data_chart_systems['services'])) {
                    $services = $data_chart_systems['services'];
                    foreach($services as $service){
                        $total_service += $service['quantity'];
                    }
                }
            ?>
            y: {{ $data_chart_systems['total'] - $total_service }},
            color: '#BDBDBD',
            drilldown: {
                name: 'Servicios Empresa',
                categories: ['Servicios Empresa'],
                data: {{ $data_chart_systems['total'] - $total_service }},
                color: '#BDBDBD'
            }
        }, {
            y: {{ $total_service }},
            color: '#12ac8e',
            drilldown: {
                name: 'Sistemas ESuite',
                <?php
                $quantities = "";
                if(!empty($data_chart_systems['services'])){
                    foreach ($services as $service) {
                        $quantities .= $service['quantity']." ,";
                    }
                }
                else{
                    $quantities = 0;
                }
                ?>
                categories: [
                    @if(!empty($data_chart_systems['services']))
                        @foreach ($services as $service)
                            "{{ $service['name'] }}",
                        @endforeach
                    @else
                        "Sistemas"
                    @endif
                ],
                data: [{{ $quantities }}],
                color: '#12ac8e'
            }
        }],
        browserData = [],
        versionsData = [],
        i,
        j,
        dataLen = data.length,
        drillDataLen,
        brightness;


    // Build the data arrays
    for (i = 0; i < dataLen; i += 1) {

        // add browser data
        browserData.push({
            name: categories[i],
            y: data[i].y,
            color: data[i].color
        });

        // add version data
        drillDataLen = data[i].drilldown.data.length;
        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            versionsData.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get()
            });
        }
    }

    // Create the chart
    Highcharts.chart('chart_billings_systems_anual', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Facturación por Sistemas Grafica Anual'
        },
        subtitle: {
            text: 'Source: <a href="http://netmarketshare.com/">netmarketshare.com</a>'
        },
        yAxis: {
            title: {
                text: 'Total percent market share'
            }
        },
        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '50%']
            }
        },
        tooltip: {
            valueSuffix: '',
            valuePrefix: '$'
        },
        series: [{
            name: 'Facturado',
            data: browserData,
            size: '60%',
            dataLabels: {
                formatter: function () {
                    return this.y > 5 ? this.point.name : null;
                },
                color: '#ffffff',
                distance: -30
            }
        }, {
            name: 'Facturado',
            data: versionsData,
            size: '80%',
            innerSize: '60%',
            dataLabels: {
                formatter: function () {
                    // display only if larger than 1
                    return this.y > 1 ? '$' + this.y : null;
                }
            }
        }]
    });
});
</script>
