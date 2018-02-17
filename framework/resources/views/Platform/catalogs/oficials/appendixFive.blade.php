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
    <li>Apendice 05 (Claves de Monedas)</li>
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
                                    <h3>Claves de Monedas</h3>
                                    <p>Correspondiente al Apendice 05 del Anexo 22</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <table class="table table-striped table-datatable">
                            <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>País</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($currencies as $currency)
                                <tr>
                                    <td>{{ $currency->mon_clave }}</td>
                                    <td>{{ $currency->mon_nombre }}</td>
                                    @if($currency->mon_pais == 0)
                                        <td>País no especificado </td>
                                    @else
                                        <td>{{ $currency->country->short_nombre }}</td>
                                    @endif
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