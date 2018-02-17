<div class="col-md-12">
    <div class="form-group form-purple{{ $errors->has('rfc_consulta') ? ' has-error' : '' }}">
        {!! Form::label('rfc_consulta', 'R.F.C.') !!}
        {!! Form::text('rfc_consulta', null, ['class' => 'form-control']) !!}
        @if ($errors->has('rfc_consulta'))
            <span class="help-block">
                <strong>{{ $errors->first('rfc_consulta') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group form-purple{{ $errors->has('nombre_consulta') ? ' has-error' : '' }}">
        {!! Form::label('nombre_consulta', 'Nombre o Razón Social') !!}
        {!! Form::text('nombre_consulta', null, ['class' => 'form-control']) !!}
        @if ($errors->has('nombre_consulta'))
            <span class="help-block">
                <strong>{{ $errors->first('nombre_consulta') }}</strong>
            </span>
        @endif
    </div>
</div>
