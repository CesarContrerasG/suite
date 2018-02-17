@extends('suite.esuite')

@section('html-title')
    COVE - Adminitracion de COVE
@endsection

@section('html-head')
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection


@section('breadcrumb')
    <li>Administracion de COVE</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-purple">
                        <div class="flex-box">
                            <div><i class="icon-books"></i></div>
                            <div>
                                <h3>Administración de COVE</h3>
                                <p>Vista Previa del Módulo Cove</p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group">
                    @if($type != 7)
                    <li class="list-group-item text-right"> 
                        @if($type < 5)                       
                        <a href="#" onclick="signAll(1)" class="btn btn-default btn-sm btn-round btn-round-success">FIRMAR</a>
                        @endif
                        <input type="hidden" value="0" id="type"> 
                        @if($type < 6) 
                        <a href="{{ route('cove.create') }}" class="btn btn-default btn-sm btn-round">AGREGAR COVE</a>
                        @endif
                    </li>
                    @endif
                </ul>
                <div class="panel-body">                    
                    <div class="widget-datatable datatable-purple text-small">
                        <div class="row">
                            <div class="col-md-12 with-padding">                                
                                {!! Form::select('sicove', ['0' => 'Sin Firmar', '1' => 'Firmado'], null, ['id' => 'status'])!!}                               
                            </div>
                        </div>
                        @include('Cove.administration.partials.grid')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript">
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var status = $("#status").val();
    
            if(status == 0)
            {
                if(data[3] == '')
                    return true;
            }
            if(status == 1)
            {
                if(data[3] != '')
                    return true;
            }

            return false;
        }
    );
    $(document).ready(function(){
        var table  = $('#table').DataTable( {
           "language": {
                "url": "{{ asset('js/Spanish.json') }}"
            },
            "processing": true,
            "pagingType": "full_numbers",
            "serverSide": false,
            "ajax": "{{ route('cove.view') }}",
            "columns": [
                {data: 'check', name: 'check',  "orderable": false, "searchable": false},
                {data: 'pk_referencia', name: 'pk_referencia'},
                {data: 'cove_factura', name: 'cove_factura'},
                {data: 'cove_edocument', name: 'cove_edocument'},
                {data: 'cove_numadenda', name: 'cove_numadenda'},                
                {data: 'cove_fecha', name: 'cove_fecha'},
                {data: 'cove_patente', name: 'cove_patente'},
                {data: 'tipo', name: 'tipo', "orderable": false, "searchable": false},
                {data: 'relacion', name: 'relacion', "orderable": false, "searchable": false},
                {data: 'errores', name: 'errores', "orderable": false, "searchable": false},
                {data: 'valid', name: 'valid', "orderable": false, "searchable": false},
                {data: 'options', name: 'options', "orderable": false, "searchable": false}
            ]
        } );            
        $('#status').change( function() {            
            table.draw();
            
        } );
     });
    </script>
    
@endsection
