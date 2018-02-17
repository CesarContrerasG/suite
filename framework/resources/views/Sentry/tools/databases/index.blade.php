@extends('suite.sentry')

@section('html-title')
    Bases de Datos
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('sentry.tools.index') }}">Herramientas</a></li>
    <li>Bases de Datos</li>
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
                            <i class="text-xl icon-database-8"></i>
                        </div>
                        <div>
                            <h3 class="without-margin">Bases de Datos</h3>
                            <p class="without-margin">Detalles de DB's usos y usuarios</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection