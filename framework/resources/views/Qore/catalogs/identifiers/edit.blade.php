@extends('suite.esuite')

@section('html-title')
    Qore - Editar Identificador
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}">Administración</a></li>
    <li><a href="{{ route('qore.catalogs.index') }}">Catálogos Oficiales</a></li>
    <li><a href="{{ route('qore.catalogs.identifiers.index') }}">Identificadores</a></li>
    <li>Editar Identificador</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Identificador
                </div>
                <div class="panel-body">
                    {!! Form::model($identifier, ["route" => ["qore.catalogs.identifiers.update", $identifier], 'method' => 'PUT']) !!}
                    @include('Qore.catalogs.identifiers.form')
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                            {!! Form::close() !!}
                            @include('Qore.catalogs.identifiers.delete')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
