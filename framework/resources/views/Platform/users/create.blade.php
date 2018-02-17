@extends('suite.enterprise')

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
@endsection

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ route('platform.users.index') }}">Usuarios</a></li>
    <li>Registar Usuario</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                @include('Platform.enterprise.panel-master')
            </div>

            <div class="col-md-8">
            	<div class="panel panel-default">
                    <div class="panel-heading">Registrar Usuario</div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'platform.users.store', 'method' => 'POST', 'role' => 'form', 'files' => true]) !!}
                            @if($master)
                                @include('Qore.users.partials.form')
                            @else
                                @include('Platform.users.partials.form')
                            @endif
                            <div class="col-md-12 text-right">
                                <div class="form-group">
                                    {!! Form::submit('Guardar Usuario', ['class' => 'btn btn-default btn-sm btn-round btn-round-green']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
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