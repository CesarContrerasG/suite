@extends('suite.esuite')

@section('html-title')
    Anexo 31 - Simulador
@endsection

@section('header')
    @include('suite.partials.headers.anexo31')
@endsection

@section('content')
   <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Inicia tu descargo
                </div>
                <div class="panel-body">  
                    {!! Form::open(['route' => ['anexo31.simulator.store'], 'method' => 'POST', 'files' => true]) !!}  
                        <label>Mes/Año</label>
                        {!! Form::select('month', [1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'] , ['class' => 'field']) !!}
                        {!! Form::selectYear('year', 2015, date('Y'), ['class' => 'field']) !!}
                        {!! Form::submit('iniciar', ['class' => 'btn btn-default success btn-xs']) !!}
                    {!! Form::close() !!} 
                </div>
            </div>
        </div>         
    </div>
@endsection