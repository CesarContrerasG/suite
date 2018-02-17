@extends('suite.sentry')

@section('html-title')
    Analitycs
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
    <li><a href="{{ route('sentry.tools.index') }}">Herramientas</a></li>
    <li>Analitycs</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#activity" aria-controls="activity" role="tab" data-toggle="tab">Actividad</a></li>
                    <li role="presentation"><a href="#companies" aria-controls="companies" role="tab" data-toggle="tab">Empresas</a></li>
                    <li role="presentation"><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Usuarios</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="activity">
                        <div class="with-padding">
                            @include('Sentry.tools.analytics.analytics_activities')
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="companies">
                        <div class="with-padding">
                            @include('Sentry.tools.analytics.analytics_companies')
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="users">
                        <div class="with-padding">
                            @include('Sentry.tools.analytics.analytics_users')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Proyecciones</div>
                <div class="panel-body">
                    <div class="col-md-2">
                        <p class="without-margin text-small">Crecimiento Mensual</p>
                        <i class="icon-trending_up text-xl"></i>
                    </div>
                    <div class="col-md-3">
                        <p class="without-margin text-large">3000</p>
                        <p class="without-margin"><span class="secundary-element">Operaciones</span></p>
                    </div>
                    <div class="col-md-2">
                        <p class="without-margin text-large">4.0</p>
                        <p class="without-margin"><span class="secundary-element">Empresas</span></p>
                    </div>
                    <div class="col-md-2">
                        <p class="without-margin text-large">32.0</p>
                        <p><span class="secundary-element">Usuarios</span></p>
                    </div>
                    <div class="col-md-3">
                        <p class="without-margin text-large">200 <small class="text-small">MB</small></p>
                        <p><span class="secundary-element">Almacenamiento</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection