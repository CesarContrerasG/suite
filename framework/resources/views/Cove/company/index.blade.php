@extends('suite.esuite')

@section('html-title')
    COVE - Empresa
@endsection

@section('html-head')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection


@section('header')
    @include('suite.partials.headers.cove')
@endsection


@section('breadcrumb')
    <li><a href="{{ route('cove.catalogs.index') }}">Catálogos</a></li>
    <li>Empresa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Cove.partials.sidebar_catalogs')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-purple">
                        <div class="flex-box">
                            <div><i class="icon-office"></i></div>
                            <div>
                                <h3>Empresa</h3>
                                <p>Información general de la empresa</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="panel-body">
                        <div>
                            <ul class="nav nav-tabs suite-tabs-purple" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#data" aria-controls="data" role="tab" data-toggle="tab">Datos Generales</a>
                                </li>
                                <li role="presentation">
                                    <a href="#seal" aria-controls="seal" role="tab" data-toggle="tab">Sellos Digitales</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="data">
                                    <div class="with-padding">
                                        @if(isset($company))
                                        {!! Form::model($company, ['route' => ['cove.company.update', Hashids::encode($company->id)], 'method' => 'PUT', 'class' => 'form']) !!}        
                                        @endif
                                        @include('Cove.company.partials.form')
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="seal">
                                    <div class="with-padding">                                        
                                        @if(isset($seal))
                                        {!! Form::model($seal, ['route' => ['cove.seal.update', $seal->pk_item], 'method' => 'PUT', 'class' => 'form', 'files' => true]) !!}     
                                        @else
                                        {!! Form::open(['route' => 'cove.seal.store', 'method' => 'POST', 'files' => true]) !!}  
                                        @endif
                                        @include('Cove.company.partials.seals')
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection