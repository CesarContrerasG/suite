@extends('suite.sentry')

@section('html-title')
    Seguridad
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('sentry.tools.index') }}">Herramientas</a></li>
    <li>Seguridad</li>
@endsection

@section('content')
    <div class="row">

        <div class="col-md-4">
            @include('Sentry.tools.partials.panel_toolbox')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="flex-box">
                        <div class="with-margin-right">
                            <i class="text-xl icon-security"></i>
                        </div>
                        <div>
                            <h3 class="without-margin">Seguridad</h3>
                            <p class="without-margin">Módulo de seguridad</p>
                        </div>
                    </div>
                </div>
            </div>

           @include('Sentry.tools.security.panel_options')
        </div>

    </div>
@endsection