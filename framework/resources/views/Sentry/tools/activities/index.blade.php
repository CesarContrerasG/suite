@extends('suite.sentry')

@section('html-title')
    Registro de Actividades
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('sentry.tools.index') }}">Herramientas</a></li>
    <li>Registro de Actividades</li>
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
                            <i class="text-xl icon-laptop-13"></i>
                        </div>
                        <div>
                            <h3 class="without-margin">Registro de Actividad</h3>
                            <p class="without-margin">Registro de operaciones realizadas por los usuarios de la Suite</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="div panel panel-default">
                @if(count($users) > 0)
                    <ul class="list-group">
                        @foreach($users as $user)
                            <li class="list-group-item">
                                <div class="flex-box space-between">
                                    <div class="col-md-4">
                                        <i class="icon-person"></i> {{ $user->fullname }}
                                    </div>
                                    <div class="col-md-3">
                                        <i class="icon-domain"></i> {{ $user->departament->company->name }}
                                    </div>
                                    <div class="col-md-3">
                                    <span class="secundary-element">
                                        <i class="icon-label"></i> {{ $user->current_master->name }}
                                    </span>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <a href="{{ route('sentry.activities.show', \Hashids::encode($user->id)) }}" class="btn btn-default btn-sm btn-round btn-round-primary">
                                            <i class="icon-tune"></i> Actividad
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <i class="icon-sentiment_neutral"></i> ¡Sin usuarios registrados!
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection