<div class="col-md-2">
    <div class="form-group form-green">
        {!! Form::label('mon_clave', 'Clave') !!}
        {!! Form::text('mon_clave', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-3">
    <div class="form-group form-green">
        {!! Form::label('mon_nombre', 'Nombre') !!}
        {!! Form::text('mon_nombre', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-7">
    <div class="form-group form-green">
        {!! Form::label('mon_pais', 'Pais') !!}
        {!! Form::select('mon_pais', $countries, null, ['class' => 'form-control']) !!}
    </div>
</div>
