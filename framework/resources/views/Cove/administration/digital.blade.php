@extends('suite.esuite')

@section('html-title')
    COVE - Digitalizar Documentos
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/chosen.min.css') }}">
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection


@section('breadcrumb')
    <li><a href="{{ route('cove.administration.index') }}"><i class="icon-icon"></i>Administracion</a></li>
    <li>Digitalizar Documentos</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Digitalizar Documentos
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['route' => 'cove.digital.store', 'method' => 'POST', 'files' => true, 'class' => 'form']) !!}                                        
                                @include('Cove.administration.partials.digital')
                            {!! Form::close() !!}                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('scripts')
    <script src="{{ asset('dist/js/chosen.jquery.min.js') }}"></script>
    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    </script>
@endsection



