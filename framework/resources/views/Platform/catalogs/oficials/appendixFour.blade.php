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
    <li>Apendice 04 (Claves de Paises)</li>
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
                                    <h3>Claves de Paises</h3>
                                    <p>Correspondiente al Apendice 04 del Anexo 22</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <table class="table table-striped table-datatable">
                            <thead>
                                <tr>
                                    <th>Clave SAAI FIII</th>
                                    <th>Clave SAAI M3</th>
                                    <th>Pais</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($countries as $country)
                                <tr>
                                    <td>{{ $country->pai_clavefiii }}</td>
                                    <td>{{ $country->pai_clavem3 }}</td>
                                    <td>{{ $country->pai_nombre }}</td>
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