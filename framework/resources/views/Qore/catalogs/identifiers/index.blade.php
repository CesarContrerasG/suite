@extends('suite.esuite')

@section('html-title')
    Qore - Identificadores
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.administration') }}">Administración</a></li>
    <li><a href="{{ route('qore.catalogs.index') }}">Catálogos Oficiales</a></li>
    <li>Identificadores</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_administration')
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('Qore.catalogs.identifiers.tabs')
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    @include('Qore.catalogs.identifiers.grid')
                </div>
            </div>
        </div>

    </div>

    {!! Form::open(['route' => ['qore.catalogs.identifiers.destroy', ':IDENTIFIER_ID'], 'method' => 'DELETE', 'id' => 'form_delete']) !!}
    {!! Form::close() !!}
@endsection

@section('scripts')
    <script type="text/javascript">
    $(".option-delete").click(function(e){
        e.preventDefault();

        var section = $(this).parent().parent().parent().parent().parent().parent();
        var aduana = $(this).data("id");
        var form = $('#form_delete');
        var url = form.attr('action').replace(':IDENTIFIER_ID', aduana);
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
