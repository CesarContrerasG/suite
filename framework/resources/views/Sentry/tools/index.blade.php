@extends('suite.sentry')

@section('html-title')
    Herramientas
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li>Herramientas</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('Sentry.tools.partials.panel_toolbox')
        </div>
    </div>
@endsection