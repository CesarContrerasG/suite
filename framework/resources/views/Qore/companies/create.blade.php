@extends('suite.esuite')

@section('html-title')
    Qore - Registrar Nuevo Cliente
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}"><i class="icon-icon"></i>Administración</a></li>
    <li><a href="{{ route('qore.companies.index') }}">Clientes</a></li>
    <li>Registrar Nuevo Cliente</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Nuevo Cliente
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'qore.companies.store', 'method' => 'POST', 'files' => true]) !!}
                        @include('Qore.companies.partials.form')
                        {!! Form::hidden('type', 1) !!}
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar</button>
                                <a href="{{ route('qore.companies.index') }}"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Cancelar</button></a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.autocomplete.min.js') }}" charset="utf-8"></script>
    @include('Qore.partials.script-autocomplete-companies')
@endsection
