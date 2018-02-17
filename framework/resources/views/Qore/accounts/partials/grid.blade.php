@if(count($contracts) > 0)
        @foreach($contracts as $contract)
        <div class="list-group-item">
            <div class="flex-box space-between">
                <div class="paragraph-info col-md-3">
                    <h4>{{ $contract->company->business_name }}</h4>
                    <p class="text-color text-green"><strong>{{ $contract->company->rfc }}</strong></p>
                </div>
                <div class="paragraph-info col-md-3">
                    <h4>{{ $contract->dates->revision_weekday." ".substr($contract->dates->revision_time, 0, 5) }}</h4>
                    <p>Horario de Revisión</p>
                </div>
                <div class="paragraph-info col-md-3">
                    <h4>{{ $contract->dates->payment_weekday." ".substr($contract->dates->payment_time, 0, 5) }}</h4>
                    <p>Horario de Pago</p>
                </div>
                <div class="collection_options col-md-3">
                    <a href="{{ route('qore.receivable.invoices.index', Hashids::encode($contract->id)) }}" class="btn btn-default btn-sm btn-round">Agregar Facturas</a>
                </div>
            </div>
        </div>
        @if(count($contract->billings->where('pendient', '>', 0)) > 0)
            <div class="contract-detail-view">
                @foreach ($contract->billings->where('pendient', '>', 0) as $billing)
                    <div class="flex-box space-between">
                        <div class="col-md-3">
                            <spam>{{ $billing->concepto }}</spam><br>
                            <strong class="text-color text-blue">{{ $billing->folio }}</strong>
                        </div>
                        <div class="col-md-3">
                            <spam>Fecha de Facturación</spam><br>
                            @if(date("Y-m-d", strtotime($billing->billing_register." + ".$contract->dates->credit_days." days")) < date("Y-m-d"))
                                <strong class="text-color text-red"><span class="moment-span">{{ date("Y-m-d", strtotime($billing->billing_register." + ".$contract->dates->credit_days." days")) }}</span></strong>
                            @else
                                <span class="moment-span">{{ date("Y-m-d", strtotime($billing->billing_register." + ".$contract->dates->credit_days." days")) }}</span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <spam>Importe de Factura</spam><br>
                            @if(date("Y-m-d", strtotime($billing->billing_register." + ".$contract->dates->credit_days." days")) < date("Y-m-d"))
                                <strong class="text-color text-red">{{ '$ '.number_format($billing->pendient, 2, '.', '') }}</strong>
                            @else
                                <strong class="text-primary">{{ '$ '.number_format($billing->pendient, 2, '.', '') }}</strong>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('qore.receivable.payments.index', $billing) }}" class="btn btn-default btn-sm btn-round btn-round-success">Agregar Pago</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @endforeach
@else
    <div class="panel-body">
        <div class="alert alert-warning">
            <strong>Advertencia.</strong> Usted no tiene contratos registrados
        </div>
    </div>
@endif
