{!! Form::open(['route' => ['sentry.masters.departament.store', \Hashids::encode($master->id)], 'method' => 'POST', 'class' => 'form form_setup none-padding']) !!}
<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('name', 'Nombre del Departamento') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @if ($errors->has('name'))
            <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('description', 'Descripción') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5]) !!}
        @if ($errors->has('description'))
            <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        {!! Form::hidden('company_id', $master->company->id) !!}
        {!! Form::hidden('status', 1) !!}
        @if ($errors->has('company_id'))
            <span class="help-block">
                    <strong>{{ $errors->first('company_id') }}</strong>
            </span>
        @endif
        @if ($errors->has('status'))
            <span class="help-block">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
        @endif
    </div>
</div>
<div class="col-md-12 text-right">
    <div class="form-group">
        {!! Form::submit('Guardar Departamento', ['class' => 'btn btn-default btn-sm btn-round']) !!}
    </div>
</div>
{!! Form::close() !!}
