@extends('suite.esuite')

@section('html-title')
    Recove - Dashboard
@endsection

@section('header')
    @include('suite.partials.headers.recove')
@endsection

@section('html-head')
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('js/chartjs.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
@endsection

@section('breadcrumb')
    <li>Dashboard</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-red">
                        <div class="flex-box">
                            <div><i class="icon-meter"></i></div>
                            <div>
                                <h3>Dashboard</h3>
                                <p>Vista preliminar y analisis de la información de Recove</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                        <div class="col-md-6">
                            <div class="chart-details">
                                <div>Pedimentos y Cove recuperados</div>
                            </div>
                            <div class="chart-content">
                                {!! $chartjs->render() !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="chart-details">
                                <div>Coves no recuperados</div>
                            </div>
                            <div class="chart-content">
                                {!! $chart_coves->render() !!}
                                
                            </div>
                        </div>
                        <div class="dashboard-content row">
                            <div class="col-md-8">
                                <p></p>
                            </div>
                            <div class="col-md-6">
                                <div class="dashboard-dataset">
                                    <div class="item-dataset">
                                        <div class="row-dataset">
                                            <div class="row-title">
                                                EDocument a recuperar
                                            </div>
                                            <div class="row-body">
                                                <div class="row-data flex-box">
                                                    <div><i class="icon-arrow_drop_up text-color text-green"></i></div>
                                                    <div>
                                                        <p><strong>{{ $edocument }}</strong></p>
                                                        <p><small>Documentos</small></p>
                                                    </div>
                                                </div>
                                                <div class="row-data">
                                                    <p><strong><a href="{{ route('recove.bitacora') }}">Descargar</a></strong></p>
                                                    <p><small>Bitacora ED</small></p>
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
      
@endsection

