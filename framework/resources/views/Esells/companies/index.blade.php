@extends('layouts.qore')

@section('htmlheader_title')
    E-Sells | Empresas
@endsection

@section('header')
    @include('Headers.esells')
@endsection

@section('breadcrumb')
    <li><i class="icon icon-dollar-symbol"></i>Empresas</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            Filtros
        </div>
        <div class="col-md-9">
            <div id="grid-component" ></div>
        </div>
    </div>
   
@endsection

@section('scripts')
<script src="{{ asset('js/react.min.js') }}"></script>
<script src="{{ asset('js/react-dom.min.js') }}"></script>
<!-- <script src="{{ asset('dist/react-components/app.js') }}"></script> -->
<script src="{{ asset('dist/react-components/grid-component.js') }}"></script>
@endsection