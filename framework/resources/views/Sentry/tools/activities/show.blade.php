@extends('suite.sentry')

@section('html-title')
    Actividad de {{ $user->fullname }}
@endsection

@section('html-head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('js/chartjs.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('sentry.tools.index') }}">Herramientas</a></li>
    <li><a href="{{ route('sentry.activities.index') }}">Registro de Actividades</a></li>
    <li>Actividad de {{ $user->fullname }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('Sentry.tools.partials.panel_toolbox')
        </div>

        <div class="col-md-8">
            @include('Sentry.tools.activities.panel_user')

            @include('Sentry.tools.activities.panel_chart')

            @include('Sentry.tools.activities.panel_table')

        </div>
    </div>
@endsection

@section('scripts')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
@include('Sentry.tools.activities.script_datatable')
@endsection
