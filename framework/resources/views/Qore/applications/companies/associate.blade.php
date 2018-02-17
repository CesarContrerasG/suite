@extends('suite.esuite')

@section('html-title')
    Qore - Aplicaciones asociadas a Empresas
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.css') }}">
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.applications') }}">Aplicaciones</a></li>
    <li>Aplicaciones asociadas a Empresas</li>
@endsection

@section('content')
    <div class="row">

        <div class="col-md-4">
            @include('Qore.partials.sidebar_applications');
        </div>

        <div class="col-md-8">
            @include('Qore.applications.companies.grid')
        </div>
    </div>
@endsection

{!! Form::open(['route' => ['qore.applications.active', ':COMPANY_ID'], 'method' => 'POST', 'role' => 'form', 'id' => 'form_associate']) !!}
    {{ Form::hidden('module_id', null, ['id' => 'field_module']) }}
{!! Form::close() !!}

@section('scripts')
    <script src="{{ asset('js/jquery.toast.js') }}"></script>
    <script>
        $('.module-activate').click(function(e){
            var object = $(this);
            if(object.prop('checked')){
                object.parent().parent().removeClass("blocked");
                
            } else {
                object.parent().parent().addClass("blocked");
            }
                
            var module = object.data("module");
            var company = object.data("company");
            var form = $("#form_associate");

            $("#field_module").val(module);

            var url = form.attr("action").replace(":COMPANY_ID", company);
            var data = form.serialize();

            $.post(url, data, function(result){
                console.log(result.message);
                $.toast({
                    heading: "Success",
                    text: result.message,
                    showHideTransition: "slide",
                    hideAfter: 4000,
                    icon: "success"
                });
            }).fail(function(){
                $.toast({
                    heading: "Error",
                    text: "No pudimos comunicarnos con el servidor, intente de nuevo más tarde por favor.",
                    showHideTransition: "slide",
                    hideAfter: 6000,
                    icon: "error"
                });
            });
        });
    </script>
@endsection