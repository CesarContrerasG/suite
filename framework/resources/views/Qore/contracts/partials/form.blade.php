<div class="row">
    <div class="col-md-12">
        {!! Form::hidden('master_id', Auth::user()->current_master->id) !!}
    </div>
    <div class="col-md-6">
        <div class="form-group form-green{{ $errors->has('company_id') ? ' has-error' : '' }}">
            {!! Form::label('company_id', 'Cliente') !!}
            {!! Form::select('company_id', $clients, null, ['class' => 'form-control']) !!}
            @if ($errors->has('company_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('company_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-green{{ $errors->has('credit_days') ? ' has-error' : '' }}">
            {!! Form::label('credit_days', 'Dias de Credito') !!}
            {!! Form::number('credit_days', null, ['class' => 'form-control']) !!}
            @if ($errors->has('credit_days'))
                <span class="help-block">
                    <strong>{{ $errors->first('credit_days') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-green{{ $errors->has('revision_day') ? ' has-error' : '' }}">
            {!! Form::label('revision_day', 'Día de Revisión') !!}
            {!! Form::select('revision_day', [1 => "Lunes", 2 => "Martes", 3 => "Miercoles", 4 => "Jueves", 5 => "Viernes", 6 => "Sabado", 7 => "Domingo"], null, ['class' => 'form-control']) !!}
            @if ($errors->has('revision_day'))
                <span class="help-block">
                    <strong>{{ $errors->first('revision_day') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-green{{ $errors->has('revision_time') ? ' has-error' : '' }}">
            {!! Form::label('revision_time', 'Hora de Revisión') !!}
            {!! Form::text('revision_time', null, ['class' => 'form-control', 'id' => 'revision_time']) !!}
            @if ($errors->has('revision_time'))
                <span class="help-block">
                    <strong>{{ $errors->first('revision_time') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group form-green{{ $errors->has('payment_day') ? ' has-error' : '' }}">
            {!! Form::label('payment_day', 'Día de Pago') !!}
            {!! Form::select('payment_day', [1 => "Lunes", 2 => "Martes", 3 => "Miercoles", 4 => "Jueves", 5 => "Viernes", 6 => "Sabado", 7 => "Domingo"], null, ['class' => 'form-control']) !!}
            @if ($errors->has('payment_day'))
                <span class="help-block">
                    <strong>{{ $errors->first('payment_day') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-green{{ $errors->has('payment_time') ? ' has-error' : '' }}">
            {!! Form::label('payment_time', 'Hora de Pago') !!}
            {!! Form::text('payment_time', null, ['class' => 'form-control', 'id' => 'payment_time']) !!}
            @if ($errors->has('payment_time'))
                <span class="help-block">
                    <strong>{{ $errors->first('payment_time') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group form-green{{ $errors->has('opening_date') ? ' has-error' : '' }}">
            {!! Form::label('opening_date', 'Fecha de Apertura') !!}
            {!! Form::text('opening_date', null, ['class' => 'form-control', 'id' => 'opening_date']) !!}
            @if ($errors->has('opening_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('opening_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-green{{ $errors->has('ending_date') ? ' has-error' : '' }}">
            {!! Form::label('ending_date', 'Fecha de Cierre') !!}
            {!! Form::text('ending_date', null, ['class' => 'form-control', 'id' => 'ending_date']) !!}
            @if ($errors->has('ending_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('ending_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
