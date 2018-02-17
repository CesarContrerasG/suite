@extends('suite.esuite')

@section('html-title')
    Qore - Editar Clave
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}">Administración</a></li>
    <li><a href="{{ route('qore.catalogs.index') }}">Catálogos Oficiales</a></li>
    <li><a href="{{ route('qore.catalogs.cpediments.index') }}">Claves de Pedimento</a></li>
    <li>Editar Clave</li>
@endsection

@section('content')
    <div class="row" style="display:flex;">
        <div class="col-md-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Clave de Pedimento
                </div>
                <div class="panel-body">
                    {!! Form::model($cpedimento, ["route" => ["qore.catalogs.cpediments.update", $cpedimento], 'method' => 'PUT']) !!}
                    @include('Qore.catalogs.claves_pedimento.form')
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                            {!! Form::close() !!}
                            @include('Qore.catalogs.claves_pedimento.delete')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
