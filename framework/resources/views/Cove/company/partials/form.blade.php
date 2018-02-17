<div class="col-md-12">
    <div class="form-group form-purple{{ $errors->has('business_name') ? ' has-error' : '' }}">
        {!! Form::label('business_name', 'Razón Social') !!}
        {!! Form::text('business_name', null, ['class' => 'form-control']) !!}
        @include('Qore.partials.errors',['id'=>'business_name'])
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('rfc') ? ' has-error' : '' }}">
        {!! Form::label('rfc', 'R.F.C.') !!}
        {!! Form::text('rfc', null, ['class' => 'form-control']) !!}
        @include('Qore.partials.errors',['id'=>'rfc'])
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple">
        <label for="sector">Sector</label>
        {!! Form::select('sector', [1 => 'Agricola', 2 => 'Aeronutica', 3 => 'Automotriz',4 => 'Autopartes', 5 => 'Manufactura', 6 => 'Reamanufactura', 7 => 'Servicios', 8 => 'Otro'],null, ['class' => 'form-control', 'id' => 'field_sector']) !!}
    </div>
    @include('Qore.partials.errors',['id'=>'sector'])
</div>
<div class="col-md-8">
    <div class="form-group form-purple{{ $errors->has('address') ? ' has-error' : '' }}">
        {!! Form::label('address', 'Calle') !!}
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
        @include('Qore.partials.errors',['id'=>'address'])
    </div>
</div>
<div class="col-md-2">
    <div class="form-group form-purple{{ $errors->has('interior') ? ' has-error' : '' }}">
        {!! Form::label('interior', 'No. Interior') !!}
        {!! Form::text('interior', null, ['class' => 'form-control']) !!}
        @include('Qore.partials.errors',['id'=>'interior'])
    </div>
</div>
<div class="col-md-2">
    <div class="form-group form-purple{{ $errors->has('outdoor') ? ' has-error' : '' }}">
        {!! Form::label('outdoor', 'No. Exterior') !!}
        {!! Form::text('outdoor', null, ['class' => 'form-control']) !!}
        @include('Qore.partials.errors',['id'=>'outdoor'])
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('colony') ? ' has-error' : '' }}">
        {!! Form::label('colony', 'Colonia') !!}
        {!! Form::text('colony', null, ['class' => 'form-control']) !!}
        @include('Qore.partials.errors',['id'=>'colony'])
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('location') ? ' has-error' : '' }}">
        {!! Form::label('location', 'Localidad') !!}
        {!! Form::text('location', null, ['class' => 'form-control']) !!}
        @include('Qore.partials.errors',['id'=>'location'])
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('town') ? ' has-error' : '' }}">
        {!! Form::label('town', 'Municipio') !!}
        {!! Form::text('town', null, ['class' => 'form-control']) !!}
        @include('Qore.partials.errors',['id'=>'town'])
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('state') ? ' has-error' : '' }}">
        {!! Form::label('state', 'Estado') !!}
        {!! Form::text('state', null, ['class' => 'form-control']) !!}
        @include('Qore.partials.errors',['id'=>'state'])
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('country') ? ' has-error' : '' }}">
        {!! Form::label('country', 'Pais') !!}
        {!! Form::select('country', \App\Qore\Country::orderby('pai_nombre')->pluck('pai_nombre','pai_clavem3'), null, ['class' => 'form-control']) !!}
        @include('Qore.partials.errors',['id'=>'country'])
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('pcode') ? ' has-error' : '' }}">
        {!! Form::label('pcode', 'Codigo Postal') !!}
        {!! Form::text('pcode', null, ['class' => 'form-control']) !!}
        @include('Qore.partials.errors',['id'=>'pcode'])
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

