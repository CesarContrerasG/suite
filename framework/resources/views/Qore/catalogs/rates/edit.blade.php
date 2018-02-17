@extends('suite.esuite')

@section('html-title')
    Qore - Editar Tipo de Tasa
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}">Administración</a></li>
    <li><a href="{{ route('qore.catalogs.index') }}">Catálogos Oficiales</a></li>
    <li><a href="{{ route('qore.catalogs.rates.index') }}">Tipos de Tasas</a></li>
    <li>Editar Tipo de Tasa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('Qore.partials.sidebar_administration')
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Tipo de Tasa
                </div>
                <div class="panel-body">
                    {!! Form::model($rate, ["route" => ["qore.catalogs.rates.update", $rate], 'method' => 'PUT']) !!}
                    @include('Qore.catalogs.rates.form')
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                            {!! Form::close() !!}
                            @include('Qore.catalogs.rates.delete')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
