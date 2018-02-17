@extends('suite.enterprise')

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ route('platform.notifications.index') }}">Notificaciones</a></li>
    <li>Nueva Notificación</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                @include('Platform.enterprise.panel-master')
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear nueva Notificación</div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'platform.notifications.store', 'method' => 'POST']) !!}
                        @include('Platform.notifications.form')
                        {!! Form::hidden('master_id', auth()->user()->current_master->id) !!}
                        <div class="col-md-12">
                            <div class="form-group text-right">
                                {!! Form::submit('Guardar Notificación', ['class' => 'btn btn-sm btn-round btn-round-green']) !!}
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
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
    <script>
        $('.dates').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    </script>
@endsection