@extends('suite.sentry')

@section('html-title')
    Editar Cuenta Maestra
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('sentry.masters.index') }}">Cuentas Maestras</a></li>
    <li>Editar Cuenta Maestra</li>
@endsection

@section('content')
    <div class="row">
        {!! Form::model($master->company, ['route' => ['sentry.masters.update', \Hashids::encode($master->id)], 'method' => 'PUT', 'class' => 'form form_setup none-padding', 'files' => true]) !!}
        @include('Sentry.masters.form')
        <div class="col-md-12 text-right">
            <div class="form-group">
                {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-default btn-sm btn-round']) !!}
        {!! Form::close() !!}
                @include('Sentry.masters.delete')
            </div>
        </div>
    </div>
@endsection
