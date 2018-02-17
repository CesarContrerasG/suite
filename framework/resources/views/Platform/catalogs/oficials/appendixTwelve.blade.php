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
    <li>Apendice 12 (Contribuciones, Cuotas Compensatorias, Gravámenes y Derechos)</li>
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
                                    <h3>Contribuciones, Cuotas Compensatorias, Gravámenes y Derechos</h3>
                                    <p>Correspondiente al Apendice 12 del Anexo 22</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <table class="table table-striped table-datatable">
                            <thead>
                                <tr>
                                    <td>Clave</td>
                                    <td>Descripción</td>
                                    <td>Abreviación</td>
                                    <td>Nivel</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contributions as $contribution)
                                <tr>
                                    <td>{{ $contribution->con_clave }}</td>
                                    <td>{{ $contribution->short_description }}</td>
                                    <td>{{ $contribution->con_abrev }}</td>
                                    <td>{{ $contribution->con_nivel }}</td>
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