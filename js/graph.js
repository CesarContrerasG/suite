$(document).ready(function(){
    var url = "anexo31/graphs";
    var token = $('meta[name="csrf-token"]').attr('content');

    $.post(url, {_token: token}, function(res){
        var cargos = [];
        var abonos = [];
        var saldo = [];
       // var meses = [];
        var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        $.each(res, function (index, value) 
        {

          //  meses.push(mes[res[index].mes - 1]);
            cargos.push(res[index].iva);
            abonos.push(res[index].iva2);
            saldo.push(res[index].iva3);
        });
        console.log(saldo);
        Highcharts.chart('container', {
            title: {
                text: 'Cargos y Abonos'
            },

            subtitle: {
                text: 'Credito IVA mensual'
            },
            yAxis: {
                title: { text: 'Credito IVA'}
            },
            xAxis: {
                categories: meses
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            series: [
                 {
                    name: "cargos",
                    data: cargos
                 },
                 {
                     name: "abonos",
                     data: abonos
                 },
                 {
                     name: "saldo",
                     data: saldo
                 }              
            ]

        });
    });
});