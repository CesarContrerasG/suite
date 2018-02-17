@extends('suite.esuite')

@section('html-title')
    Qore -Editar Destino de Mercancia
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}">Administración</a></li>
    <li><a href="{{ route('qore.catalogs.index') }}">Catálogos Oficiales</a></li>
    <li><a href="{{ route('qore.catalogs.destinations.index') }}">Destinos de Mercancia</a></li>
    <li>Editar Destino</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Destino de Mercancia
                </div>
                <div class="panel-body">
                    {!! Form::model($destination, ["route" => ["qore.catalogs.destinations.update", $destination], 'method' => 'PUT']) !!}
                    @include('Qore.catalogs.destinations.form')
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                        {!! Form::close() !!}
                            @include('Qore.catalogs.destinations.delete')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
