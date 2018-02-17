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
            <div class="panel-heading">
                    <div class="widget-title widget-title-green">
                        <div class="flex-box">
                            <div><i class="icon-calendar"></i></div>
                            <div>
                                <h3>Historial Contable</h3>
                                <p>Qore: Historial de los registros en Contratos</p>
                            </div>
                        </div>
                    </div>
            </div>
            <ul class="list-group">
                <li class="list-group-item text-right">
                    <a href="{{ route('qore.history.invoices') }}" class="btn btn-default btn-sm btn-round">Facturas</a>
                    <a href="{{ route('qore.history.payment') }}" class="btn btn-default btn-sm btn-round">Pagos</a>
                </li>
            </ul>
            <div class="panel-body">

                <div class="timeline_body">
                    @foreach($dates as $date)
                        <div class="timeline_item row">
                            <div class="timeline_date col-md-2">
                                {{ substr($date->created_at, 0, 10) }}
                            </div>
                            <div class="timeline_actions_list col-md-10">
                                <?php
                                $contracts = \DB::table('contracts')->join('companies', 'contracts.company_id', '=', 'companies.id')
                                    ->where('contracts.master_id', \Auth::user()->departament->company->master_id)
                                    ->where(\DB::raw('DATE(contracts.created_at)'), substr($date->created_at, 0, 10))
                                    ->select('contracts.created_at', 'companies.business_name')
                                    ->get();
                                ?>
                                @foreach($contracts as $contract)
                                    <div class="timeline_action row">
                                        <div class="timeline_time col-md-2 text_right">
                                            <p><strong>{{ substr($contract->created_at, 10, 6)." hrs" }}</strong></p>
                                        </div>
                                        <div class="timeline_detail col-md-10 with-border-left">
                                            <p><span class="badge empty red"></span> Se registro un nuevo Contrato</p>
                                            <p class="subtext">Con la empresa {{ $contract->business_name }}</p>
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
@endsection
