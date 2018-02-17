<div class="row">
    <div class="col-md-12">
        <div class="form-group form-green{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group form-green{{ $errors->has('description') ? ' has-error' : '' }}">
            {!! Form::label('description', 'Descripción') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group form-green">
            {!! Form::hidden('status', 1) !!}
            {!! Form::hidden('company_id', Auth::user()->departament->company_id) !!}
        </div>
    </div>
</div>
