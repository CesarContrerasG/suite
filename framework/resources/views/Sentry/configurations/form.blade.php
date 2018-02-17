@extends('suite.sentry')

@section('html-title')
    Configuraciones
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('sentry.masters.index') }}">Cuentas Maestras</a></li>
    <li>Configuraciones de la Cuenta</li>
@endsection

@section('content')
    <div class="row">
        @if(count($configuration) > 0)
            @include('Sentry.configurations.edit')
        @else
            @include('Sentry.configurations.create')
        @endif
    </div>
@endsection
