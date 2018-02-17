@extends('suite.esuite')

@section('html-title')
    COVE - Registrar Nuevo Proveedor
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('dist/css/chosen.min.css')}}">
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection


@section('breadcrumb')
    <li><a href="{{ route('cove.catalogs.index') }}"><i class="icon-icon"></i>Catálogos</a></li>
    <li><a href="{{ route('cove.providers.index') }}">Proveedores</a></li>
    <li>Registrar Nuevo Proveedor</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Cove.partials.sidebar_catalogs')
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Nuevo Proveedor
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'cove.providers.store', 'method' => 'POST', 'files' => true]) !!}
                        @include('Cove.providers.partials.form')
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar</button>
                                <a href="{{ route('cove.providers.index') }}"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Cancelar</button></a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection


