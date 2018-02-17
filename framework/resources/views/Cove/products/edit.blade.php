@extends('suite.esuite')

@section('html-title')
    COVE - Editar Producto
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/snippets-datepicker-purple.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection


@section('breadcrumb')
    <li><a href="{{ route('cove.catalogs.index') }}"><i class="icon-icon"></i>Catálogos</a></li>
    <li><a href="{{ route('cove.products.index') }}">Productos</a></li>
    <li>Editar Product</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Cove.partials.sidebar_catalogs')
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Product
                </div>
                <div class="panel-body">
                    {!! Form::model($product, ['route' => ['cove.products.update', $product->pk_item], 'method' => 'PUT', 'class' => 'form']) !!}                                        
                        @include('Cove.products.partials.form')
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar</button>
                                <a href="{{ route('cove.products.index') }}"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Cancelar</button></a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection


