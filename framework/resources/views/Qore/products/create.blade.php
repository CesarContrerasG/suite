@extends('suite.esuite')

@section('html-title')
    Qore - Registrar Producto o Servicio
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}"><i class="icon-icon"></i>Administración</a></li>
    <li><a href="{{ route('qore.products.index') }}">Productos & Servicios</a></li>
    <li>Registrar Producto o Servicio</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registrar nuevo producto
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'qore.products.store']) !!}
                        @include('Qore.products.partials.form')
                    {!! Form::close() !!}
                </div>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.nice-select.min.js')  }}"></script>
    <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
         $('select').niceSelect();
         $('#date_start').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
         $('#date_end').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    </script>
@endsection
