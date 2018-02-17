@extends('suite.esuite')

@section('html_title')
    Qore - Editar Cliente
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}"></i>Administración</a></li>
    <li><a href="{{ route('qore.companies.index') }}">Clientes</a></li>
    <li>Editar Cliente</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Datos del Cliente
                </div>
                <div class="panel-body">
                    {!! Form::model($company,['route' => ['qore.companies.update', Hashids::encode($company->id)],'method' => 'PUT', 'files' => true]) !!}
                        @include('Qore.companies.partials.form')
                        {!! Form::hidden('type', 1) !!}
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar Cambios</button>
                                <a href="{{ route('qore.companies.index') }}"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Cancelar</button></a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
