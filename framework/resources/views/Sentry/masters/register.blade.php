@extends('suite.sentry')

@section('html-title')
    Registrar Usuario
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
@endsection

@section('breadcrumb')
    <li><a href="{{ route('sentry.masters.index') }}">Cuentas Maestras</a></li>
    <li>Registrar Usuario</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registrar Usuario
                </div>
                <div class="panel-body">
                    @if(count($master->company->departaments) == 0)
                        <div class="col-md-12">
                            <p>No encontramos departamentos registrados dentro de la empresa, es necesario minimo un registro ya que el usuario es asociado a un departamento.<br>A continuación esta el formulario para poder registrar su primer departamento.</p>
                        </div>
                        @include('Sentry.masters.departament')
                    @elseif(count($master->company->departaments) == 1)
                        <div class="col-md-12">
                            <p class="text-primary"><strong>Solo tienes un departamento registrado, el usuario se asociará para ese departamento. O puedes crear un nuevo departamento.</strong></p>
                        </div>
                        <div class="col-md-6">
                            <div class="with-sm-padding">
                                <?php $departament = $master->company->departaments->first() ?>
                                {{ $departament->name }}
                            </div>
                        </div>
                        @include('Sentry.masters.user')
                    @else
                        @include('Sentry.masters.user')
                    @endif

                </div>
            </div>
        </div>


        <div class="col-md-6">
            @if(count($master->company->departaments) > 0)
            <div class="panel panel-default">
                    <div class="panel-heading">
                        Registrar Departamento
                    </div>
                    <div class="panel-body">
                        @include('Sentry.masters.departament')
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').niceSelect();
    });
</script>
@endsection
