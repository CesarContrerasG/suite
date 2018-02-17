@extends('suite.esuite')

@section('html-title')
    Qore - Editar Clave de Moneda
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}">Administración</a></li>
    <li><a href="{{ route('qore.catalogs.index') }}">Catálogos Oficiales</a></li>
    <li><a href="{{ route('qore.catalogs.currencies.index') }}">Claves de Monedas</a></li>
    <li>Editar Clave de Moneda</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Clave de Moneda
                </div>
                <div class="panel-body">
                    {!! Form::model($currency, ["route" => ["qore.catalogs.currencies.update", $currency], 'method' => 'PUT']) !!}
                    @include('Qore.catalogs.currencies.form')
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                            {!! Form::close() !!}
                            @include('Qore.catalogs.currencies.delete')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
