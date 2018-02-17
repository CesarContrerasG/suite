@extends('suite.esuite')

@section('html-title')
    COVE - Editar Cliente
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('dist/css/chosen.min.css')}}">
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection


@section('breadcrumb')
    <li><a href="{{ route('cove.catalogs.index') }}"><i class="icon-icon"></i>Catálogos</a></li>
    <li><a href="{{ route('cove.customers.index') }}">Clientes</a></li>
    <li>Editar Cliente</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Cove.partials.sidebar_catalogs')
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Cliente
                </div>
                <div class="panel-body">
                    {!! Form::model($customer, ['route' => ['cove.customers.update', $customer->pk_item], 'method' => 'PUT', 'class' => 'form']) !!}                                        
                        @include('Cove.customers.partials.form')
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar</button>
                                <a href="{{ route('cove.customers.index') }}"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Cancelar</button></a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection


