@extends('suite.esuite')

@section('html-title')
    Qore - Administración
@endsection

@section('html-head')
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('js/chartjs.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><i class="icon icon-icon"></i>Administración</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-green">
                        <div class="flex-box">
                            <div><i class="icon-books"></i></div>
                            <div>
                                <h3>Administración</h3>
                                <p>Registros anuales del módulo (administración) en Qore.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">
                            {!! $chartjs->render() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="widget-board widget-board-green">
                        <div class="col-md-3 board-indicator">
                            <p class="without-margin">Productos o Servicios</p>
                            <h3 class="without-margin">{{ $products }}</h3>
                        </div>
                        <div class="col-md-3 board-indicator">
                            <p class="without-margin">Departamentos</p>
                            <h3 class="without-margin">{{ $departaments }}</h3>
                        </div>
                        <div class="col-md-3 board-indicator">
                            <p class="without-margin">Usuarios</p>
                            <h3 class="without-margin">{{ $users }}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
