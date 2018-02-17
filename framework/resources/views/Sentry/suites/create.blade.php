@extends('suite.sentry')

@section('html-title')
    Asociar Aplicación
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('sentry.masters.index') }}">Cuentas Maestras</a></li>
    <li>Asociar Aplicaciones</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Asociar Aplicaciones</strong>
            </div>
            <div class="panel-body">
                {!! Form::open(['route' => 'sentry.suites.store', 'method' => 'POST', 'class' => 'form form_setup none-padding']) !!}
                    <div class="col-md-12 with-padding-vertical">
                        <div class="form-group">
                            {!! Form::label('master_id', 'Cuenta Maestra') !!}
                            {!! Form::select('master_id', $masters, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-12 with-padding-vertical">
                        <div class="form-group">
                            {!! Form::label('module_id', 'Aplicación') !!}
                            @if(count($modules) > 0)
                                {!! Form::select('module_id', $modules, null, ['class' => 'form-control']) !!}
                            @else
                                <select>
                                    <option data-display="Nothing">Ningún Módulo por Asociar</option>
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::hidden('active', 1) !!}
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="form-group">
                            {!! Form::submit('Asociar Aplicación', ['class' =>'btn btn-default btn-sm btn-round']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</div>
@endsection


@section('scripts')
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select').niceSelect();
        });
    </script>
@endsection
