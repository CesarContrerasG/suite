@extends('suite.esuite')

@section('html-title')
    Qore - Editar Aduana
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}">Administración</a></li>
    <li><a href="{{ route('qore.catalogs.index') }}">Catálogos Oficiales</a></li>
    <li><a href="{{ route('qore.catalogs.aduana.index') }}">Aduanas</a></li>
    <li>Editar Aduana</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Aduana
                </div>
                <div class="panel-body">
                    {!! Form::model($aduana, ["route" => ["qore.catalogs.aduana.update", $aduana], 'method' => 'PUT']) !!}
                    @include('Qore.catalogs.aduanas.form')
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-default btn-sm btn-round']) !!}
                            {!! Form::close() !!}
                            @include('Qore.catalogs.aduanas.delete')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
