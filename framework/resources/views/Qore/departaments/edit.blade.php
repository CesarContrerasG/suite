@extends('suite.esuite')

@section('html-title')
    Qore - Editar Departamento
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}"><i class="icon-icon"></i>Administración</a></li>
    <li><a href="{{ route('qore.departaments.index') }}">Departamentos</a></li>
    <li>Editar Departamento</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar informaión del Departamento
                </div>
                <div class="panel-body">
                    {!! Form::model($departament, ['route' => ['qore.departaments.update', Hashids::encode($departament->id)], 'method' => 'PUT']) !!}
                    @include('Qore.departaments.partials.form')
                    <div class="col-md-12 text-right">
                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar Cambios</button>
                            <a href="{{ route('qore.departaments.index') }}"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Cancelar</button></a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
