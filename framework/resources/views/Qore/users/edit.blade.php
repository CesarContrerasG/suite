@extends('suite.esuite')

@section('html-title')
    Qore - Editar Usuario
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
    <li>Editar Usuario</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Información del Usuario
                </div>
                <div class="panel-body">
                    {!! Form::model($user, ['route' => ['qore.users.update', Hashids::encode($user->id)], 'method' => 'PUT', 'files' => true]) !!}
                    <div class="row">
                        @include('Qore.users.partials.form')
                        <div class="col-md-12">
                            <div class="form-group text-right">
                                {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
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
