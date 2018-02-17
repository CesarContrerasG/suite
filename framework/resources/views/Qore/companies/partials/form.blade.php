    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-green{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Nombre Comercial</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'autocomplete']) !!}
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-green{{ $errors->has('rfc') ? ' has-error' : '' }}">
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
            <div class="form-group form-green">
                <label for="curp">CURP</label>
                {!! Form::text('curp', null, ['class' => 'form-control', 'id' => 'field_curp']) !!}
                @include('Qore.partials.errors', ['id' => 'curp'])
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-green{{ $errors->has('business_name') ? ' has-error' : '' }}">
                <label for="business_name">Razón Social</label>
                {!! Form::text('business_name', null, ['class' => 'form-control', 'id' => 'field_business_name']) !!}
                @if ($errors->has('business_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('business_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-green{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="address">Calle</label>
                {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'field_address']) !!}
                @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-green{{ $errors->has('colony') ? ' has-error' : '' }}">
                <label for="colony">Colonia</label>
                {!! Form::text('colony', null, ['class' => 'form-control', 'id' => 'field_colony']) !!}
                @if ($errors->has('colony'))
                    <span class="help-block">
                        <strong>{{ $errors->first('colony') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-green">
                <label for="location">Localidad</label>
                {!! Form::text('location', null, ['class' => 'form-control', 'id' => 'field_location']) !!}
            </div>
            @include('Qore.partials.errors',['id'=>'location'])
        </div>
        <div class="col-md-6">
            <div class="form-group form-green{{ $errors->has('outdoor') ? ' has-error' : '' }}">
                <label for="outdoor">No. Exterior</label>
                {!! Form::text('outdoor', null, ['class' => 'form-control', 'id' => 'field_outdoor']) !!}
                @if ($errors->has('outdoor'))
                    <span class="help-block">
                        <strong>{{ $errors->first('outdoor') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-green">
                <label for="interior">No. Interior</label>
                {!! Form::text('interior', null, ['class' => 'form-control', 'id' => 'field_interior']) !!}
            </div>
            @include('Qore.partials.errors',['id'=>'interior'])
        </div>
        <div class="col-md-6">
            <div class="form-group form-green{{ $errors->has('town') ? ' has-error' : '' }}">
                <label for="town">Ciudad</label>
                {!! Form::text('town', null, ['class' => 'form-control', 'id' => 'field_town']) !!}
                @if ($errors->has('town'))
                    <span class="help-block">
                        <strong>{{ $errors->first('town') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group form-green{{ $errors->has('state') ? ' has-error' : '' }}">
                <label for="state">Estado</label>
                {!! Form::text('state', null, ['class' => 'form-control', 'id' => 'field_state']) !!}
                @if ($errors->has('state'))
                    <span class="help-block">
                        <strong>{{ $errors->first('state') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group form-green{{ $errors->has('pcode') ? ' has-error' : '' }}">
                <label for="pcode">C.P.</label>
                {!! Form::text('pcode', null, ['class' => 'form-control', 'id' => 'field_pcode']) !!}
                @if ($errors->has('pcode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('pcode') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-green">
                <label for="country">Pais</label>
                {!! Form::select('country', $countries, null, ['class' => 'form-control', 'id' => 'field_country']) !!}
            </div>
            @include('Qore.partials.errors',['id'=>'country'])
        </div>
        <div class="col-md-6">
            <div class="form-group form-green">
                <label for="contact">Email de Contacto</label>
                {!! Form::email('contact', null, ['class' => 'form-control', 'id' => 'field_contact']) !!}
            </div>
            @include('Qore.partials.errors',['id'=>'contact'])
        </div>
        <div class="col-md-6">
            <div class="form-group form-green">
                <label for="phone">Teléfono</label>
                {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'field_phone']) !!}
            </div>
            @include('Qore.partials.errors',['id'=>'phone'])
        </div>
        <div class="col-md-6">
            <div class="form-group form-green">
                <label for="sector">Sector</label>
                {!! Form::select('sector', [1 => 'Agricola', 2 => 'Aeronutica', 3 => 'Automotriz',4 => 'Autopartes', 5 => 'Manufactura', 6 => 'Reamanufactura', 7 => 'Servicios', 8 => 'Otro'],null, ['class' => 'form-control', 'id' => 'field_sector']) !!}
            </div>
            @include('Qore.partials.errors',['id'=>'sector'])
        </div>
        <div class="col-md-12">
            <div class="form-group form-green">
                <label for="logo">Logotipo</label>
                {!! Form::file('logo', ['class' => 'form-control']) !!}
            </div>
            @include('Qore.partials.errors',['id'=>'logo'])
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::hidden('registered', 0, ['id' => 'field_registered']) !!}
            </div>
        </div>
    </div>
