@extends('suite.esuite')

@section('html-title')
    COVE - Crear COVE
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/snippets-datepicker-purple.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection


@section('breadcrumb')
    <li><a href="{{ route('cove.administration.index') }}"><i class="icon-icon"></i>Administracion</a></li>
    <li>Crear COVE</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Crear COVE
                </div>
                <div class="panel-body">
                    <div class="row">
                        {!! Form::open(['route' => 'cove.store', 'method' => 'POST', 'class' => 'form']) !!}                      
                        @include('Cove.administration.partials.general')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{ asset('dist/js/chosen.jquery.min.js') }}"></script>
    
    <script type="text/javascript">
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        });
        $('#cove_fecha').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        
    </script>
@endsection
