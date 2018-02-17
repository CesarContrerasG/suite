@extends('suite.esuite')

@section('html-title')
    Qore - Prospectos
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}"><i class="icon-icon"></i>Administración</a></li>
    <li>Prospectos</li>
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
                            <div><i class="icon-user-check"></i></div>
                            <div>
                                <h3>Prospectos</h3>
                                <p>Empresas que son <strong>target</strong> de nuestros Servicios</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group">
                    <div class="list-group-item text-right">
                        <a href="{{ route('qore.prospects.create') }}" class="btn btn-default btn-sm btn-round">Agregar Prospecto</a>
                    </div>
                    @include('Qore.prospects.partials.grid')
                </div>
            </div>
        </div>
    </div>
@endsection
