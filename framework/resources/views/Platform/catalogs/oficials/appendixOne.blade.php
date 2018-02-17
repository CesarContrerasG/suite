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
    <li>Apendice 01 (Aduana Sección)</li>
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
                                    <h3>Aduana ~ Sección</h3>
                                    <p>Correspondiente al Apendice 01 del Anexo 22</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <table class="table table-striped table-datatable">
                            <thead>
                                <tr>
                                    <th>Denominación</th>
                                    <th>Aduana</th>
                                    <th>Sección</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aduanas as $aduana)
                                <tr>
                                    <th>{{ $aduana->adu_denomina }}</th>
                                    <th>{{ $aduana->adu_numero }}</th>
                                    <th>{{ $aduana->adu_seccion }}</th>
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