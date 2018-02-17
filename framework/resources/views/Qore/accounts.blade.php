@extends('suite.esuite')

@section('html-title')
    Qore - Cuentas
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('html-head')
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('js/chartjs.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
@endsection

@section('breadcrumb')
    <li><i class="icon icon-dollar-symbol"></i>Cuentas</li>
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
                            <div><i class="icon-credit-card"></i></div>
                            <div>
                                <h3>Cuentas</h3>
                                <p>Información general de los contratos registrados en Qore</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row-md-12">
                        {!! $chartjs->render() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
