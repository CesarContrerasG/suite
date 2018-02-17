@extends('suite.esuite')

@section('html-title')
    Qore - Productos & Servicios
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}">Administración</a></li>
    <li>Productos</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <div class="widget-title widget-title-green">
                        <div class="flex-box">
                            <div><i class="icon-briefcase"></i></div>
                            <div>
                                <h3>Productos & Servicios</h3>
                                <p>Productos y Servicios brindados por {{ auth()->user()->current_master->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item text-right">
                        <a href="{{ route('qore.products.create') }}" class="btn btn-default btn-sm btn-round">
                            agregar producto
                        </a>
                    </li>
                    @include('Qore.products.partials.grid')
                </ul>
            </div>
        </div>
    </div>
@endsection
