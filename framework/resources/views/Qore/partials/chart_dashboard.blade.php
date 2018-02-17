<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        'use strict';
        /* global document */
        // Load the fonts
        Highcharts.createElement('link', {
           href: 'https://fonts.googleapis.com/css?family=Raleway',
           rel: 'stylesheet',
           type: 'text/css'
        }, null, document.getElementsByTagName('head')[0]);

        Highcharts.theme = {
           colors: ['#90ee7e', '#ffffff', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
              '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
           chart: {
              backgroundColor: null,
              style: {
                 fontFamily: '\'Raleway\', sans-serif'
              }
           },

           subtitle: {
               style: {
                   color: '#FFF',
                   textTransform: 'uppercase'
               }
           },

           xAxis: {
               gridLineColor: '#FFF',
               labels: {
                   style: {
                       color: '#FFF'
                   }
               },
               lineColor: '#FFF',
               minorGridLineColor: '#FFF',
               tickColor: '#FFF',
               title: {
                   style: {
                       color: '#A0A0A3'

                   }
               }
           },

           yAxis: {
               gridLineColor: 'rgba(255, 255, 255, 0.5)',
               labels: {
                   style: {
                       color: '#FFF'
                   }
               },
               lineColor: 'rgba(255, 255, 255, 0.5)',
               minorGridLineColor: '#FFF',
               tickColor: 'rgba(255, 255, 255, 0.5)',
               tickWidth: 1,
               title: {
                   style: {
                       color: '#FFF'
                   }
               }
           },

           legend: {
               itemStyle: {
                   color: '#FFF'
               },
               itemHoverStyle: {
                   color: '#E0E0E3'
               },
               itemHiddenStyle: {
                   color: '#606063'
               }
           },

           // scroll charts
           rangeSelector: {
              buttonTheme: {
                 fill: '#505053',
                 stroke: '#FFF',
                 style: {
                    color: '#CCC'
                 },
                 states: {
                    hover: {
                       fill: '#707073',
                       stroke: '#000000',
                       style: {
                          color: 'white'
                       }
                    },
                    select: {
                       fill: '#000003',
                       stroke: '#000000',
                       style: {
                          color: 'white'
                       }
                    }
                 }
              },
              inputBoxBorderColor: '#505053',
              inputStyle: {
                 backgroundColor: '#333',
                 color: '#FFF'
              },
              labelStyle: {
                 color: '#FFF'
              }
           },

           navigator: {
              handles: {
                 backgroundColor: '#FFF',
                 borderColor: '#FFF'
              },
              outlineColor: '#CCC',
              maskFill: 'rgba(255,255,255,0.1)',
              series: {
                 color: '#7798BF',
                 lineColor: '#A6C7ED'
              },
              xAxis: {
                 gridLineColor: '#505053'
              }
           },

           scrollbar: {
              barBackgroundColor: '#808083',
              barBorderColor: '#808083',
              buttonArrowColor: '#CCC',
              buttonBackgroundColor: '#606063',
              buttonBorderColor: '#606063',
              rifleColor: '#FFF',
              trackBackgroundColor: '#404043',
              trackBorderColor: '#FFF'
           },

           // special colors for some of the
           legendBackgroundColor: 'rgba(255, 255, 255, 1)',
           background2: '#505053',
           dataLabelsColor: '#B0B0B3',
           textColor: '#C0C0C0',
           contrastTextColor: '#F0F0F3',
           maskColor: 'rgba(255,255,255,0.3)'
        };

        // Apply the theme
        Highcharts.setOptions(Highcharts.theme);

        Highcharts.chart('chart', {
            chart: {
                type: 'area'
            },
            title: {
                text: '' // Title Chart
            },
            subtitle: {
                text: 'Estado financiero - Qore' // Subtitle chart
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                allowDecimals: false,
                labels: {
                    formatter: function () {
                        return this.value; // clean, unformatted number for year
                    }
                }
            },
            yAxis: {
                title: {
                    text: '' // lateral title
                },
                labels: {
                    formatter: function () {
                        return this.value / 1000 + 'k';
                    }
                }
            },
            tooltip: {
                pointFormat: '{series.name} produced <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
            },
            plotOptions: {
                area: {
                    marker: {
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                }
            },
            series: [{
                name: 'Facturas',
                data: [27000, 25000, 24000, 23000, 22000, 21000, 20000, 19000, 18000, 18000, 17000, 16000]
            }, {
                name: 'Pagos',
                data: [11009, 10950, 10871, 10824, 10577, 10527, 10030, 10475, 10421, 10358, 10295, 10104]
            }]
        });

    });

</script>
