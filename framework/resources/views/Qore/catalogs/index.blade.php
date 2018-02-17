@extends('suite.esuite')

@section('html-title')
    Qore - Catálogos Oficiales
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}">Administración</a></li>
    <li>Catálogos Oficiales</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-green">
                        <div class="flex-box">
                            <div><i class="icon-copy"></i></div>
                            <div>
                                <h3>Catálogos</h3>
                                <p>Información Global compartida dentro de la Suite</p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group">
                    @include('Qore.catalogs.partials.grid')
                </ul>
            </div>
        </div>

    </div>
@endsection
