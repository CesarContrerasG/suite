@extends('suite.sentry')

@section('html-title')
    Dashboard
@endsection

@section('html-head')
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('js/chartjs.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li>Dashboard</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="panel panel_default">
            <div class="panel-body">
                <div class="text-right">
                    <span class="text-small">Actividad Diaria</span> <i class="icon-equalizer3"></i>
                </div>
                {!! $chartjs->render() !!}
                <div class="text-center text-small">
                    Actividad Registrada en la Plataforma
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-right">
                    <span class="text-small">Usuarios Registrados</span> <i class="icon-people"></i>
                </div>
                <div class="panel-indicator">
                    <div class="indicator-number">{{ $users }} <small>84% activos</small></div>
                </div>
                <div class="text-small text-center without-margin">
                    <a href="#" class="anchor-indicator">Analytics Users</a>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-right">
                    <span class="text-small">Bases de Datos Utilizadas</span> <i class="icon-dns"></i>
                </div>
                <div class="panel-indicator">
                    <div class="indicator-number">28 <small>96% activas</small></div>
                </div>
                <div class="text-small text-center without-margin">
                    <a href="#" class="anchor-indicator">Analytics Data Bases</a>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-right">
                    <span class="text-small">Empresas Registradas</span> <i class="icon-domain"></i>
                </div>
                <div class="panel-indicator">
                    <div class="indicator-number">{{ $companies }} <small>92% activas</small></div>
                </div>
                <div class="text-small text-center without-margin">
                    <a href="#" class="anchor-indicator">Analytics Companies</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <br><br><br><br><br>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <br><br><br><br><br>
            </div>
        </div>
    </div>
</div>
@endsection
