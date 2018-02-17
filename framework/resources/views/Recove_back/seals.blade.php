@extends('suite.esuite')

@section('html-title')
    RECOVE - Catálogos Oficiales
@endsection

@section('header')
    @include('suite.partials.headers.recove')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Sellos Digitales
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
