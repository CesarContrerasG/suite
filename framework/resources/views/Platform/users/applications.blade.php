@extends('suite.enterprise')

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.css') }}">
@endsection

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ route('platform.users.index') }}">Usuarios</a></li>
    <li>Establecer Permisos del Usuario</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="widget-applications-user">

                            <div class="applications-user-aside">
                                <div class="flex-box">
                                    @if ($user->photo != "")
                                        <img src="{{ Storage::disk('users')->url($user->id.'/'.$user->photo) }}" alt="avatar user">
                                    @else
                                        <img src="{{ asset('img/default/avatar.png') }}" alt="avatar user">
                                    @endif
                                    <div class="application-username">
                                        <p><strong>{{ $user->fullname }}</strong></p>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="application-footer-aside">
                                    <p><strong class="text-color text-green">{{ $user->company->business_name }}</strong></p>
                                </div>
                            </div>

                            <div class="applications-user-company">
                                @if (isset($master_apps) && count($master_apps) > 0)
                                    <div class="applications-company-header">
                                        <i class="icon-office text-color text-green"></i> <strong class="text-color text-green">{{ $user->company->name }}</strong>
                                    </div>

                                    <div class="applications-company-actives">
                                        @foreach ($master_apps as $module)
                                            <div class="widget-name-app">
                                                <div><i class="icon-radio-unchecked" style="color: {{ $module->color }};"></i></div>
                                                <div><p>{{ $module->name }}</p></div>
                                            </div>

                                            <div class="widget-option-group option-group-green">
                                                @if(count($module->established_types) > 0)
                                                    @foreach($module->established_types as $type)
                                                        <?php
                                                            $registered = count($user->privileges()->where('company_id', $user->company_id)->where('module_id', $module->id)->where('type_id', $type->id)->get());
                                                        ?>
                                                        <label class="option-group-item {{ ($registered == 1) ? ' active' : '' }}" data-company="{{ $user->company_id }}" data-module="{{ $module->id }}" data-type="{{ $type->id }}">
                                                            <input type="radio" class="option" name="{{ $user->company->name }}{{ $module->name }}" {{ ($registered == 1) ? 'checked' : '' }}>
                                                            <i class="{{ \App\Helpers::getIconNivel($type->id) }}"></i>
                                                            @if($type->name == "Administrador")
                                                                <p>Admin</p>
                                                            @else
                                                                <p>{{ $type->name }}</p>
                                                            @endif
                                                        </label>
                                                    @endforeach
                                                @else
                                                    <div class="alert alert-warning">
                                                        <p><strong>Warning:</strong> No hay permisos asociados a la aplicación</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @foreach($clients as $client)
                                    <div class="applications-company-header">
                                        <i class="icon-domain"></i> {{ $client->name }}
                                    </div>

                                    <div class="applications-company-actives">
                                        @if(count($client->modules()->where('active', 1)->get()) > 0)
                                            @foreach($client->modules()->where('active', 1)->get() as $module)
                                                <div class="widget-name-app">
                                                    <div><i class="icon-radio-unchecked" style="color: {{ $module->color }};"></i></div>
                                                    <div><p>{{ $module->name }}</p></div>
                                                </div>
                                                <div class="widget-option-group option-group-green">
                                                    @if(count($module->established_types) > 0)
                                                        @foreach($module->established_types as $type)
                                                            <?php
                                                            $registered = count($user->privileges()->where('company_id', $client->id)->where('module_id', $module->id)->where('type_id', $type->id)->get());
                                                            ?>
                                                            <label class="option-group-item {{ ($registered == 1) ? ' active' : '' }}" data-company="{{ $client->id }}" data-module="{{ $module->id }}" data-type="{{ $type->id }}">
                                                                <input type="radio" class="option" name="{{ $client->name }}{{ $module->name }}" {{ ($registered == 1) ? 'checked' : '' }}>
                                                                <i class="{{ \App\Helpers::getIconNivel($type->id) }}"></i>
                                                                @if($type->name == "Administrador")
                                                                    <p>Admin</p>
                                                                @else
                                                                    <p>{{ $type->name }}</p>
                                                                @endif
                                                            </label>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-warning">
                                                            <p><strong>Warning:</strong> No hay permisos asociados a la aplicación</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="alert alert-warning">
                                                <p><strong>Warning:</strong> No ha asociado ninguna aplicación a la empresa</p>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

{!! Form::open(['route' => ['platform.applications.associate', \Hashids::encode($user->id)], 'method' => 'POST', 'role' => 'form', 'id' => 'form_associate_user']) !!}
{!! Form::hidden('company_id', null, ['id' => 'field_company_id'])  !!}
{!! Form::hidden('module_id', null, ['id' => 'field_module_id']) !!}
{!! Form::hidden('type_id', null, ['id' => 'field_type_id']) !!}
{!! Form::close() !!}

@section('scripts')
    <script src="{{ asset('js/jquery.toast.js') }}"></script>
    <script>
        $('.option-group-item').click(function(){
            var object = $(this);

            if(object.children('.option').prop('checked')){
                name = object.children('.option').attr('name');
                $('input[name="' + name + '"]').parent().removeClass('active');
                object.addClass('active');

                var company = object.data("company");
                var module = object.data("module");
                var type = object.data("type");

                $("#field_company_id").val(company);
                $("#field_module_id").val(module);
                $("#field_type_id").val(type);

                var form = $("#form_associate_user");
                var url = form.attr("action");
                var data = form.serialize();

                $.post(url, data, function(result){
                    console.log(result.message);
                    if(result.heading == "Information"){
                        $.toast({
                            heading: result.heading,
                            text: result.message,
                            showHideTransition: "slide",
                            hideAfter: 6000,
                            icon: "info"
                        });
                    }
                    $.toast({
                        heading: result.heading,
                        text: result.message,
                        showHideTransition: "slide",
                        hideAfter: 7000,
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
            } else {
                object.removeClass('active');
            }
        });
    </script>
@endsection
