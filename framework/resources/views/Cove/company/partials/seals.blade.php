<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('sello_rfc') ? ' has-error' : '' }}">
        {!! Form::label('sello_rfc', 'R.F.C. de Sello') !!}
        {!! Form::text('sello_rfc', null, ['class' => 'form-control']) !!}
        @if ($errors->has('sello_rfc'))
            <span class="help-block">
                <strong>{{ $errors->first('sello_rfc') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('sello_tipofigura') ? ' has-error' : '' }}">
        {!! Form::label('sello_tipofigura', 'Tipo Figura') !!}
        {!! Form::select('sello_tipofigura', ['' => 'Seleccionar...', 1 => 'Agente Aduanal', 2 => 'Apoderado Aduanal', 3 => 'Mandatario', 4 => 'Exportador', 5 => 'Importador'], null, ['class' => 'form-control']) !!}
        @if ($errors->has('sello_tipofigura'))
            <span class="help-block">
                <strong>{{ $errors->first('sello_tipofigura') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('sello_key') ? ' has-error' : '' }}">
        {!! Form::label('sello_key', 'Archivo .KEY') !!}
        {!! Form::file('sello_key', ['class' => 'form-control']) !!}
        @if ($errors->has('sello_key'))
            <span class="help-block">
                <strong>{{ $errors->first('sello_key') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('sello_cer') ? ' has-error' : '' }}">
        {!! Form::label('sello_cer', 'Archivo .CER') !!}
        {!! Form::file('sello_cer',  ['class' => 'form-control']) !!}
        @if ($errors->has('sello_cer'))
            <span class="help-block">
                <strong>{{ $errors->first('sello_cer') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('sello_vigencia') ? ' has-error' : '' }}">
        {!! Form::label('sello_vigencia', 'Fecha Vencimiento') !!}
        {!! Form::text('sello_vigencia', null, ['class' => 'form-control']) !!}
        @if ($errors->has('sello_vigencia'))
            <span class="help-block">
                <strong>{{ $errors->first('sello_vigencia') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('sello_password') ? ' has-error' : '' }}">
        {!! Form::label('sello_password', 'Clave de Seguridad') !!}
        <input type="password" class="form-control"  name="sello_password" value="{{ isset($seal) ? $seal->sello_password : null }}">
        @if ($errors->has('sello_password'))
            <span class="help-block">
                <strong>{{ $errors->first('sello_password') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group form-purple{{ $errors->has('sello_wsp') ? ' has-error' : '' }}">
        {!! Form::label('sello_wsp', 'Contraseña WebService') !!}
        {!! Form::text('sello_wsp', null, ['class' => 'form-control']) !!}
        @if ($errors->has('sello_wsp'))
            <span class="help-block">
                <strong>{{ $errors->first('sello_wsp') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12 text-right">
    <div class="form-group">
        @if($type < 5)
        <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar</button>
        @endif
        <a href="{{ route('cove.company.index') }}"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Cancelar</button></a>
    </div>
</div>
