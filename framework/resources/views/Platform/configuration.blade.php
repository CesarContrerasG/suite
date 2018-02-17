@extends('suite.enterprise')

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}">Home</a></li>
    <li>Configuraciones</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                @include('Platform.enterprise.panel-master')
            </div>

            <div class="col-md-8">
                {!! Form::model($configuration, ['url' => 'configuration', 'method' => 'POST']) !!}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="widget-title widget-title-green">
                            <div class="flex-box">
                                <div><i class="icon-palette"></i></div>
                                <div>
                                    <h3>Personalización</h3>
                                    <p>Configuración de Color y Sitio Web de la Cuenta Maestra</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                {!! Form::label('website', 'Sitio Web') !!}
                                {!! Form::text('website', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('primary_color') ? ' has-error' : '' }}">
                                {!! Form::label('primary_color', 'Color Primario') !!}
                                {!! Form::input('color', 'primary_color', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('primary_color'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('primary_color') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('secundary_color') ? ' has-error' : '' }}">
                                {!! Form::label('secundary_color', 'Color Secundario') !!}
                                {!! Form::input('color', 'secundary_color', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('secundary_color'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('secundary_color') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="widget-title widget-title-green">
                            <div class="flex-box">
                                <div><i class="icon-phone"></i></div>
                                <div>
                                    <h3>Contacto & Soporte</h3>
                                    <p>Configuración de cuentas para el contacto y soporte del cliente</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('contact_support') ? ' has-error' : '' }}">
                                {!! Form::label('contact_support', 'Contacto de Soporte') !!}
                                {!! Form::text('contact_support', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('contact_support'))
                                    <span class="contact_support">
                                        <strong>{{ $errors->first('contact_support') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('email_support') ? ' has-error' : '' }}">
                                {!! Form::label('email_support', 'Email Contacto de Soporte') !!}
                                {!! Form::email('email_support', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('email_support'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_support') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('contact_sales') ? ' has-error' : '' }}">
                                {!! Form::label('contact_sales', 'Contacto de Ventas') !!}
                                {!! Form::text('contact_sales', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('contact_sales'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_sales') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('email_sales') ? ' has-error' : '' }}">
                                {!! Form::label('email_sales', 'Email Contacto de Ventas') !!}
                                {!! Form::email('email_sales', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('email_sales'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_sales') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('contact_admon') ? ' has-error' : '' }}">
                                {!! Form::label('contact_admon', 'Contacto de Administración') !!}
                                {!! Form::text('contact_admon', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('contact_admon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_admon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('email_admon') ? ' has-error' : '' }}">
                                {!! Form::label('email_admon', 'Email Contacto de Administración') !!}
                                {!! Form::email('email_admon', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('email_admon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_admon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::hidden('master_id', auth()->user()->id) !!}
                                @if ($errors->has('master_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('master_id') }}</strong>
                                    </span>
                                @endif
                                {!! Form::hidden('configuration_id', $configuration->id) !!}
                                @if ($errors->has('configuration_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('configuration_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-right">
                            {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-default btn-sm btn-round btn-round-blue']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection