<div class="col-md-12">
    <div class="form-group form-purple{{ $errors->has('pk_cli') ? ' has-error' : '' }}">
        {!! Form::label('pk_cli', 'Código') !!}
        {!! Form::text('pk_cli', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pk_cli'))
            <span class="help-block">
                <strong>{{ $errors->first('pk_cli') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group form-purple{{ $errors->has('cli_razon') ? ' has-error' : '' }}">
        {!! Form::label('cli_razon', 'Nombre o Razón Social') !!}
        {!! Form::text('cli_razon', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cli_razon'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_razon') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('cli_paterno') ? ' has-error' : '' }}">
        {!! Form::label('cli_paterno', 'Apellido Paterno') !!}
        {!! Form::text('cli_paterno', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cli_paterno'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_paterno') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('cli_materno') ? ' has-error' : '' }}">
        {!! Form::label('cli_materno', 'Apellido Materno') !!}
        {!! Form::text('cli_materno', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cli_materno'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_materno') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('cli_tipo') ? ' has-error' : '' }}">
        {!! Form::label('cli_tipo', 'Tipo')!!}
        {!! Form::select('cli_tipo', ['' => 'Selecciona...', '1' => 'Nacional', '2' => 'Extranjero'], null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('cli_tipo'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_tipo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('cli_taxid') ? ' has-error' : '' }}">
        {!! Form::label('cli_taxid', 'Tax ID / R.F.C.')!!}
        {!! Form::text('cli_taxid', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cli_taxid'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_taxid') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-8">
    <div class="form-group form-purple{{ $errors->has('cli_calle') ? ' has-error' : '' }}">
        {!! Form::label('cli_calle', 'Calle')!!}
        {!! Form::text('cli_calle', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cli_calle'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_calle') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-2">
    <div class="form-group form-purple{{ $errors->has('cli_noext') ? ' has-error' : '' }}">
        {!! Form::label('cli_noext', 'No. Exterior')!!}
        {!! Form::text('cli_noext', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cli_noext'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_noext') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-2">
    <div class="form-group form-purple{{ $errors->has('cli_noint') ? ' has-error' : '' }}">
        {!! Form::label('cli_noint', 'No. Interior')!!}
        {!! Form::text('cli_noint', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cli_noint'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_noint') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('cli_col') ? ' has-error' : '' }}">
        {!! Form::label('cli_col', 'Colonia')!!}
        {!! Form::text('cli_col', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cli_col'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_col') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('cli_localidad') ? ' has-error' : '' }}">
        {!! Form::label('cli_localidad', 'Localidad')!!}
        {!! Form::text('cli_localidad', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cli_localidad'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_localidad') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-2">
    <div class="form-group form-purple{{ $errors->has('cli_cp') ? ' has-error' : '' }}">
        {!! Form::label('cli_cp', 'C.P.')!!}
        {!! Form::text('cli_cp', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cli_cp'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_cp') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('cli_mpo') ? ' has-error' : '' }}">
        {!! Form::label('cli_mpo', 'Municipio')!!}
        {!! Form::text('cli_mpo', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cli_mpo'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_mpo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('cli_edo') ? ' has-error' : '' }}">
        {!! Form::label('cli_edo', 'Estado')!!}
        {!! Form::text('cli_edo', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cli_edo'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_edo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('cli_pais') ? ' has-error' : '' }}">
        {!! Form::label('cli_pais', 'Pais')!!}
        {!! Form::select('cli_pais', \App\Qore\Country::orderby('pai_nombre')->pluck('pai_nombre','pai_clavem3'), null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('cli_pais'))
            <span class="help-block">
                <strong>{{ $errors->first('cli_pais') }}</strong>
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
