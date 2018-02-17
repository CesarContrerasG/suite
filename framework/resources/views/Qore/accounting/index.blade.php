@extends('suite.esuite')

@section('html-title')
    Qore - Registros Contables
@endsection

@section('html-head')
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('js/chartjs.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li>Registros Contables</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('Qore.partials.sidebar_accounts')
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-box space-between">
                        <div>
                            <h3 class="without-margin">REGISTROS CONTABLES</h3>
                            <p class="without-margin text-small">Detalle de los ingresos y egresos del mes.</p>
                        </div>
                        <div>
                            <a href="{{ route('qore.accounting.report') }}" class="btn btn-default btn-sm btn-round">Reporte Detallado</a>
                            <a href="{{ route('qore.accounting.create') }}" class="btn btn-default btn-sm btn-round">Nuevo Registro</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="with-vertical-margin">
                        {!! $chartjs->render() !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="with-vertical-margin">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p class="without-margin text-small">Ingresos</p>
                                <strong class="text-medium text-color text-green">${{ number_format($subtotalIncome + $previous_balance, 2, '.', ',') }}</strong>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p class="without-margin text-small">Egresos</p>
                                <strong class="text-meduim text-color text-red">${{ number_format($subtotalExpenditures, 2, '.', ',') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(Session::has('message'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success" role="alert">
                            <strong>Operación Realizada:</strong> {{ Session::get('message') }}
                        </div>
                    </div>
                </div>
            @endif

            @include('Qore.accounting.partials.grid')

        </div>
    </div>

{!! Form::open(['route' => ['qore.accounting.destroy', ':ID_RECORD'], 'method' => 'DELETE', 'id' => 'form_delete']) !!}
{!! Form::close() !!}
@endsection

@section('scripts')
<script>
    $('.btn-delete').click(function(e){
        e.preventDefault();
        var record = $(this).data('record');
        var section = $(this).parent().parent().parent().parent().parent();
        var form = $('#form_delete');
        var url =  form.attr('action').replace(':ID_RECORD', record);
        var data = form.serialize();

        section.fadeOut();
        
        $.post(url, data, function(result){
            console.log(result.message);
            location.reload();
        }).fail(function(){
            alert("Lo sentimos hubo un error al realizar peticiones asincronas !!");
            location.reload();
        });
    });
</script>
@endsection