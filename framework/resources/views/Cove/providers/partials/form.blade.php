<div class="col-md-12">
    <div class="form-group form-purple{{ $errors->has('pk_pro') ? ' has-error' : '' }}">
        {!! Form::label('pk_pro', 'Código') !!}
        {!! Form::text('pk_pro', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pk_pro'))
            <span class="help-block">
                <strong>{{ $errors->first('pk_pro') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group form-purple{{ $errors->has('pro_razon') ? ' has-error' : '' }}">
        {!! Form::label('pro_razon', 'Nombre o Razón Social') !!}
        {!! Form::text('pro_razon', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_razon'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_razon') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('pro_paterno') ? ' has-error' : '' }}">
        {!! Form::label('pro_paterno', 'Apellido Paterno') !!}
        {!! Form::text('pro_paterno', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_paterno'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_paterno') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('pro_materno') ? ' has-error' : '' }}">
        {!! Form::label('pro_materno', 'Apellido Materno') !!}
        {!! Form::text('pro_materno', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_materno'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_materno') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('pro_tipo') ? ' has-error' : '' }}">
        {!! Form::label('pro_tipo', 'Tipo')!!}
        {!! Form::select('pro_tipo', ['' => 'Selecciona...', '1' => 'Nacional', '2' => 'Extranjero'], null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_tipo'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_tipo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('pro_taxid') ? ' has-error' : '' }}">
        {!! Form::label('pro_taxid', 'Tax ID / R.F.C.')!!}
        {!! Form::text('pro_taxid', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_taxid'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_taxid') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-8">
    <div class="form-group form-purple{{ $errors->has('pro_calle') ? ' has-error' : '' }}">
        {!! Form::label('pro_calle', 'Calle')!!}
        {!! Form::text('pro_calle', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_calle'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_calle') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-2">
    <div class="form-group form-purple{{ $errors->has('pro_noext') ? ' has-error' : '' }}">
        {!! Form::label('pro_noext', 'No. Exterior')!!}
        {!! Form::text('pro_noext', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_noext'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_noext') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-2">
    <div class="form-group form-purple{{ $errors->has('pro_noint') ? ' has-error' : '' }}">
        {!! Form::label('pro_noint', 'No. Interior')!!}
        {!! Form::text('pro_noint', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_noint'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_noint') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('pro_col') ? ' has-error' : '' }}">
        {!! Form::label('pro_col', 'Colonia')!!}
        {!! Form::text('pro_col', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_col'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_col') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('pro_localidad') ? ' has-error' : '' }}">
        {!! Form::label('pro_localidad', 'Localidad')!!}
        {!! Form::text('pro_localidad', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_localidad'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_localidad') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-2">
    <div class="form-group form-purple{{ $errors->has('pro_cp') ? ' has-error' : '' }}">
        {!! Form::label('pro_cp', 'C.P.')!!}
        {!! Form::text('pro_cp', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_cp'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_cp') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('pro_mpo') ? ' has-error' : '' }}">
        {!! Form::label('pro_mpo', 'Municipio')!!}
        {!! Form::text('pro_mpo', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_mpo'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_mpo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('pro_edo') ? ' has-error' : '' }}">
        {!! Form::label('pro_edo', 'Estado')!!}
        {!! Form::text('pro_edo', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pro_edo'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_edo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('pro_pais') ? ' has-error' : '' }}">
        {!! Form::label('pro_pais', 'Pais')!!}
        {!! Form::select('pro_pais', \App\Qore\Country::orderby('pai_nombre')->pluck('pai_nombre','pai_clavem3'), null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('pro_pais'))
            <span class="help-block">
                <strong>{{ $errors->first('pro_pais') }}</strong>
            </span>
        @endif
    </div>
</div>
@section('scripts')    
    <script src="{{ asset('dist/js/chosen.jquery.min.js') }}"></script>
    
    <script type="text/javascript">
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    </script>
@endsection
