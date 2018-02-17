@extends('suite.esuite')

@section('html-title')
    COVE - Editar Material
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
    <li><a href="{{ route('cove.materials.index') }}">Materiales</a></li>
    <li>Editar Material</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Cove.partials.sidebar_catalogs')
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Material
                </div>
                <div class="panel-body">
                    {!! Form::model($material, ['route' => ['cove.materials.update', $material->pk_item], 'method' => 'PUT', 'class' => 'form']) !!}                                        
                        @include('Cove.materials.partials.form')
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar</button>
                                <a href="{{ route('cove.materials.index') }}"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Cancelar</button></a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection


