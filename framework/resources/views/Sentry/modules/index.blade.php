@extends('suite.sentry')

@section('html-title')
    Módulos
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li>Módulos</li>
@endsection

@section('content')
@if(Session::has('message'))
    <div class="notification_bar animated fadeInRight">
        <p>{{ Session::get('message') }}</p>
    </div>
@endif

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Módulos de la Suite</div>
            <div class="panel-body" style="overflow: hidden;">
                @if(count($modules) > 0)
                    <div class="list-group">
                        @foreach($modules as $module)
                            <div class="list-group-item">
                                <h4 class="without-margin">{{ $module->name }}</h4>
                                <p class="text-small without-margin">{{ $module->short_description }}</p>
                                <p class="without-margin text-right">
                                    <a href="#" data-module="{{ \Hashids::encode($module->id) }}" class="show_edit_form btn btn-default btn-sm btn-round btn-round-primary">Editar Módulo</a>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    NO MODULES REGISTER
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Información del Módulo</div>
            <div class="panel-body">
                <div class="col-md-12 text-right">
                    <a href="#" class="btn btn-default btn-sm btn-round show_create_form">Registrar Módulo</a>
                </div>
                <div id="form_create">
                    @include('Sentry.modules.create')
                </div>
                <div id="form_edit">
                    @include('Sentry.modules.edit')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.show_create_form').on('click', function(e){
            e.preventDefault();
            $('#form_edit').hide().removeClass('animated fadeInRight');
            $('#form_create').show().addClass('animated fadeInRight');
        });

        $('.show_edit_form').on('click', function(e){
            e.preventDefault();
            $('#form_create').hide().removeClass('animated fadeInRight');
            module = $(this).data("module");
            console.log(module);
            $.get("modules/" + module + "/edit", function( data ) {
                $("#form_edit #module_name").val(data.module.name);
                $("#form_edit #module_description").val(data.module.description);
                $("#form_edit #module_version").val(data.module.version);
                $("#form_edit #module_url").val(data.module.url);
                $("#form_edit #module_color").val(data.module.color);
                $("#form_edit #module_script").val(data.module.script);
                $("#form_edit #module_database").val(data.module.database);

                action_edit = $("#form_edit #form_edit_module").attr("action");
                url_edit = action_edit.replace(":MODULE_ID", module);

                action_delete =$("#form_edit #form_delete_module").attr("action")
                url_delete = action_delete.replace(":MODULE_ID", module);

                $("#form_edit #form_edit_module").attr("action", url_edit);
                $("#form_edit #form_delete_module").attr("action", url_delete);

                $("#form_edit").show().addClass('animated fadeInRight');
            });
        });
    </script>
@endsection
