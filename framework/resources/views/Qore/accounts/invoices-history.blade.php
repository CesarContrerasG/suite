@extends('suite.esuite')

@section('html-title')
    Qore - Historial Contable
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.accounts') }}"><i class="icon-dollar-symbol"></i>Cuentas</a></li>
    <li>Historial Contable</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-4">
        @include('Qore.partials.sidebar_accounts')
    </div>

    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">Historial - Facturas</div>
            <ul class="list-group">
                <li class="list-group-item text-right">
                    <a href="{{ route('qore.history.index') }}" class="btn btn-default btn-sm btn-round">Contratos</a>
                    <a href="{{ route('qore.history.payment') }}" class="btn btn-default btn-sm btn-round">Pagos</a>
                </li>
            </ul>
            <div class="panel-body">
                <div class="timeline">
                    <div class="timeline_header">
                        <p><span>Historico de Facturas de {{ Auth::user()->departament->company->name }}<span></p>
                    </div>
                    <div class="timeline_body">

                        @foreach($dates as $date)
                            <div class="timeline_item row">
                                <div class="timeline_date col-md-2">
                                    {{ substr($date->created_at, 0, 10) }}
                                </div>
                                <div class="timeline_actions_list col-md-10">
                                    <?php
                                    $invoices = \DB::table('contract_billings')
                                        ->where(\DB::raw('DATE(contract_billings.created_at)'), substr($date->created_at, 0, 10))
                                        ->whereIn('contract_id', $contracts)
                                        ->get();
                                    ?>
                                    @foreach($invoices as $invoice)
                                        <div class="timeline_action row">
                                            <div class="timeline_time col-md-2 text_right">
                                                <p><strong>{{ substr($invoice->created_at, 10, 6)." hrs" }}</strong></p>
                                            </div>
                                            <div class="timeline_detail col-md-10 with-border-left">
                                                <p><span class="badge empty blue"></span> Se registro una nueva Factura</p>
                                                <p class="subtext">Con folio: {{ $invoice->folio }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
