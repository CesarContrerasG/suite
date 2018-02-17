@extends('suite.esuite')

@section('html-title')
    Qore - Detalle del Registro
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.accounting.index') }}">Registros Contables</a></li>
    <li>Detalle del Registro</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('Qore.partials.sidebar_accounts')
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="paragraph paragraph-green">
                                <p class="without-margin">{{ $record->client }}</p>
                                @if($record->type == 0)
                                    <p class="without-margin"><span class="text-color text-yellow">EGRESO</span></p>
                                @else
                                    <p class="without-margin"><span class="text-color text-green">INGRESO</span></p>
                                @endif
                                <p class="without-margin">{{ $record->tax_sheet }}</p>
                                @if($record->check_number != "")
                                    <p class="without-margin"><strong>No. de Cheque: </strong>{{ $record->check_number }}</p>
                                @else
                                    <p class="without-margin"><strong><i class="icon-block"></i> Sin No. de Cheque</strong></p>
                                @endif
                                @if($record->invoice_number != "")
                                    <p class="without-margin"><strong>No. de Factura: </strong>{{ $record->invoice_number }}</p>
                                @else
                                    <p class="without-margin"><strong><i class="icon-block"></i> Sin No. de Factura</strong></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="paragraph paragraph-green">
                                <p class="without-margin"><strong>Fecha de pago</strong>: {{ $record->date_payment }}</p>
                                <p class="without-margin"><strong>Fecha de emición</strong>: {{ $record->date_emition }}</p>
                                <p class="without-margin"><strong>Importe</strong>: <span class="text-color text-green">${{ number_format($record->amount, 2, '.', ',') }}</span></p>
                                <p class="without-margin"><strong>IVA</strong>: <span class="text-color text-green">${{ number_format($record->iva, 2, '.', ',') }}</span></p>
                                <p class="without-margin"><strong>Forma de Pago</strong>: {{ \App\Helpers::getNameMethodPaymentSAT($record->way_to_pay) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection