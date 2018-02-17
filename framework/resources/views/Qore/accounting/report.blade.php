@extends('suite.esuite')

@section('html-title')
    Qore - Reporte Detallado
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.accounting.index') }}">Registros Contables</a></li>
    <li>Reporte Detallado</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                @if (count($records) > 0)
                    <table class="table table-striped text-small">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fec. Pago</th>
                                <th>Tipo</th>
                                <th>No. Fact.</th>
                                <th>Cliente/Proveedor</th>
                                <th>Descripción</th>
                                <th>Fec. Emisión</th>
                                <th>F. Pago</th>
                                <th>Importe</th>
                                <th>IVA</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)
                            <tr>
                                <td>
                                    <a href="{{ route('qore.accounting.show', $record->id) }}"><i class="icon-visibility"></i></a>
                                </td>
                                <td>{{ $record->date_payment }}</td>
                                @if($record->type == 1)
                                    <td><span class="text-color text-green">INGRESO</span></td>
                                @else
                                    <td><span class="text-color text-yellow">EGRESO</span></td>
                                @endif
                                <td>{{ $record->invoice_number }}</td>
                                <td>{{ $record->client }}</td>
                                <td>{{ $record->short_description }}</td>
                                <td>{{ $record->date_emition }}</td>
                                <td>{{ \App\Helpers::getNameMethodPaymentSAT($record->way_to_pay) }}</td>
                                <td>{{ number_format($record->amount, 2, '.', ',') }}</td>
                                <td>{{ number_format($record->iva, 2, '.', ',') }}</td>
                                <td>{{ number_format($record->amount + $record->iva, 2, '.', ',') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning">
                        <strong>Advertencia</strong> No se encontrarón registros.
                    </div>
                @endif
                    <div class="flex-box flex-end">
                        <div style="width:330px;">
                        <table class="table table-striped text-small">
                            <tbody>
                                <tr>
                                    <td colspan="1">IVA Ingresos</td>
                                    <td colspan="1" class="text-right">{{ number_format($incomeIVA, 2, '.', ',') }}</td>
                                    <td colspan="1">IVA Egresos</td>
                                    <td colspan="1" class="text-right">{{ number_format($expendituresIVA, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">IVA a Pagar</td>
                                    <td colspan="2" class="text-right">{{ number_format(($incomeIVA - $expendituresIVA), 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Subtotal de Ingresos</td>
                                    <td colspan="2" class="text-right">{{ number_format($subtotalIncome, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Subtotal de Egresos</td>
                                    <td colspan="2" class="text-right">{{ number_format($subtotalExpenditures, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Total:</td>
                                    <td colspan="2" class="text-right">{{ number_format($total, 2, '.', ',') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection