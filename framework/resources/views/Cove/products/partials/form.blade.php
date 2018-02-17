<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('pk_prod') ? ' has-error' : '' }}">
        {!! Form::label('pk_prod', 'Código') !!}
        {!! Form::text('pk_prod', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pk_prod'))
            <span class="help-block">
                <strong>{{ $errors->first('pk_prod') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('prod_codigoprov') ? ' has-error' : '' }}">
        {!! Form::label('prod_codigoprov', 'Código (Proveedor)') !!}
        {!! Form::text('prod_codigoprov', null, ['class' => 'form-control']) !!}
        @if ($errors->has('prod_codigoprov'))
            <span class="help-block">
                <strong>{{ $errors->first('prod_codigoprov') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('prod_des') ? ' has-error' : '' }}">
        {!! Form::label('prod_des', 'Descripción Comercial') !!}
        {!! Form::text('prod_des', null, ['class' => 'form-control']) !!}
        @if ($errors->has('prod_des'))
            <span class="help-block">
                <strong>{{ $errors->first('prod_des') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('prod_descove') ? ' has-error' : '' }}">
        {!! Form::label('prod_descove', 'Descripción COVE') !!}
        {!! Form::text('prod_descove', null, ['class' => 'form-control']) !!}
        @if ($errors->has('prod_descove'))
            <span class="help-block">
                <strong>{{ $errors->first('prod_descove') }}</strong>
            </span>
        @endif
        
    </div>
</div>
<div class="col-md-2">
    <div class="form-group form-purple{{ $errors->has('prod_pesounitario') ? ' has-error' : '' }}">
        {!! Form::label('prod_pesounitario', 'Peso Unitario')!!}
        {!! Form::text('prod_pesounitario', null, ['class' => 'form-control']) !!}
        @if ($errors->has('prod_pesounitario'))
            <span class="help-block">
                <strong>{{ $errors->first('prod_pesounitario') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('prod_fracci') ? ' has-error' : '' }}">
        {!! Form::label('prod_fracci', 'Fracción')!!}
        {!! Form::text('prod_fracci', null, ['class' => 'form-control']) !!}
        @if ($errors->has('prod_fracci'))
            <span class="help-block">
                <strong>{{ $errors->first('prod_fracci') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group form-purple{{ $errors->has('prod_umc') ? ' has-error' : '' }}">
        {!! Form::label('prod_umc', 'U. Medida Consumo')!!}
        {!! Form::select('prod_umc', App\Qore\Unit::orderby('ume_nombre')->pluck('ume_nombre','ume_clave'), null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('prod_umc'))
            <span class="help-block">
                <strong>{{ $errors->first('prod_umc') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group form-purple{{ $errors->has('prod_oma') ? ' has-error' : '' }}">
        {!! Form::label('prod_oma', 'U. de Medida (OMA)')!!}
        {!! Form::select('prod_oma', App\Qore\OMAUnit::orderby('oma_nombre')->pluck('oma_nombre','oma_clave'), null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('prod_oma'))
            <span class="help-block">
                <strong>{{ $errors->first('prod_oma') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('prod_tipo') ? ' has-error' : '' }}">
        {!! Form::label('prod_tipo', 'Tipo Producto')!!}
        {!! Form::select('prod_tipo', ['' => 'Seleccionar...', 'TERMINADO' => 'Terminado', 'ENSAMBLE' => '  Ensamble', 'REMANUFACTURA' => 'Remanufactura', 'DESPERDICIO' => 'Desperdicio'] , null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('prod_tipo'))
            <span class="help-block">
                <strong>{{ $errors->first('prod_tipo') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('prod_fechai') ? ' has-error' : '' }}">
        {!! Form::label('prod_fechai', 'Fecha Inicial') !!}
        {!! Form::text('prod_fechai', null, ['class' => 'form-control', 'id' => 'prod_fechaini']) !!}
        @if ($errors->has('prod_fechai'))
            <span class="help-block">
                <strong>{{ $errors->first('prod_fechai') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('prod_fechaf') ? ' has-error' : '' }}">
        {!! Form::label('prod_fechaf', 'Fecha Final') !!}
        {!! Form::text('prod_fechaf', null, ['class' => 'form-control', 'id' => 'prod_fechafin' ]) !!}
        @if ($errors->has('prod_fechaf'))
            <span class="help-block">
                <strong>{{ $errors->first('prod_fechaf') }}</strong>
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
        $('#prod_fechaini').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        $('#prod_fechafin').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    </script>
@endsection
