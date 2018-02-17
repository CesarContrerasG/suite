@extends('suite.esuite')

@section('html-title')
    Qore - Editar Medio de Transporte
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}">Administración</a></li>
    <li><a href="{{ route('qore.catalogs.index') }}">Catálogos Oficiales</a></li>
    <li><a href="{{ route('qore.catalogs.transports.index') }}">Medios de Transporte</a></li>
    <li>Editar Medio de Transporte</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Medio de Transporte
                </div>
                <div class="panel-body">
                    {!! Form::model($transport, ["route" => ["qore.catalogs.transports.update", $transport], 'method' => 'PUT']) !!}
                    @include('Qore.catalogs.transports.form')
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                            {!! Form::close() !!}
                            @include('Qore.catalogs.transports.delete')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
