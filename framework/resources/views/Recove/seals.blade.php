@extends('suite.esuite')

@section('html-title')
    RECOVE - Catálogos Oficiales
@endsection

@section('html-head')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('header')
    @include('suite.partials.headers.recove')
    
@endsection


@section('breadcrumb')
    <li><a href="#">Dashboard</a></li>
    <li>Sellos Digitales</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-red">
                        <div class="flex-box">
                            <div><i class="icon-qrcode"></i></div>
                            <div>
                                <h3>Sellos Digitales</h3>
                                <p>Puede cargar sellos digitales proporcionados por el SAT</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">                             
                    @if(is_null($seal))
                        {!! Form::open(['route' => 'recove.seals.store','enctype' => 'multipart/form-data']) !!}
                            @include('Recove.partials.seals')
                        {!! Form::close() !!}
                    @else
                        {!! Form::model($seal, ['method' => 'PUT','route' => ['recove.seals.update', $seal->pk_item], 'enctype' => 'multipart/form-data']) !!}
                            @include('Recove.partials.seals')
                        {!! Form::close() !!}        
                    @endif   
                </div>              
            </div> 
        </div>
    </div>
@endsection
