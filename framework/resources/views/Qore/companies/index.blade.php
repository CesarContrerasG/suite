@extends('suite.esuite')

@section('html_title')
    Qore - Clientes
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}"><i class="icon-icon"></i>Administración</a></li>
    <li>Clientes</li>
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="notification_bar animated fadeInRight">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-green">
                        <div class="flex-box">
                            <div><i class="icon-address-book"></i></div>
                            <div>
                                <h3>Clientes</h3>
                                <p>Empresas con uso de nuestros productos o servicios</p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item text-right">
                        <a href="{{ route('qore.companies.create') }}" class="btn btn-default btn-sm btn-round">agregar cliente</a>
                    </li>
                    @include('Qore.companies.partials.grid')
                </ul>
            </div>
        </div>
    </div>
@endsection
