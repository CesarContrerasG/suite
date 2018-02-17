@extends('suite.enterprise')

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ route('platform.notifications.index') }}">Notificaciones</a></li>
    <li>Editar Notificación</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                @include('Platform.enterprise.panel-master')
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Notificación</div>
                    <div class="panel-body">
                        {!! Form::model($notification, ['route' => ['platform.notifications.update', $notification], 'method' => 'PUT']) !!}
                        @include('Platform.notifications.form')
                        {!! Form::hidden('master_id', auth()->user()->current_master->id) !!}
                        <div class="col-md-12">
                            <div class="form-group text-right">
                                {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-sm btn-round btn-round-green']) !!}
                                {!! Form::close() !!}
                                @include('Platform.notifications.delete')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection