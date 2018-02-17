@extends('suite.esuite')

@section('html-title')
    Qore - Indice Nacional del Precio al Consumidor
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}">Administración</a></li>
    <li><a href="{{ route('qore.catalogs.index') }}">Catálogos Oficiales</a></li>
    <li>Indice Nacional del Precio al Consumidor</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('Qore.partials.sidebar_administration')
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('Qore.catalogs.inpc.tabs')
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('Qore.catalogs.inpc.grid')
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(['route' => ['qore.catalogs.inpc.destroy', ':INPC_ID'], 'method' => 'DELETE', 'id' => 'form_delete']) !!}
    {!! Form::close() !!}
@endsection

@section('scripts')
    <script type="text/javascript">
    $(".option-delete").click(function(e){
        e.preventDefault();

        var section = $(this).parent().parent().parent().parent().parent().parent();
        var aduana = $(this).data("id");
        var form = $('#form_delete');
        var url = form.attr('action').replace(':INPC_ID', aduana);
        var data = form.serialize();

        section.fadeOut();

        $.post(url, data, function(result){
            alert(result.message);
        }).fail(function(){
            alert("Lo sentimos hubo un error al realizar peticiones asincronas !!");
            location.reload();
        });

    });
    </script>
@endsection
