@extends('suite.enterprise')

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@endsection

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('suite.platform.index') }}">Home</a></li>
    <li><a href="{{ route('platform.catalogs.index') }}">Catálogos</a></li>
    <li>OMA (Indice Nacional del Precio al Consumidor)</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="widget-title widget-title-green">
                            <div class="flex-box">
                                <div><i class="icon-books"></i></div>
                                <div>
                                    <h3>Indice Nacional del Precio al Consumidor</h3>
                                    <p>Correspondiente a los catálogos de la OMA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <table class="table table-striped table-datatable">
                            <thead>
                                <tr>
                                    <th>Año</th>
                                    <th>Periodo</th>
                                    <th>Valor</th>
                                    <th>Recargo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inpcs as $inpc)
                                <tr>
                                    <td>{{ $inpc->inp_anio }}</td>
                                    <td>{{ $inpc->inp_periodo }}</td>
                                    <td>{{ $inpc->inp_valor }}</td>
                                    <td>{{ $inpc->inp_recargo }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
   @include('Platform.catalogs.oficials.script_datatable')
@endsection