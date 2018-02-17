@extends('suite.esuite')

@section('html-title')
    Qore - Proveedores
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}"><i class="icon-icon"></i>Administración</a></li>
    <li>Proveedores</li>
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
                            <div><i class="icon-dropbox"></i></div>
                            <div>
                                <h3>Proveedores</h3>
                                <p>Empresas que nos ofrecen sus Servicios</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group">
                    <div class="list-group-item text-right">
                        <a href="{{ route('qore.providers.create') }}" class="btn btn-default btn-sm btn-round">agregar proveedor</a>
                    </div>
                    @include('Qore.providers.partials.grid')
                </div>
            </div>
        </div>

    </div>
@endsection
