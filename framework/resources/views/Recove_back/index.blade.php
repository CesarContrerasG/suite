@extends('suite.esuite')

@section('html-title')
    RECOVE - Dashboard
@endsection

@section('head')
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
@endsection

@section('header')
    @include('suite.partials.headers.recove')
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel with-padding">
                {!! $chartjs->render() !!}
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('js/functions_qore.js') }}"></script>
@endsection