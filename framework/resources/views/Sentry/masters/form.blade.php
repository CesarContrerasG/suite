<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Datos Generales</strong>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Nombre Comercial</label>
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'autocomplete']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('rfc') ? ' has-error' : '' }}">
                    <label for="rfc">RFC</label>
                    {!! Form::text('rfc', null, ['class' => 'form-control', 'id' => 'field_rfc']) !!}
                    @if ($errors->has('rfc'))
                        <span class="help-block">
                            <strong>{{ $errors->first('rfc') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('curp') ? ' has-error' : '' }}">
                    <label for="curp">CURP</label>
                    {!! Form::text('curp', null, ['class' => 'form-control', 'id' => 'field_curp']) !!}
                    @if ($errors->has('curp'))
                        <span class="help-block">
                            <strong>{{ $errors->first('curp') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                    <label for="businesss_name">Razón Social</label>
                    {!! Form::text('business_name', null, ['class' => 'form-control', 'id' => 'field_business_name']) !!}
                    @if ($errors->has('business_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('business_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('sector') ? ' has-error' : '' }}">
                    <label for="sector">Sector</label>
                    {!! Form::select('sector', [1 => 'Agricola', 2 => 'Aeronutica', 3 => 'Automotriz',4 => 'Autopartes', 5 => 'Manufactura', 6 => 'Reamanufactura', 7 => 'Servicios', 8 => 'Otro'],null, ['class' => 'form-control', 'id' => 'field_sector']) !!}
                    @if ($errors->has('sector'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sector') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                    <label for="logo">Logotipo</label>
                    {!! Form::file('logo', ['class' => 'form-control']) !!}
                    @if ($errors->has('logo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('logo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('db') ? ' has-error' : '' }}">
                    <label for="db">Base de datos</label>
                    {!! Form::text('db', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('db'))
                        <span class="help-block">
                            <strong>{{ $errors->first('db') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form_group">
                    {!! Form::hidden('privileges', 1) !!}
                    {!! Form::hidden('type', 0) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Ubicación</strong>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address">Calle</label>
                    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'field_address']) !!}
                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('colony') ? ' has-error' : '' }}">
                    <label for="colony">Colonia</label>
                    {!! Form::text('colony', null, ['class' => 'form-control', 'id' => 'field_colony']) !!}
                    @if ($errors->has('colony'))
                        <span class="help-block">
                            <strong>{{ $errors->first('colony') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                    <label for="location">Localidad</label>
                    {!! Form::text('location', null, ['class' => 'form-control', 'id' => 'field_location']) !!}
                    @if ($errors->has('location'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('outdoor') ? ' has-error' : '' }}">
                    <label for="outdoor">No. Exterior</label>
                    {!! Form::text('outdoor', null, ['class' => 'form-control', 'id' => 'field_outdoor']) !!}
                    @if ($errors->has('outdoor'))
                        <span class="help-block">
                            <strong>{{ $errors->first('outdoor') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('interior') ? ' has-error' : '' }}">
                    <label for="interior">No. Interior</label>
                    {!! Form::text('interior', null, ['class' => 'form-control', 'id' => 'field_interior']) !!}
                    @if ($errors->has('interior'))
                        <span class="help-block">
                            <strong>{{ $errors->first('interior') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('pcode') ? ' has-error' : '' }}">
                    <label for="pcode">C.P.</label>
                    {!! Form::text('pcode', null, ['class' => 'form-control', 'id' => 'pcode']) !!}
                    @if ($errors->has('pcode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pcode') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('town') ? ' has-error' : '' }}">
                    <label for="town">Ciudad</label>
                    {!! Form::text('town', null, ['class' => 'form-control', 'id' => 'field_town']) !!}
                    @if ($errors->has('town'))
                        <span class="help-block">
                            <strong>{{ $errors->first('town') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                    <label for="state">Estado</label>
                    {!! Form::text('state', null, ['class' => 'form-control', 'id' => 'field_state']) !!}
                    @if ($errors->has('state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                    <label for="country">Pais</label>
                    {!! Form::select('country', $countries, null, ['class' => 'form-control', 'id' => 'field_country']) !!}
                    @if ($errors->has('country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Contacto</strong>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                    <label for="contact">Email de Contacto</label>
                    {!! Form::email('contact', null, ['class' => 'form-control', 'id' => 'field_contact']) !!}
                    @if ($errors->has('contact'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('contact') }}</strong>
                                </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone">Teléfono</label>
                    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'field_phone']) !!}
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('registered', 0, ['id' => 'field_registered']) !!}

</div>
