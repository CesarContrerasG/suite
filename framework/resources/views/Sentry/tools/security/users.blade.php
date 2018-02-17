@extends('suite.sentry')

@section('html-title')
    Usuarios Autorizados
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('sentry.tools.index') }}">Herramientas</a></li>
    <li><a href="{{ route('sentry.security.index') }}">Seguridad</a></li>
    <li>Usuarios Autorizados</li>
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
                            <i class="text-xl icon-computer-4"></i>
                        </div>
                        <div>
                            <h3 class="without-margin">Authorized User</h3>
                            <p class="without-margin">Usuarios con acceso a Sentry</p>
                        </div>
                    </div>
                </div>
            </div>

            @include('Sentry.tools.security.grid_users')
        </div>

    </div>
@endsection