    
    //Funcion para eliminar registros desde el grid
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
                window.location= data['redirect'];
            }).fail(function() {
                alert('El registro esta siendo utilizado');
            })
        }
    });

