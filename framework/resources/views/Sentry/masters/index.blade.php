@extends('suite.sentry')

@section('html-title')
    Cuentas Maestras
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li>Cuentas Maestras</li>
@endsection

@section('content')
@if(Session::has('message'))
    <div class="notification_bar animated fadeInRight">
        <p>{{ Session::get('message') }}</p>
    </div>
@endif


<div class="row">

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                @if(count($masters) > 0)
                    <div class="list-group">
                        @foreach ($masters as $master)
                            <div class="list-group-item">
                                <p class="without-margin without-padding"><strong class="text-upper text-medium">{{ $master->name }}</strong></p>
                                <p class="without-margin without-padding"><span class="text-small">{{ $master->rfc }}</span></p>
                                <p class="without-margin with-padding-vertical">
                                    <a class="btn btn-default btn-sm btn-round btn-round-primary show-master-suite" data-master="{{ $master->id }}" href="#"><i class="icon-camera2"></i> Suite</a>
                                    <a class="btn btn-default btn-sm btn-round btn-round-primary" href="{{ route('sentry.masters.edit', \Hashids::encode($master->id)) }}"><i class="icon-business_center"></i> Administrar</a>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <span class="text-danger text-sm">No hay cuentas maestra registradas</span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="panel panel-default text-right">
            <div class="panel-body">
                <a href="{{ route('sentry.masters.create') }}" class="btn btn-default btn-sm btn-round">Registrar Nueva Cuenta</a>
                <a href="{{ route('sentry.suites.create') }}" class="btn btn-default btn-sm btn-round">Asociar Aplicaciones</a>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="lists-master-group">
                    <div class="content-group active">
                        <h3>Administrar Cuentas Maestras</h3>
                        <p>Para poder activar o desactivar modulos dentro de las <strong>Cuentas Maestras</strong> de clic en el botón
                            <strong>Suite</strong> de la empresa que desea modificar, de igual forma podra acceder a las configuraciones y agregar usuarios.</p>
                    </div>
                    @foreach ($masters as $master)
                        <div class="content-group" id="master-suite-{{ $master->id }}">
                            <div class="master-data">
                                <div class="flex-box space-between">
                                    <div>
                                        <p class="text-upper text-medium without-margin"><strong>{{ $master->name }}</strong></p>
                                        <p class="text-xs">{{ $master->company->contact }}</p>
                                    </div>
                                    <p class="text-medium">{{ $master->company->phone }}</p>
                                </div>
                            </div>
                            <div class="master-options text-right with-padding-vertical">
                                <a href="{{ route('sentry.masters.associate', \Hashids::encode($master->id)) }}" class="btn btn-default btn-sm btn-round">Asociar Aplicación</a>
                                <a href="{{ route('sentry.configuration.create', \Hashids::encode($master->id)) }}" class="btn btn-default btn-sm btn-round">Configuraciones</a>
                                <a href="{{ route('sentry.masters.users.create', \Hashids::encode($master->id)) }}" class="btn btn-default btn-sm btn-round">Registrar Usuario</a>
                            </div>
                            <div class="master-suite">
                                @foreach ($master->suites as $application)
                                    <?php $module = App\Sentry\Module::find($application->module_id) ?>
                                    <div class="master-app">
                                        <div class="flex-box space-between">
                                            <div class="flex-box">
                                                <div class="sticker sticker-round with-margin-right" style="background-color:{{ $module->color }};">
                                                    <i class="icon-layers"></i>
                                                </div>
                                                <div>
                                                    <strong>{{ $module->name }}</strong>
                                                </div>
                                            </div>
                                            <div class="master-app-action">
                                                <input type="checkbox" name="toggle" class="sw" id="{{ $master->name."-".$module->name }}" {{ ($application->active == 1) ? 'checked' : '' }} data-suite="{{ \Hashids::encode($application->id) }}">
                                                <label for="{{ $master->name."-".$module->name }}"></label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
<div id="data-url" data-url="{{ route('sentry.suites.toggle', ':SUITE_ID') }}"></div>
@endsection

@section('scripts')
    <script>
        $('.show-master-suite').click(function(e){
           e.preventDefault();
           suite = $(this).data('master');
           $('.content-group').removeClass('active');
           $('#master-suite-' + suite).addClass('active');
        });

        $('.sw').on('click', function(){
            var suite = $(this).data('suite');
            $.get( "suites/" + suite + "/toggle", function( data ) {
                console.log( data.message );
            });
        });
    </script>
@endsection
