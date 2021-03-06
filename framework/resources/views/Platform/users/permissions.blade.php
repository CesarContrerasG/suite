@extends('suite.enterprise')

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

            <div class="col-md-4">
                @include('Platform.enterprise.panel-master')
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Permisos para {{ $user->fullname }}</div>
                    <div class="panel-body">
                        @foreach ($modules as $module)
                            <div class="widget-name-app">
                                <div><i class="icon-radio-unchecked" style="color: {{ $module->color }};"></i></div>
                                <div><p>{{ $module->name }}</p></div>
                            </div>
                            @if(count($module->established_types) > 0)
                                <div class="widget-option-group option-group-green">
                                    @foreach($module->established_types as $type)
                                        <?php
                                            $registered = count($user->modules()->where('module_id', $module->id)->where('type', $type->id)->get());
                                        ?>
                                        <label class="option-group-item {{ ($registered == 1) ? ' active' : '' }}" data-module="{{ $module->id }}" data-type="{{ $type->id }}">
                                            <input type="radio" class="option" name="{{ $module->name }}" {{ ($registered == 1) ? 'checked' : '' }}>
                                            <i class="{{ \App\Helpers::getIconNivel($type->id) }}"></i>
                                            @if($type->name == "Administrador")
                                                <p>Admin</p>
                                            @else
                                                <p>{{ $type->name }}</p>
                                            @endif
                                        </label>
                                    @endforeach
                                </div>
                            @else
                                No configurados
                            @endif
                        @endforeach
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <div class="form-group">
                                    <a href="{{ route('platform.users.index') }}" class="btn btn-default btn-sm btn-round btn-round-green">Configuración Terminada</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
@endsection

{!! Form::open(['route' => ['platform.users.privileges', Hashids::encode($user->id)], 'method' => 'POST', 'role' => 'form', 'id' => 'form_privileges']) !!}
    {!! Form::hidden('module_id', null, ['id' => 'field_module_id']) !!}
    {!! Form::hidden('type_id', null, ['id' => 'field_type_id']) !!}
    {!! Form::hidden('master_id', auth()->user()->master_id) !!}
{!! Form::close() !!}

@section('scripts')
    <script>
       $('.option-group-item').click(function(){
            var object = $(this);
            if(object.children('.option').prop('checked')){
                name = object.children('.option').attr('name');
                $('input[name="' + name + '"]').parent().removeClass('active');
                object.addClass('active'); 

                var module = object.data("module");
                var type = object.data("type");
                var form = $("#form_privileges");

                $("#field_module_id").val(module);
                $("#field_type_id").val(type);

                var data = form.serialize();
                var url = form.attr('action');

                $.post(url, data, function(result){
                    console.log(result.message);
                }).fail(function(){
                    alert("Lo sentimos hubo un error al realizar peticiones asincronicas");
                });

            }else{
                $(this).removeClass('active');
            }
        });
    </script>
@endsection