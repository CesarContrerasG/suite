@extends('suite.esuite')

@section('html-title')
    Qore - Usuarios
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}"><i class="icon-icon"></i>Administración</a></li>
    <li>Usuarios</li>
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="notification_bar animated fadeInRight">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-green">
                        <div class="flex-box">
                            <div><i class="icon-users"></i></div>
                            <div>
                                <h3>Usuarios</h3>
                                <p>Usuarios registrados usando la Suite de {{ auth()->user()->current_master->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item text-right">
                        <a href="{{ route('qore.users.create') }}" class="btn btn-default btn-sm btn-round">Agregar Usuario de {{ auth()->user()->current_master->name }}</a>
                        <a href="{{ route('qore.users.client.create') }}" class="btn btn-default btn-sm btn-round">Agregar Cliente</a>
                    </li>
                    @include('Qore.users.partials.grid')
                </ul>
            </div>
        </div>
        
    </div>
@endsection
