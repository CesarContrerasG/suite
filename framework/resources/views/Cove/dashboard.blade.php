@extends('suite.esuite')

@section('html-title')
    COVE - Dashboard
@endsection

@section('html-head')
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('js/chartjs.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection

@section('breadcrumb')
    <li>Dashboard</li>
@endsection

@section('content')
<div class="panel-body">
                    <div class="row-md-12">
                        {!! $chartjs->render() !!}
                    </div>
                </div>
@endsection