<script>
$(function() {
    $('#activity-table-records').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('sentry.activities.records',\Hashids::encode($user->id)) !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'action', name: 'action' },
            { data: 'model_class', name: 'model_class' },
            { data: 'model_id', name: 'model_id' },
            { data: 'created_at', name: 'created_at' }
        ],
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando de _START_ al _END_ de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando de 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});
</script>