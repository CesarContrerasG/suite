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
    <li>Apendice 11 (Claves de métodos de valoración)</li>
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
                                    <h3>Claves de métodos de valoración</h3>
                                    <p>Correspondiente al Apendice 11 del Anexo 22</p>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($valuations as $valuation)
                                <tr>
                                    <td>{{ $valuation->val_clave }}</td>
                                    <td>{{ $valuation->val_descrip }}</td>
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