@extends('suite.esuite')

@section('html-title')
    COVE - Catálogos
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection

@section('breadcrumb')
    <li>Catálogos</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Cove.partials.sidebar_catalogs')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body"></div>          
            </div>
        </div>
@endsection

