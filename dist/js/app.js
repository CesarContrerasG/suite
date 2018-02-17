/*============================================================================

    Funcion para eliminar registros desde el grid

============================================================================ */



$(document).ready(function () {

    var url = window.location;

    $('#navigation-app a[href="'+url+'"]').addClass('active');

    console.log(url);

});



/* ============================================================================

    Funcion para eliminar registros desde el grid

============================================================================ */

function deleteCove(cove){
    var token = $('.delete').data('token');
    var res = confirm("¿Desea eliminar el registro?");
    if (res == true) {
        $.post({
            type: 'delete',
            url: cove+"/destroy",
            data: {_token :token},
        }).done(function (data) {
            window.location.href = data.redirect;
        }).fail(function() {
            alert('El registro esta siendo utilizado');
        })
    }

}

$(".delete").click(function(){

    var url = $(this).data('url');
    var token = $(this).data('token');

    var res = confirm("¿Desea eliminar el registro?");

    if (res == true) {

        $.post({

            type: $(this).data("method"),

            url: url,

            data: {_token :token},

        }).done(function (data) {

            window.location.href = data.redirect;

        }).fail(function() {

            alert('El registro esta siendo utilizado');

        })

    }

});



function show(id)

{

    $('#' + id).toggle('slow');

}



$('#emisor_id').change(function(){

    var token = $('meta[name=csrf-token]').attr('content');

    var url = "../../transmitter";

    var type = $(this).data("type");

    var id = $(this).val();

    $.post({

        url: url, data: {'_token' : token, emisor : id, type : type },

    })

    .done(function(data){

        field = data.transmitter;

        console.log(field);

        if(type == 1)

        {            

            $('#emisor_nombre').val(field.pro_razon);

            $('#emisor_paterno').val(field.pro_paterno);

            $('#emisor_materno').val(field.pro_materno);

            if(field.pro_tipo == 1)

                $('#emisor_rfc').val(field.pro_rfc);

            else

                $('#emisor_rfc').val(field.pro_taxid);

            $('#emisor_calle').val(field.pro_calle);

            $('#emisor_col').val(field.pro_col);

            $('#emisor_noext').val(field.pro_noext);

            $('#emisor_noint').val(field.pro_noint);

            $('#emisor_localidad').val(field.pro_localidad);

            $('#emisor_mpo').val(field.pro_mpo);

            $('#emisor_edo').val(field.pro_edo);

            $('#emisor_pais').val(field.pro_pais);

            $('#emisor_cp').val(field.pro_cp);

        }

        else

        {

            $('#emisor_nombre').val(field.business_name);

            $('#emisor_rfc').val(field.rfc);

            $('#emisor_calle').val(field.address);

            $('#emisor_col').val(field.colony);

            $('#emisor_noext').val(field.outdoor);

            $('#emisor_noint').val(field.interior);

            $('#emisor_localidad').val(field.location);

            $('#emisor_mpo').val(field.town);

            $('#emisor_edo').val(field.state);

            $('#emisor_pais').val(field.country);

            $('#emisor_cp').val(field.cpostal);

        }

    });

});





$('#dest_id').change(function(){

    var token = $('meta[name=csrf-token]').attr('content');

    var url = "../../receiver";

    var type = $(this).data("type");

    var id = $(this).val();

    $.post({

        url: url, data: {'_token' : token, destina : id, type : type },

    })

    .done(function(data){

        field = data.receiver;

        if(type == 2)

        {            

            $('#dest_nombre').val(field.cli_razon);

            $('#dest_paterno').val(field.cli_paterno);

            $('#dest_materno').val(field.cli_materno);

            if(field.cli_tipo == 1)

                $('#dest_rfc').val(field.cli_rfc);

            else

                $('#dest_rfc').val(field.cli_taxid);

            $('#dest_calle').val(field.cli_calle);

            $('#dest_col').val(field.cli_col);

            $('#dest_noext').val(field.cli_noext);

            $('#dest_noint').val(field.cli_noint);

            $('#dest_localidad').val(field.cli_localidad);

            $('#dest_mpo').val(field.cli_mpo);

            $('#dest_edo').val(field.cli_edo);

            $('#dest_pais').val(field.cli_pais);

            $('#dest_cp').val(field.cli_cp);

        }

        else

        {

            $('#dest_nombre').val(field.business_name);

            $('#dest_rfc').val(field.rfc);

            $('#dest_calle').val(field.address);

            $('#dest_col').val(field.colony);

            $('#dest_noext').val(field.outdoor);

            $('#dest_noint').val(field.interior);

            $('#dest_localidad').val(field.location);

            $('#dest_mpo').val(field.town);

            $('#dest_edo').val(field.state);

            $('#dest_pais').val(field.country);

            $('#dest_cp').val(field.cpostal);

        }

    });

});



$("#inv_numparte").change(function(){

    var token = $('meta[name=csrf-token]').attr('content');

    var url = "../../invoice/description";     

    $.post({

        url: url, data: { '_token' : token, parte : $(this).val() },

    })

    .done(function(data){

        console.log(data.descove);

        $('#inv_descove').val(data.descove);

    });

});



