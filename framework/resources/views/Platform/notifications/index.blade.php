@extends('suite.enterprise')

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}">Home</a></li>
    <li>Notificaciones</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                @include('Platform.enterprise.panel-master')
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="widget-title widget-title-green">
                            <div class="flex-box">
                                <div><i class="icon-bell"></i></div>
                                <div>
                                    <h3>Notificaciones</h3>
                                    <p>Redacte notificaciones para todos los usuarios de la Suite</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group">
                        <div class="list-group-item text-right">
                            <a href="{{ route('platform.notifications.create') }}" class="btn btn-sm btn-round btn-round-green">Agregar Notificación</a>
                        </div>
                        @if(!is_null($notifications))
                            @foreach($notifications as $notification)
                                <div class="list-group-item with-padding">
                                    <div class="flex-box">
                                        <div>
                                            <div class="enterprise-sticker background-yellow">
                                                <i class="icon-notifications"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="without-margin"><strong>{{ $notification->notification_title }}</strong></p>
                                            <p class="without-margin">{!! $notification->notification !!}</p>
                                        </div>
                                    </div>
                                    <p class="without-margin with-margin-top text-right">
                                        <a href="{{ route('platform.notifications.edit', $notification->id) }}" class="btn btn-sm btn-round btn-round-blue">Editar Notificación</a>
                                    </p>
                                </div>
                            @endforeach
                        @else
                            <div class="list-group-item">
                                <div class="alert alert-warning">
                                    No tiene notificaciones registradas
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection