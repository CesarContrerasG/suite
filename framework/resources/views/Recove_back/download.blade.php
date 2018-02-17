@extends('suite.esuite')

@section('html-title')
    RECOVE - Configuración FTP
@endsection

@section('header')
    @include('suite.partials.headers.recove')
@endsection


@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Configuración de carpeta de descarga
                </div>
                <div class="panel-body">
                    @if(is_null($path))
                    {!! Form::open(['route' => 'recove.download.store','enctype' => 'multipart/form-data']) !!}
                        @include('Recove.partials.download')
                    {!! Form::close() !!}
                    @else
                    {!! Form::model($path, ['method' => 'PUT','route' => ['recove.download.update', $path->id], 'enctype' => 'multipart/form-data']) !!}
                    @include('Recove.partials.download')
                    {!! Form::close() !!}        
                    @endif 
                </div>
            </div>
        </div>
    </div>
@endsection
