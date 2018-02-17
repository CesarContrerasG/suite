@extends('suite.sentry')

@section('html-title')
    Nueva Cuenta Maestra
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('sentry.masters.index') }}">Cuentas Maestras</a></li>
    <li>Nueva Cuenta Maestra</li>
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['route' => 'sentry.masters.store', 'method' => 'POST', 'class' => 'form form_setup none-padding', 'files' => true]) !!}
        @include('Sentry.masters.form')
        <div class="col-md-12 text-right">
            <div class="form-group">
                {!! Form::submit('Registrar Cuenta Maestra', ['class' => 'btn btn-default btn-sm btn-round']) !!}
                <a href="{{ route('sentry.masters.index') }}" class="btn btn-default btn-sm btn-round">Cancelar Registro</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.autocomplete.min.js') }}"></script>
<script type="text/javascript">
    $.get('http://localhost/esuite/api/companies', function( data ) {
        $('#autocomplete').autocomplete({
            lookup: data,
            onSelect: function (suggestion) {
                $.get('http://localhost/esuite/api/companies/' + suggestion.data, function( record ){
                    console.log(record);
                    $("#field_rfc").val(record.rfc);
                    $("#field_curp").val(record.curp);
                    $("#field_business_name").val(record.business_name);
                    $("#field_address").val(record.address);
                    $("#field_colony").val(record.colony);
                    $("#field_location").val(record.location);
                    $("#field_outdoor").val(record.outdoor);
                    $("#field_interior").val(record.interior);
                    $("#field_town").val(record.town);
                    $("#field_state").val(record.state);
                    $("#field_pcode").val(record.pcode);
                    $("#field_country").val(record.country);
                    $("#field_contact").val(record.contact);
                    $("#field_phone").val(record.phone);
                    $("#field_sector").val(record.sector);
                    $("#field_registered").val(1);
                });
            }
        });
    });
</script>
@endsection