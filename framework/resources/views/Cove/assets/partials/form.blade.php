<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('pk_af') ? ' has-error' : '' }}">
        {!! Form::label('pk_af', 'Código') !!}
        {!! Form::text('pk_af', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pk_af'))
            <span class="help-block">
                <strong>{{ $errors->first('pk_af') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('af_codigoprov') ? ' has-error' : '' }}">
        {!! Form::label('af_codigoprov', 'Código (Proveedor)') !!}
        {!! Form::text('af_codigoprov', null, ['class' => 'form-control']) !!}
        @if ($errors->has('af_codigoprov'))
            <span class="help-block">
                <strong>{{ $errors->first('af_codigoprov') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('af_desc') ? ' has-error' : '' }}">
        {!! Form::label('af_desc', 'Descripción Comercial') !!}
        {!! Form::text('af_desc', null, ['class' => 'form-control']) !!}
        @if ($errors->has('af_desc'))
            <span class="help-block">
                <strong>{{ $errors->first('af_desc') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('af_descove') ? ' has-error' : '' }}">
        {!! Form::label('af_descove', 'Descripción COVE') !!}
        {!! Form::text('af_descove', null, ['class' => 'form-control']) !!}
        @if ($errors->has('af_descove'))
            <span class="help-block">
                <strong>{{ $errors->first('af_descove') }}</strong>
            </span>
        @endif
        
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('af_fracc') ? ' has-error' : '' }}">
        {!! Form::label('af_fracc', 'Fracción')!!}
        {!! Form::text('af_fracc', null, ['class' => 'form-control']) !!}
        @if ($errors->has('af_fracc'))
            <span class="help-block">
                <strong>{{ $errors->first('af_fracc') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group form-purple{{ $errors->has('af_umc') ? ' has-error' : '' }}">
        {!! Form::label('af_umc', 'U. Medida Consumo')!!}
        {!! Form::select('af_umc', App\Qore\Unit::orderby('ume_nombre')->pluck('ume_nombre','ume_clave'), null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('af_umc'))
            <span class="help-block">
                <strong>{{ $errors->first('af_umc') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group form-purple{{ $errors->has('af_oma') ? ' has-error' : '' }}">
        {!! Form::label('af_oma', 'U. de Medida (OMA)')!!}
        {!! Form::select('af_oma', App\Qore\OMAUnit::orderby('oma_nombre')->pluck('oma_nombre','oma_clave'), null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('af_oma'))
            <span class="help-block">
                <strong>{{ $errors->first('af_oma') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('af_tipo') ? ' has-error' : '' }}">
        {!! Form::label('af_tipo', 'Tipo Activo Fijo')!!}
        {!! Form::select('af_tipo', ['' => 'Seleccionar...', 'ADMINISTRATIVO' => 'Equipos para el Desarrollo Administrativo', 'CONTENEDOR' => 'Contenedores y cajas de trailer', 'EQUIPO' => 'Equipo', 'HERRAMIENTA' => 'Herramienta', 'MAQUINARIA' => 'Maquinaria', 'REFACCIONES' => 'Refacciones'] , null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('af_tipo'))
            <span class="help-block">
                <strong>{{ $errors->first('af_tipo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('af_marca') ? ' has-error' : '' }}">
        {!! Form::label('af_marca', 'Modelo')!!}
        {!! Form::text('af_marca', null, ['class' => 'form-control']) !!}
        @if ($errors->has('af_marca'))
            <span class="help-block">
                <strong>{{ $errors->first('af_marca') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('af_modelo') ? ' has-error' : '' }}">
        {!! Form::label('af_modelo', 'Modelo')!!}
        {!! Form::text('af_modelo', null, ['class' => 'form-control']) !!}
        @if ($errors->has('af_modelo'))
            <span class="help-block">
                <strong>{{ $errors->first('af_modelo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('af_orden') ? ' has-error' : '' }}">
        {!! Form::label('af_orden', 'Modelo')!!}
        {!! Form::text('af_orden', null, ['class' => 'form-control']) !!}
        @if ($errors->has('af_orden'))
            <span class="help-block">
                <strong>{{ $errors->first('af_orden') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('af_serie') ? ' has-error' : '' }}">
        {!! Form::label('af_serie', 'Modelo')!!}
        {!! Form::text('af_serie', null, ['class' => 'form-control']) !!}
        @if ($errors->has('af_serie'))
            <span class="help-block">
                <strong>{{ $errors->first('af_serie') }}</strong>
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
