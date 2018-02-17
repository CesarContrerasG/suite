<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('client') ? ' has-error' : '' }}">
        {!! Form::label('client', 'Cliente o Proveedor') !!}
        {!! Form::text('client', null, ['class' => 'form-control']) !!}
        @if ($errors->has('client'))
            <span class="help-block">
                <strong>{{ $errors->first('client') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('tax_sheet') ? ' has-error' : '' }}">
        {!! Form::label('tax_sheet', 'Folio Fiscal') !!}
        {!! Form::text('tax_sheet', null, ['class' => 'form-control']) !!}
        @if ($errors->has('tax_sheet'))
            <span class="help-block">
                <strong>{{ $errors->first('tax_sheet') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('type') ? ' has-error' : '' }}">
        {!! Form::label('type', 'Tipo') !!}
        {!! Form::select('type', [1 => "Ingreso", 0 => "Egreso"], null, ['class' => 'form-control']) !!}
        @if ($errors->has('type'))
            <span class="help-block">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('way_to_pay') ? ' has-error' : '' }}">
        {!! Form::label('way_to_pay', 'Forma de Pago') !!}
        {!! Form::select('way_to_pay', $methods, null, ['class' => 'form-control']) !!}
        @if ($errors->has('way_to_pay'))
            <span class="help-block">
                <strong>{{ $errors->first('way_to_pay') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('invoice_number') ? ' has-error' : '' }}">
        {!! Form::label('invoice_number', 'Numero de Factura') !!}
        {!! Form::text('invoice_number', null, ['class' => 'form-control']) !!}
        @if ($errors->has('invoice_number'))
            <span class="help-block">
                <strong>{{ $errors->first('invoice_number') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('check_number') ? ' has-error' : '' }}">
        {!! Form::label('check_number', 'Numero de Cheque') !!}
        {!! Form::text('check_number', null, ['class' => 'form-control']) !!}
        @if ($errors->has('check_number'))
            <span class="help-block">
                <strong>{{ $errors->first('check_number') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('date_payment') ? ' has-error' : '' }}">
        {!! Form::label('date_payment', 'Fecha de Pago') !!}
        {!! Form::text('date_payment', null, ['class' => 'form-control dates']) !!}
        @if ($errors->has('date_payment'))
            <span class="help-block">
                <strong>{{ $errors->first('date_payment') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('date_emition') ? ' has-error' : '' }}">
        {!! Form::label('date_emition', 'Fecha de Emición') !!}
        {!! Form::text('date_emition', null, ['class' => 'form-control dates']) !!}
        @if ($errors->has('date_emition'))
            <span class="help-block">
                <strong>{{ $errors->first('date_emition') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('amount') ? ' has-error' : '' }}">
        {!! Form::label('amount', 'Importe') !!}
        {!! Form::text('amount', null, ['class' => 'form-control']) !!}
        @if ($errors->has('amount'))
            <span class="help-block">
                <strong>{{ $errors->first('amount') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('iva') ? ' has-error' : '' }}">
        {!! Form::label('iva', 'IVA') !!}
        {!! Form::text('iva', null, ['class' => 'form-control']) !!}
        @if ($errors->has('iva'))
            <span class="help-block">
                <strong>{{ $errors->first('iva') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group form-green{{ $errors->has('description') ? ' has-error' : '' }}">
        {!! Form::label('description', 'Descripción') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('pdf') ? ' has-error' : '' }}">
        {!! Form::label('pdf', 'PDF de la Factura') !!}
        {!! Form::file('pdf', ['class' => 'form-control']) !!}
        @if ($errors->has('pdf'))
            <span class="help-block">
                <strong>{{ $errors->first('pdf') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('xml') ? ' has-error' : '' }}">
        {!! Form::label('xml', 'XML de la Factura') !!}
        {!! Form::file('xml', ['class' => 'form-control']) !!}
        @if ($errors->has('xml'))
            <span class="help-block">
                <strong>{{ $errors->first('xml') }}</strong>
            </span>
        @endif
    </div>
</div>