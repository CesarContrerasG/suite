<div class="col-md-2">
    <div class="form-group form-green">
        {!! Form::label('rec_clave', 'Clave') !!}
        {!! Form::text('rec_clave', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-green">
        {!! Form::label('rec_nombre', 'Recinto Fiscalizado') !!}
        {!! Form::text('rec_nombre', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green">
        {!! Form::label('rec_aduana', 'Aduana') !!}
        {!! Form::select('rec_aduana', $aduanas, null, ['class' => 'form-control']) !!}
    </div>
</div>
