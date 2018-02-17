@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/chosen.min.css') }}">
@endsection

<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('pk_tipo') ? ' has-error' : '' }}">
        {!! Form::label('pk_tipo', 'Tipo Operación') !!}
        {!! Form::select('pk_tipo', ['' => 'Selecciona...', 1 => 'Importación', 2 => 'Exportación'], null, ['class' => 'form-control']) !!}
        @if ($errors->has('pk_tipo'))
            <span class="help-block">
                <strong>{{ $errors->first('pk_tipo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('cove_patente') ? ' has-error' : '' }}">
        {!! Form::label('cove_patente', 'Patente Aduanal') !!}
        <div>
            {!! Form::select('cove_patente', \App\Cove\Patent::selectRaw('CONCAT(pk_age, "-", age_razon) as razon, pk_age')->orderby('pk_age')->pluck('razon','pk_age'), null, ['class' => 'form-control chosen-select', 'data-placeholder' => 'seleccion']) !!}
            <br>
        </div>
        @if ($errors->has('cove_patente'))
            <span class="help-block">
                <strong>{{ $errors->first('cove_patente') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('pk_referencia') ? ' has-error' : '' }}">
        {!! Form::label('pk_referencia', 'Referencia Interna') !!}
        {!! Form::text('pk_referencia', null, ['class' => 'form-control']) !!}
        @if ($errors->has('pk_referencia'))
            <span class="help-block">
                <strong>{{ $errors->first('pk_referencia') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('cove_factura') ? ' has-error' : '' }}">
        {!! Form::label('cove_factura', 'Factura/Relacion de Facturas') !!}
        {!! Form::text('cove_factura', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cove_factura'))
            <span class="help-block">
                <strong>{{ $errors->first('cove_factura') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('cove_fecha') ? ' has-error' : '' }}">
        {!! Form::label('cove_fecha', 'Fecha') !!}
        {!! Form::text('cove_fecha', null, ['class' => 'form-control', 'id' => 'cove_fecha']) !!}
        @if ($errors->has('cove_fecha'))
            <span class="help-block">
                <strong>{{ $errors->first('cove_fecha') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('cove_relacion') ? ' has-error' : '' }}">
        {!! Form::label('cove_relacion', 'Relacion de Facturas') !!}
        <div>
            {!! Form::checkbox('cove_relacion', null, null, ['class' => 'form-control sw']) !!}
            <label for="cove_relacion"></label>
        </div>
        @if ($errors->has('cove_relacion'))
            <span class="help-block">
                <strong>{{ $errors->first('cove_relacion') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('cove_noexpconfiable') ? ' has-error' : '' }}">
        {!! Form::label('cove_noexpconfiable', 'Número de exportador confiable') !!}
        {!! Form::text('cove_noexpconfiable', null, ['class' => 'form-control']) !!}
        @if ($errors->has('cove_noexpconfiable'))
            <span class="help-block">
                <strong>{{ $errors->first('cove_noexpconfiable') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('cove_rfcconsulta') ? ' has-error' : '' }}">
        {!! Form::label('cove_rfcconsulta', 'RFC Consulta') !!}
        {!! Form::select('cove_rfcconsulta', \App\Cove\Consultation::orderby('nombre_consulta')->pluck('nombre_consulta','rfc_consulta'), null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('cove_rfcconsulta'))
            <span class="help-block">
                <strong>{{ $errors->first('cove_rfcconsulta') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group form-purple{{ $errors->has('cove_observa') ? ' has-error' : '' }}">
        {!! Form::label('cove_observa', 'Observaciones') !!}
        {!! Form::textarea('cove_observa', null, ['class' => 'form-control', 'rows' => 5]) !!}
        @if ($errors->has('cove_observa'))
            <span class="help-block">
                <strong>{{ $errors->first('cove_observa') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12 text-right">
    <div class="form-group">
        <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar</button>
        <a href="{{ route('cove.administration.index') }}"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Cancelar</button></a>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('dist/js/chosen.jquery.min.js') }}"></script>
    <script>
        if (localStorage.getItem("tab_active") != null) {
            var identifier = localStorage.getItem("tab_active");
            
            $('li[role="presentation"]').removeClass('active');
            $('.tab-pane').removeClass('active');

            $('a[href="' + identifier + '"]').parent().addClass('active');
            $(identifier).addClass('active');
        }

        $('a[data-toggle="tab"]').click(function(){
            var identifier = $(this).attr('href');
            console.log(identifier);
            localStorage.setItem("tab_active", identifier);
        });

        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
        $('#inv_fecha').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        $('#cove_fecha').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    </script>
@endsection
