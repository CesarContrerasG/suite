@extends('suite.esuite')

@section('html-title')
    Qore - Editar Forma de Pago
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}">Administración</a></li>
    <li><a href="{{ route('qore.catalogs.index') }}">Catálogos Oficiales</a></li>
    <li><a href="{{ route('qore.catalogs.payments.index') }}">Formas de Pago</a></li>
    <li>Editar Forma de Pago</li>
@endsection

@section('content')
    <div class="row" style="display:flex;">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Formar de Pago
                </div>
                <div class="panel-body">
                    {!! Form::model($payment, ["route" => ["qore.catalogs.payments.update", $payment], 'method' => 'PUT']) !!}
                    @include('Qore.catalogs.payments.form')
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                        {!! Form::close() !!}
                            @include('Qore.catalogs.payments.delete')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
