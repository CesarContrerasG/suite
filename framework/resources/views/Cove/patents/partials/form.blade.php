<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('pk_age') ? ' has-error' : '' }}">
        {!! Form::label('pk_age', 'Patente Aduanal') !!}
        {!! Form::text('pk_age', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pk_age'))
            <span class="help-block">
                <strong>{{ $errors->first('pk_age') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-8">
    <div class="form-group form-purple{{ $errors->has('age_razon') ? ' has-error' : '' }}">
        {!! Form::label('age_razon', 'Nombre o Razón Social') !!}
        {!! Form::text('age_razon', null, ['class' => 'form-control']) !!}
        @if ($errors->has('age_razon'))
            <span class="help-block">
                <strong>{{ $errors->first('age_razon') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('age_rfc') ? ' has-error' : '' }}">
        {!! Form::label('age_rfc', 'R.F.C.') !!}
        {!! Form::text('age_rfc', null, ['class' => 'form-control']) !!}
        @if ($errors->has('age_rfc'))
            <span class="help-block">
                <strong>{{ $errors->first('age_rfc') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('age_curp') ? ' has-error' : '' }}">
        {!! Form::label('age_curp', 'CURP') !!}
        {!! Form::text('age_curp', null, ['class' => 'form-control']) !!}
        @if ($errors->has('age_curp'))
            <span class="help-block">
                <strong>{{ $errors->first('age_curp') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group form-purple{{ $errors->has('age_calle') ? ' has-error' : '' }}">
        {!! Form::label('age_calle', 'Calle')!!}
        {!! Form::text('age_calle', null, ['class' => 'form-control']) !!}
        @if ($errors->has('age_calle'))
            <span class="help-block">
                <strong>{{ $errors->first('age_calle') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('age_col') ? ' has-error' : '' }}">
        {!! Form::label('age_col', 'Colonia')!!}
        {!! Form::text('age_col', null, ['class' => 'form-control']) !!}
        @if ($errors->has('age_col'))
            <span class="help-block">
                <strong>{{ $errors->first('age_col') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-2">
    <div class="form-group form-purple{{ $errors->has('age_cp') ? ' has-error' : '' }}">
        {!! Form::label('age_cp', 'C.P.')!!}
        {!! Form::text('age_cp', null, ['class' => 'form-control']) !!}
        @if ($errors->has('age_cp'))
            <span class="help-block">
                <strong>{{ $errors->first('age_cp') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('age_mpo') ? ' has-error' : '' }}">
        {!! Form::label('age_mpo', 'Municipio')!!}
        {!! Form::text('age_mpo', null, ['class' => 'form-control']) !!}
        @if ($errors->has('age_mpo'))
            <span class="help-block">
                <strong>{{ $errors->first('age_mpo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('age_edo') ? ' has-error' : '' }}">
        {!! Form::label('age_edo', 'Estado')!!}
        {!! Form::text('age_edo', null, ['class' => 'form-control']) !!}
        @if ($errors->has('age_edo'))
            <span class="help-block">
                <strong>{{ $errors->first('age_edo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('age_tel') ? ' has-error' : '' }}">
        {!! Form::label('age_tel', 'Teléfono')!!}
        {!! Form::text('age_tel', null, ['class' => 'form-control']) !!}
        @if ($errors->has('age_tel'))
            <span class="help-block">
                <strong>{{ $errors->first('age_tel') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('age_mail') ? ' has-error' : '' }}">
        {!! Form::label('age_mail', 'Correo Electronico')!!}
        {!! Form::text('age_mail', null, ['class' => 'form-control']) !!}
        @if ($errors->has('age_mail'))
            <span class="help-block">
                <strong>{{ $errors->first('age_mail') }}</strong>
            </span>
        @endif
    </div>
</div>
