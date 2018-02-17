@extends('layouts.qore')

@section('htmlheader_title')
    Qore - Pagos del Contrato
@endsection

@section('header')
    @include('Headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.accounts') }}"><i class="icon-dollar-symbol"></i>Cuentas</a></li>
    <li><a href="{{ route('qore.contracts.index') }}">Contratos</a></li>
    <li>Archivos del Contrato con {{ $contract->company->name }}</li>
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="notification_bar animated fadeInRight">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif

    <div class="row" style="display:flex;">
        <div class="col-sm-4">
            <div class="modules">
                @include('Qore.partials.sidebar_accounts')
            </div>
        </div>
        <div class="col-sm-8">
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content_homestead">
                            <div class="row panel without-margin without-border">
                                <div class="col-md-12 with-border-bottom with-padding without-margin">
                                    <p class="text-xs">Detalles del Contrato</p>
                                </div>
                                <div class="col-md-6 with-padding">
                                    <p class="with-margin-xs"><strong>Contrato con: {{ $contract->company->business_name }}</strong></p>
                                    <p class="with-margin-xs">Fecha de Inicio: <strong class="text-primary">{{ $contract->dates->opening_date }}</strong></p>
                                    <p class="with-margin-xs">Fecha de Cierre: <strong class="text-primary">{{ $contract->dates->ending_date }}</strong></p>
                                </div>
                                <div class="col-md-6 with-padding with-border-left">
                                    <p class="with-margin-xs">El presente contrato consta de los servicios que se enlistan a continuación:</p>
                                    @foreach($contract->details as $detail)
                                        <p class="with-margin-xs"><strong>{{ $detail->service->name }}</strong></p>
                                    @endforeach
                                </div>
                            </div>

                            <div class="divider">
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::open(['route' => ['qore.receivables.files.store', Hashids::encode($contract->id)], 'method' => 'POST', 'files' => true, 'class' => 'form row without-border']) !!}
                                        <div class="col-md-6">
                                            <div class="form_group{{ $errors->has('concept') ? ' has-error' : '' }}">
                                                {!! Form::label('concept', 'Concepto') !!}
                                                {!! Form::text('concept', null, ['class' => 'form_control']) !!}
                                                @if ($errors->has('concept'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('concept') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form_group{{ $errors->has('emition_date') ? ' has-error' : '' }}">
                                                {!! Form::label('emition_date', 'Fecha de Emición') !!}
                                                {!! Form::text('emition_date', null, ['class' => 'form_control', 'id' => 'emition_date']) !!}
                                                @if ($errors->has('emition_date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('emition_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form_group{{ $errors->has('description') ? ' has-error' : '' }}">
                                                {!! Form::label('description', 'Descripción') !!}
                                                {!! Form::textarea('description', null, ['class' => 'form_control', 'rows' => 4]) !!}
                                                @if ($errors->has('description'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form_group{{ $errors->has('document') ? ' has-error' : '' }}">
                                                {!! Form::label('document', 'Documento') !!}
                                                {!! Form::file('document', ['class' => 'form_control']) !!}
                                                @if ($errors->has('document'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('document') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form_group">
                                                {!! Form::hidden('contract_id', $contract->id) !!}
                                                @if ($errors->has('contract_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('contract_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12 text_right">
                                            <div class="form_group">
                                                {!! Form::submit('Guardar', ['class' => 'btn btn-default btn-xs success']) !!}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>

                            <div class="row">
                                @if(count($contract->files))
                                    <div class="collection">
                                        @foreach ($contract->files as $file)
                                            <div class="collection_item row">
                                                <div class="collection_name col-md-5">
                                                    <h3>{{ $file->concept}}</h3>
                                                    <p>{{ $file->description }}</p>
                                                </div>
                                                <div class="collection_register col-md-3">
                                                    <h3 class="text_center">Fecha de Emición</h3>
                                                    <p class="text_center">{{ $file->emition_date }}</p>
                                                </div>
                                                <div class="collection_register col-md-2">
                                                    <h3 class="text_center text-lg"><a href="{{ route('qore.receivables.files.download', $file) }}"><i class="icon-file"></i></a></h3>
                                                </div>
                                                <div class="collection_options col-md-2">
                                                    <a href="#">
                                                        <i class="circle-blue"></i>
                                                        <span>Editar</span>
                                                    </a>
                                                    <a href="#">
                                                        <i class="circle-red"></i>
                                                        <span>Eliminar</span>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <strong><i class="icon-alert"></i> Advertencia.</strong> Usted no tiene documentos registrados para este contrato.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#emition_date').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    </script>
@endsection
