@extends('suite.esuite')

@section('html-title')
    Qore - Departamentos
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}"><i class="icon-icon"></i>Administración</a></li>
    <li>Departamentos</li>
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="notification_bar animated fadeInRight">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif

    <div class="row" style="display:flex;">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-green">
                        <div class="flex-box">
                            <div><i class="icon-contacts"></i></div>
                            <div>
                                <h3>Departamentos</h3>
                                <p>Sectores de especialización dentro de {{ auth()->user()->current_master->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group">
                    <div class="list-group-item text-right">
                        <a href="{{ route('qore.departaments.create') }}" class="btn btn-default btn-sm btn-round">Agregar Departamento</a>
                    </div>
                    @include('Qore.departaments.partials.grid')
                </div>
            </div>
        </div>

    </div>
@endsection
