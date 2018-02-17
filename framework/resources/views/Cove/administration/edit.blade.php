@extends('suite.esuite')

@section('html-title')
    COVE - Editar COVE
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chosen.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/snippets-datepicker-purple.css')  }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.dataTables.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('cove.administration.index') }}"><i class="icon-icon"></i>Administracion</a></li>
    <li>Editar COVE</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar COVE
                </div>
                <div class="panel-body">
                    <div>
                        <ul class="nav nav-tabs suite-tabs-purple" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#general" aria-controls="general" role="tab" data-toggle="tab" class="test-test">Datos Generales</a>
                            </li>
                            <li role="presentation">
                                <a href="#invoice" aria-controls="invoice" role="tab" data-toggle="tab">Facturas</a>
                            </li>
                            <li role="presentation">
                                <a href="#inventory" aria-controls="inventory" role="tab" data-toggle="tab">Mercancias</a>
                            </li>
                            <li role="presentation">
                                <a href="#layout" aria-controls="layout" role="tab" data-toggle="tab">Subir Layout</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="general">
                                <div class="with-padding">
                                    {!! Form::model($cove, ['route' => ['cove.update', $cove->pk_item], 'method' => 'PUT', 'class' => 'form']) !!}
                                        @include('Cove.administration.partials.general')
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="invoice">
                                <div class="with-padding">
                                    @include('Cove.administration.partials.invoices')
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="inventory">
                                <div class="with-padding">
                                    @include('Cove.administration.partials.inventory')
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="layout">
                                <div class="with-padding">
                                    @include('Cove.administration.partials.layout')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('dist/js/jquery.dataTables.min.js') }}"></script>
    <script src="//mpryvkin.github.io/jquery-datatables-row-reordering/1.2.2/jquery.dataTables.rowReordering.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mockjax/1.6.2/jquery.mockjax.min.js"></script>
    <script src="{{ asset('dist/js/chosen.jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
        $('#cove_fecha').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        $('#inv_fecha').bootstrapMaterialDatePicker({ weekStart : 0, time: false });

        $('#table-inv').DataTable( {
            "language": {
                "url": "{{ asset('js/Spanish.json') }}"
            },
            "paging": false,
            "searching": false,
            "lengthChange": false
        } );
        var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
        },
        updateIndex = function(e, ui) {
            $('td.index', ui.item.parent()).each(function (i) {
                sec = i + 1;
                item = $(this).next('td').text();
                $(this).html(sec);
                var token = $('meta[name=csrf-token]').attr('content');
                url = '../../inventory/secuencial';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {sec: sec, item: item, _token: token },
                    dataType: 'JSON',
                    success: function(res) {
                    console.log(res);
                    }
                });
            });
        };

        $("#table-inv>tbody").sortable({
            helper: fixHelperModified,
            stop: updateIndex
        }).disableSelection();

    </script>
@endsection
