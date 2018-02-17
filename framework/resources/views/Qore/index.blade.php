@extends('suite.esuite')

@section('html-title')
    Qore
@endsection

@section('html-head')
    <script src="{{ asset('js/chartjs.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
@endsection

{{--
@section('head')
    @include('Qore.partials.chart_dashboard')
    @include('Qore.partials.chart_billings_systems')
    @include('Qore.partials.chart_billings_systems_anual')
    @include('Qore.partials.chart_billings_service')
    @include('Qore.partials.chart_billings_service_anual')
@endsection

@section('extra')
    <div class="bg-qore text-white with-padding">
        <div class="container">
            <div class="row with-sm-padding">
                <div class="col-md-9">
                    <div class="space-between">
                        <p class="text-lg"><strong>${{ number_format($total_payment, 2, '.', ',') }}</strong></p>
                        <div class="widget-period outline">
                            Este un año
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div id="chart" style="min-width: 310px; height: 320px; margin: 0 auto"></div>
                </div>
                <div class="col-md-3">
                    <div class="panel with-padding without-border border-radius-md with-margin-top">
                        <p class="text-sm text-default text-upper"><strong>Contratos Registrados</strong></p>
                        <p class="text-xs text-default">Registro Anual</p>
                        <p class="text-lg text-success with-sm-padding"><strong><span id="animate-number-contracts">0</span></strong></p>
                    </div>
                    <div class="panel with-padding without-border border-radius-md with-margin-top">
                        <p class="text-sm text-default text-upper"><strong>Facturas Registradas</strong></p>
                        <p class="text-xs text-default">Registro Anual</p>
                        <p class="text-lg text-success with-sm-padding"><strong><span id="animate-number-billings">0</span></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
--}}
@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li>Dashboard</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-green">
                        <div class="flex-box">
                            <div><i class="icon-meter"></i></div>
                            <div>
                                <h3>Dashboard</h3>
                                <p>Vista preliminar y analisis de la información en Qore</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="dashboard-content row">
                        <div class="col-md-4">
                            <div class="chart-details">
                                <div>Ingresos por Aplicación</div>
                                <div class="chart-data-percent">87%</div>
                            </div>
                            <div class="chart-content">
                                {!! $chartjs->render() !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="chart-details">
                                <div>Ingresos por Servicios</div>
                                <div class="chart-data-percent">90%</div>
                            </div>
                            <div class="chart-content">
                                {!! $chartjs2->render() !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="chart-details">
                                <div>Detalle de Contratos</div>
                                <div class="chart-data-percent">0.14in/s</div>
                            </div>
                            <div class="chart-content">
                                {!! $chartjs3->render() !!}
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-content row">
                        <div class="col-md-6">
                            <p></p>
                        </div>
                        <div class="col-md-6">
                            <div class="dashboard-dataset">
                                <div class="item-dataset">
                                    <div class="row-dataset">
                                        <div class="row-title">
                                            Ingresos
                                        </div>
                                        <div class="row-body">
                                            <div class="row-data flex-box">
                                                <div><i class="icon-arrow_drop_up text-color text-green"></i></div>
                                                <div>
                                                    <p><strong>${{ number_format($total_payment, 2, '.', ',') }}</strong></p>
                                                    <p><small>Pesos Mexicanos</small></p>
                                                </div>
                                            </div>
                                            <div class="row-data">
                                                <p><strong>12 Registros</strong></p>
                                                <p><small>Contratos Registrados</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-dataset">
                                    <div class="row-dataset">
                                        <div class="row-title">
                                            Egresos
                                        </div>
                                        <div class="row-body">
                                            <div class="row-data flex-box">
                                                <div><i class="icon-arrow_drop_down text-color text-yellow"></i></div>
                                                <div>
                                                    <p><strong>20,000.00</strong></p>
                                                    <p><small>Pesos Mexicanos</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-dataset">
                                    <div class="row-dataset">
                                        <div class="row-title">
                                            Estadisticas
                                        </div>
                                        <div class="row-body">
                                            <div class="row-data flex-box">
                                                <div><i class="icon-arrow_drop_down text-color text-yellow"></i></div>
                                                <div>
                                                    <p><strong>20,000.00</strong></p>
                                                    <p><small>Pesos Mexicanos</small></p>
                                                </div>
                                            </div>
                                            <div class="row-data flex-box">
                                                <div><i class="icon-arrow_drop_up text-color text-green"></i></div>
                                                <div>
                                                    <p><strong>20,000.00</strong></p>
                                                    <p><small>Pesos Mexicanos</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--
    <div class="panel">

        <div class="row">
            <div class="col-md-3 with-border-right">
                <div class="with-padding">
                    <p class="text-xs">Numero de Prospectos</p>
                    <p class="text-xl"><strong><span id="animate-number-prospects">0</span></strong></p>
                </div>
                <div class="with-sm-padding bg-qore-thin text_right">
                    <p class="text-xs"><a href="{{ route('qore.prospects.index') }}" class="text-success">Catálogo de Prospectos</a></p>
                </div>
            </div>
            <div class="col-md-3 with-border-right">
                <div class="with-padding">
                    <p class="text-xs">Numero de Proveedores</p>
                    <p class="text-xl"><strong><span id="animate-number-providers">0</span></strong></p>
                </div>
                <div class="with-sm-padding bg-qore-thin text_right">
                    <p class="text-xs"><a href="{{ route('qore.providers.index') }}" class="text-success">Catálogo de Proveedores</a></p>
                </div>
            </div>
            <div class="col-md-3 with-border-right">
                <div class="with-padding">
                    <p class="text-xs">Numero de Clientes</p>
                    <p class="text-xl text-success"><strong><span id="animate-number-clients">0</span></strong></p>
                </div>
                <div class="with-sm-padding bg-qore-thin text_right">
                    <p class="text-xs"><a href="{{ route('qore.companies.index') }}" class="text-success">Catálogo de Clientes</a></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="with-padding">
                    <p class="text-xs">Numero de Usuarios</p>
                    <p class="text-xl text-primary"><strong><span id="animate-number-users">0</span></strong></p>
                </div>
                <div class="with-sm-padding bg-qore-thin text_right">
                    <p class="text-xs"><a href="{{ route('qore.users.index') }}" class="text-success">Catálogo de Usuarios</a></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 with-padding with-border-top text_right">
                <div class="text-sm flexbox" style="justify-content:flex-end;">
                    <div class="space-between" style="width:90px; margin-right:16px;">
                        <div class="donut donut-primary"><i class="icon-dollar-symbol"></i></div>
                        <div>
                            <p class="text-sm"><strong>${{ number_format($billings_month, 2, '.', '') }}</strong></p>
                            <p style="font-size:9px;">mensual</p>
                        </div>
                    </div>

                    <div class="space-between" style="width:90px;">
                        <div class="donut donut-success"><i class="icon-dollar-symbol"></i></div>
                        <div>
                            <p class="text-sm"><strong>${{ number_format($billings_year, 2, '.', '') }}</strong></p>
                            <p style="font-size:9px;">anual</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 with-border-top">
                <div class="col-md-4 with-padding with-border-bottom">
                    <div style="height: 340px">
                    </div>
                </div>
                <div class="col-md-4 with-padding with-border-bottom with-border-left with-border-right text_center">
                    <div style="height: 140px;">
                        <p class="with-sm-padding" style="color:#333; font-size:18px;">Facturación por Sistemas Grafica Mensual</p>
                    </div>
                    <div id="chart_billings_systems" style="width: 300px; height: 200px;"></div>
                </div>
                <div class="col-md-4 with-padding with-border-bottom">
                    <div id="chart_billings_systems_anual" style="width: 300px; height: 340px; margin: 0 auto"></div>
                </div>
                <div class="col-md-4 with-padding">
                    <div style="height: 340px"></div>
                </div>
                <div class="col-md-4 with-padding with-border-left with-border-right text_center">
                    <div style="height: 140px;">
                        <p class="with-sm-padding" style="color:#333; font-size:18px;">Facturación por Servicios Grafica Mensual</p>
                    </div>
                    <div id="chart_billings_services" style="width: 300px; height: 200px;"></div>
                </div>
                <div class="col-md-4 with-padding">
                    <div id="chart_billings_service_anual" style="width: 300px; height: 340px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
