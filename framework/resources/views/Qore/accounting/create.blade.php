@extends('suite.esuite')

@section('html-title')
    Qore - Nuevo Registro
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
    <li><a href="{{ route('qore.accounting.index') }}">Registros Contables</a></li>
    <li>Nuevo Registro Contable</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('Qore.partials.sidebar_accounts')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo Registro</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'qore.accounting.store', 'method' => 'POST', 'role' => 'form', 'files' => true]) !!}
                        @include('Qore.accounting.partials.form')
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                {!! Form::submit('Guardar Registro', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.nice-select.min.js')  }}" charset="utf-8"></script>
    <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('select').niceSelect();
            $('.dates').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        });
    </script>
@endsection