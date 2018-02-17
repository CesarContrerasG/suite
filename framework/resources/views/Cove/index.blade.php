@extends('suite.esuite')

@section('html-title')
    COVE - Dashboard1
@endsection

@section('header')
    @include('suite.partials.headers.cove')
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
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="widget-title widget-title-purple">
                <div class="flex-box">
                    <div><i class="icon-meter"></i></div>
                    <div>
                        <h3>Dashboard</h3>
                        <p>Vista Previa del Módulo Cove</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            Bienvenido a Cove
            <div class="row">
                <div class="col-md-4">
                    <div class="widget-title">
                        <div class="flex-box">
                            <div class="text-color text-purple"><i class="icon-pencil2"></i></div>
                            <div>
                                <h3>{{ $total_coves }}</h3>
                                <p>COVE pendiente de firma</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="widget-title">
                        <div class="flex-box">
                            <div class="text-color text-red"><i class="icon-shuffle"></i></div>
                            <div>
                                <h3>{{ $total_relation }}</h3>
                                <p>COVE no relacionado con pedimento</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="widget-title">
                        <div class="flex-box">
                            <div class="text-color text-purple"><i class="icon-stackoverflow"></i></div>
                            <div>
                                <h3>{{ $total_ed }}</h3>
                                <p>ED pendiente de firma</p>
                            </div>                            
                        </div>
                    </div>
                    <br><br>
                </div>
                
                <div class="col-md-6">
                    {!! $chart_type->render() !!}
                </div>
                
                <div class="col-md-6">
                    {!! $chart_patente->render() !!}
                </div>
            </div>           
        </div>        
    </div>
@endsection



