@extends('suite.esuite')

@section('html-title')
    COVE - Materiales
@endsection

@section('html-head')
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection


@section('breadcrumb')
    <li><a href="{{ route('cove.catalogs.index') }}">Catálogos</a></li>
    <li>Materiales</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Cove.partials.sidebar_catalogs')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-purple">
                        <div class="flex-box">
                            <div><i class="icon-cogs"></i></div>
                            <div>
                                <h3>Materiales</h3>
                                <p>Catálogo de Materiales de Importación</p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item text-right">
                        <a href="{{ route('cove.materials.create') }}" class="btn btn-default btn-sm btn-round">
                            agregar material
                        </a>
                    </li>
                </ul>
                <div class="panel-body">
                    <div class="widget-datatable datatable-purple text-small">
                        @include('Cove.materials.partials.grid')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#table').DataTable( {
           "language": {
                "url": "{{ asset('js/Spanish.json') }}"
            },
            "processing": true,
            "pagingType": "full_numbers",
            "serverSide": true,
            "ajax": "{{ route('cove.materials.view') }}",
            "columns": [
                {data: 'pk_mat', name: 'pk_mat'},
                {data: 'mat_descove', name: 'mat_descove'},
                {data: 'mat_fracci', name: 'mat_fracci'},
                {data: 'mat_tipo', name: 'mat_tipo'},
                {data: 'mat_oma', name: 'mat_oma'},
                {data: 'options', name: 'options'}
            ]
        } );            
        /*$('#status').change( function() {
            table.draw();
        } );*/
     });
    </script>
@endsection
