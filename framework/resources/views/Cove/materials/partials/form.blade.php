<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('pk_mat') ? ' has-error' : '' }}">
        {!! Form::label('pk_mat', 'Código') !!}
        {!! Form::text('pk_mat', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pk_mat'))
            <span class="help-block">
                <strong>{{ $errors->first('pk_mat') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('mat_codigoprov') ? ' has-error' : '' }}">
        {!! Form::label('mat_codigoprov', 'Código (Proveedor)') !!}
        {!! Form::text('mat_codigoprov', null, ['class' => 'form-control']) !!}
        @if ($errors->has('mat_codigoprov'))
            <span class="help-block">
                <strong>{{ $errors->first('mat_codigoprov') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('mat_des') ? ' has-error' : '' }}">
        {!! Form::label('mat_des', 'Descripción Comercial') !!}
        {!! Form::text('mat_des', null, ['class' => 'form-control']) !!}
        @if ($errors->has('mat_des'))
            <span class="help-block">
                <strong>{{ $errors->first('mat_des') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('mat_descove') ? ' has-error' : '' }}">
        {!! Form::label('mat_descove', 'Descripción COVE') !!}
        {!! Form::text('mat_descove', null, ['class' => 'form-control']) !!}
        @if ($errors->has('mat_descove'))
            <span class="help-block">
                <strong>{{ $errors->first('mat_descove') }}</strong>
            </span>
        @endif
        
    </div>
</div>
<div class="col-md-2">
    <div class="form-group form-purple{{ $errors->has('mat_pesounitario') ? ' has-error' : '' }}">
        {!! Form::label('mat_pesounitario', 'Peso Unitario')!!}
        {!! Form::text('mat_pesounitario', null, ['class' => 'form-control']) !!}
        @if ($errors->has('mat_pesounitario'))
            <span class="help-block">
                <strong>{{ $errors->first('mat_pesounitario') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('mat_fracci') ? ' has-error' : '' }}">
        {!! Form::label('mat_fracci', 'Fracción')!!}
        {!! Form::text('mat_fracci', null, ['class' => 'form-control']) !!}
        @if ($errors->has('mat_fracci'))
            <span class="help-block">
                <strong>{{ $errors->first('mat_fracci') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group form-purple{{ $errors->has('mat_umc') ? ' has-error' : '' }}">
        {!! Form::label('mat_umc', 'U. Medida Consumo')!!}
        {!! Form::select('mat_umc', App\Qore\Unit::orderby('ume_nombre')->pluck('ume_nombre','ume_clave'), null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('mat_umc'))
            <span class="help-block">
                <strong>{{ $errors->first('mat_umc') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group form-purple{{ $errors->has('mat_oma') ? ' has-error' : '' }}">
        {!! Form::label('mat_oma', 'U. de Medida (OMA)')!!}
        {!! Form::select('mat_oma', App\Qore\OMAUnit::orderby('oma_nombre')->pluck('oma_nombre','oma_clave'), null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('mat_oma'))
            <span class="help-block">
                <strong>{{ $errors->first('mat_oma') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('mat_tipo') ? ' has-error' : '' }}">
        {!! Form::label('mat_tipo', 'Tipo Material')!!}
        {!! Form::select('mat_tipo', ['' => 'Seleccionar...', 'DIRECTO' => 'Directo', 'INDIRECTO' => 'Indirecto', 'MATERIA PRIMA' => 'Material Prima', 'EMPAQUE' => 'Empaque', 'CONSUMIBLES' => 'Consumibles', 'HERRAMIENTAS' => 'Herramientas', 'REFACCIONES' => 'Refacciones'] , null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('mat_tipo'))
            <span class="help-block">
                <strong>{{ $errors->first('mat_tipo') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('mat_fechai') ? ' has-error' : '' }}">
        {!! Form::label('mat_fechai', 'Fecha Inicial') !!}
        {!! Form::text('mat_fechai', null, ['class' => 'form-control', 'id' => 'mat_fechaini']) !!}
        @if ($errors->has('mat_fechai'))
            <span class="help-block">
                <strong>{{ $errors->first('mat_fechai') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group form-purple{{ $errors->has('mat_fechaf') ? ' has-error' : '' }}">
        {!! Form::label('mat_fechaf', 'Fecha Final') !!}
        {!! Form::text('mat_fechaf', null, ['class' => 'form-control', 'id' => 'mat_fechafin' ]) !!}
        @if ($errors->has('mat_fechaf'))
            <span class="help-block">
                <strong>{{ $errors->first('mat_fechaf') }}</strong>
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
        $('#mat_fechaini').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        $('#mat_fechafin').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    </script>
@endsection
