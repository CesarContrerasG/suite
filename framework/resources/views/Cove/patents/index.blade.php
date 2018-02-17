@extends('suite.esuite')

@section('html-title')
    COVE - Agentes Aduanales
@endsection

@section('html-head')
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection


@section('breadcrumb')
    <li><a href="{{ route('cove.catalogs.index') }}">Catálogos</a></li>
    <li>Agentes Aduanales</li>
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
                            <div><i class="icon-user-tie"></i></div>
                            <div>
                                <h3>Agentes Aduanales</h3>
                                <p>Catálogo de Agentes Aduanales</p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item text-right">
                        <a href="{{ route('cove.patents.create') }}" class="btn btn-default btn-sm btn-round">
                            agregar patente
                        </a>
                    </li>
                </ul>
                <div class="panel-body">
                    <div class="widget-datatable datatable-purple text-small">
                        @include('Cove.patents.partials.grid')
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
                "pagingType": "full_numbers"

            } );
    });
    </script>
@endsection
