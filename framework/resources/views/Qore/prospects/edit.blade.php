@extends('suite.esuite')

@section('html-title')
    Qore - Editar Prospecto
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}"><i class="icon-icon"></i>Administración</a></li>
    <li><a href="{{ route('qore.prospects.index') }}">Prospectos</a></li>
    <li>Editar Prospecto</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Información del Prospecto
                </div>
                <div class="panel-body">
                    {!! Form::model($company,['route' => ['qore.prospects.update', Hashids::encode($company->id)],'method' => 'PUT']) !!}
                    @include('Qore.prospects.partials.form')
                    {!! Form::hidden('type', 3) !!}
                    <div class="col-md-12 text-right">
                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar Cambios</button>
                            <a href="{{ route('qore.prospects.index') }}"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">cancelar</button></a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