function showDetail(id)

{

    var url = "../../invoices/"+id;

    $.get({

        url: url,

    })

    .done(function(data){

        var invoice = data.invoice;

        $("#save_invoice").prop('disabled', false);

        $("#id_invoice").val(invoice.inv_item);

        $('#inv_factura').val(invoice.inv_factura);

        $('#inv_fecha').val(invoice.inv_fecha);

        $('#inv_moneda').val(invoice.inv_moneda);

        if(invoice.inv_subdivision == 1)

            document.getElementById("inv_subdivision").checked = true;

        if(invoice.inv_certorigen == 1)

            document.getElementById("inv_certorigen").checked = true;

        $('#inv_factorme').val(invoice.inv_factorme);

        $('#inv_tipocambio').val(invoice.inv_tipocambio);

        

        $('#emisor_id > option[value="'+invoice.emisor_clave+'"]').attr('selected', 'selected');

        $('#emisor_tipoid > option[value="'+invoice.emisor_tipoid+'"]').attr('selected', 'selected');

        $('#emisor_id').val(invoice.emisor_clave).trigger('chosen:updated');

        $('#emisor_nombre').val(invoice.emisor_nombre);

        $('#emisor_rfc').val(invoice.emisor_identificador);

        $('#emisor_paterno').val(invoice.emisor_paterno);

        $('#emisor_materno').val(invoice.emisor_materno);

        $('#emisor_calle').val(invoice.emisor_calle);

        $('#emisor_col').val(invoice.emisor_col);

        $('#emisor_noext').val(invoice.emisor_noext);

        $('#emisor_noint').val(invoice.emisor_noint);

        $('#emisor_localidad').val(invoice.emisor_localidad);

        $('#emisor_mpo').val(invoice.emisor_mpo);

        $('#emisor_edo').val(invoice.emisor_edo);

        $('#emisor_pais').val(invoice.emisor_pais);

        $('#emisor_cp').val(invoice.emisor_cp);

        $('#dest_id > option[value="'+invoice.dest_clave+'"]').attr('selected', 'selected');

        $('#dest_tipoid > option[value="'+invoice.dest_tipoid+'"]').attr('selected', 'selected');

        $('#dest_id').val(invoice.dest_clave).trigger('chosen:updated');

        $('#dest_nombre').val(invoice.dest_nombre);

        $('#dest_rfc').val(invoice.dest_identificador);

        $('#dest_paterno').val(invoice.dest_paterno);

        $('#dest_materno').val(invoice.dest_materno);

        $('#dest_calle').val(invoice.dest_calle);

        $('#dest_col').val(invoice.dest_col);

        $('#dest_noext').val(invoice.dest_noext);

        $('#dest_noint').val(invoice.dest_noint);

        $('#dest_localidad').val(invoice.dest_localidad);

        $('#dest_mpo').val(invoice.dest_mpo);

        $('#dest_edo').val(invoice.dest_edo);

        $('#dest_pais').val(invoice.dest_pais);

        $('#dest_cp').val(invoice.dest_cp);

    });

}



function showDetailInventory(id)

{

    var url = "../../inventory/"+id;

    $.get({

        url: url,

    })

    .done(function(data){

        var inventory = data.inventory;

        console.log(inventory);

        $("#id_inventory").val(inventory.pk_item);

        $('#factura > option[value="'+inventory.inv_factura+'"]').attr('selected', 'selected');

        $('#inv_numparte > option[value="'+inventory.inv_numparte+'"]').attr('selected', 'selected');

        $('#inv_numparte').val(inventory.inv_numparte).trigger('chosen:updated');        

        $('#inv_descove').val(inventory.inv_descove);

        $('#inv_cantidad').val(inventory.inv_cantidad);

        $('#inv_valorunitario').val(inventory.inv_valorunitario);

        $('#inv_valortotal').val(inventory.inv_valortotal);

        $('#inv_oma > option[value="'+inventory.inv_oma+'"]').attr('selected', 'selected');

        $('#inv_oma').val(inventory.inv_oma).trigger('chosen:updated');        

    });

}



function calculateImport()

{

    var quantity = $('#inv_cantidad').val();

    var price = $('#inv_valorunitario').val();

    import_me = quantity * price;

    $('#inv_valortotal').val(import_me);

}



function signAll(id)

{   

    var seleccionados = $('input:checkbox:checked').map(function() {

        type = $("#type").val();

        if(id == 1)

            var url = 'administration/' + this.value + "/sign/"+type;

        else

            var url = '../../digital/' + this.value + "/sign/"+type;

         $.get({

            url: url,

        }).done(function(data){            

            window.location.href = data.redirect;

            $("#type").val(1);

            $("#type_ed").val(1);

        });



    }).get();

    

}



$("#checkTodos").change(function () {

    $("input:checkbox").prop('checked', $(this).prop("checked"));

});

