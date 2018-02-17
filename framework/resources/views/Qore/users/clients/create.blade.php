@extends('suite.esuite')

@section('html-title')
    Qore - Registrar Nuevo Cliente
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}"><i class="icon-icon"></i>Administración</a></li>
    <li><a href="{{ route('qore.users.index') }}">Usuarios</a></li>
    <li>Registrar Nuevo Cliente</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registrar Nuevo Usuario
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'qore.users.store', 'method' => 'POST', 'files' => true]) !!}
                    <div class="row">
                        @include('Qore.users.clients.form')
                        <div class="col-md-12">
                            <div class="form-group text-right">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                                <a href="{{ route('qore.users.index') }}" class="btn btn-default btn-sm btn-round btn-round-danger">Cancelar</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('select').niceSelect();
        });
    </script>
@endsection
