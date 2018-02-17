<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Configuraciones de la Suite</div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('prefix_db') ? ' has-error' : '' }}">
                    {!! Form::label('prefix_db', 'Prefijo de la Base de Datos') !!}
                    {!! Form::text('prefix_db', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('prefix_db'))
                        <span class="help-block">
                <strong>{{ $errors->first('prefix_db') }}</strong>
            </span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('iva') ? ' has-error' : '' }}">
                    {!! Form::label('iva', 'IVA') !!}
                    {!! Form::number('iva', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('iva'))
                        <span class="help-block">
                <strong>{{ $errors->first('iva') }}</strong>
            </span>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group{{ $errors->has('notifications_days') ? ' has-error' : '' }}">
                    {!! Form::label('notifications_days', 'Dias de Notificación') !!}
                    {!! Form::number('notifications_days', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('notifications_days'))
                        <span class="help-block">
                <strong>{{ $errors->first('notifications_days') }}</strong>
            </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Configuraciones de Personalización</div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('website', 'Sitio Web') !!}
                    {!! Form::text('website', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('primary_color', 'Color Primario') !!}
                    {!! Form::input('color', 'primary_color', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('secundary_color', 'Color Secundario') !!}
                    {!! Form::input('color', 'secundary_color', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Configuración de Contactos</div>
        <div class="panel-body">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('contact_support', 'Contacto de Soporte') !!}
                    {!! Form::text('contact_support', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('email_support', 'Email Contacto de Soporte') !!}
                    {!! Form::email('email_support', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('contact_sales', 'Contacto de Ventas') !!}
                    {!! Form::text('contact_sales', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('email_sales', 'Email Contacto de Ventas') !!}
                    {!! Form::email('email_sales', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('contact_admon', 'Contacto de Administración') !!}
                    {!! Form::text('contact_admon', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('email_admon', 'Email Contacto de Administración') !!}
                    {!! Form::email('email_admon', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Configuraciones Extra</div>
        <div class="panel-body">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('to_company', 'Configuración Para:') !!}
                    {!! Form::select('to_company', $clients, null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('sector', 'Sector') !!}
                    {!! Form::select('sector', [0 => 'No Especificar', 1 => 'Agricola', 2 => 'Aeronutica', 3 => 'Automotriz',4 => 'Autopartes', 5 => 'Manufactura', 6 => 'Reamanufactura', 7 => 'Servicios', 8 => 'Otro'], null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
