@extends('suite.esuite')

@section('html-title')
    RECOVE - Configuración FTP
@endsection

@section('header')
    @include('suite.partials.headers.recove')
@endsection

@section('breadcrumb')
    <li><a href="#">Dashboard</a></li>
    <li>Configuración FTP</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-red">
                        <div class="flex-box">
                            <div><i class="icon-folder-download"></i></div>
                            <div>
                                <h3>Configuración Almacenamiento</h3>
                                <p>Almacena tu información en tu Servidor o Carpeta Local.</p>
                            </div>
                        </div>
                    </div>
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
