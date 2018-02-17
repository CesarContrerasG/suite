@extends('suite.sentry')

@section('html-title')
    Privilegios para los Módulos
@endsection

@section('header')
    @include('suite.partials.headers.sentry')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('sentry.tools.index') }}">Herramientas</a></li>
    <li><a href="{{ route('sentry.security.index') }}">Seguridad</a></li>
    <li>Privilegios para los Módulos</li>
@endsection

@section('content')
    <div class="row">

        <div class="col-md-4">
            @include('Sentry.tools.partials.panel_toolbox')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="flex-box">
                        <div class="with-margin-right">
                            <i class="text-xl icon-equalizer"></i>
                        </div>
                        <div>
                            <h3 class="without-margin">Privilegios</h3>
                            <p class="without-margin">Configuración de los niveles para los diferentes módulos de la Suite</p>
                        </div>
                    </div>
                </div>
            </div>

            <!--<div class="panel panel-default">
                <div class="panel-body">
                    @foreach($modules as $module)
                        <div>
                            <i class="icon-stackoverflow"></i> {{ $module->name }}
                            
                        </div>
                    @endforeach
                </div>
            </div> -->

            <div class="panel-group without-underline" id="accordion" role="tablist" aria-multiselectable="true">
                @foreach ($modules as $module)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="module-{{ $module->id }}">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $module->id }}" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="flex-box">
                                        <div class="with-margin-right">
                                            <i class="icon-make-group text-large"></i>
                                        </div>
                                        <div>
                                            <p class="without-margin"><strong><span class="secundary-element">{{ $module->name }}</span></strong></p>
                                            <p class="widthout-margin text-small">{{ $module->description }}</p>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-{{ $module->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="widget-privileges">
                                    @foreach($nivels as $nivel)
                                        <?php
                                            $active = \DB::table('modules_types')->where('module_id', $module->id)->where('type_id', $nivel->id)->where('active', 1)->count();
                                        ?>
                                        <div class="widget-privileges-item text-center">
                                            <input type="checkbox" name="toggle" class="sw" id="{{ $module->id."-".$nivel->id."-".$nivel->name }}" data-module="{{ $module->id }}" data-type="{{ $nivel->id }}" {{ ($active == 1) ? 'checked' : '' }}>
                                            <label for="{{ $module->id."-".$nivel->id."-".$nivel->name }}"></label>
                                            <p class="text-center">{{ $nivel->name }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>
    {!! Form::open(['route' => 'sentry.privileges.set', 'method' => 'POST', 'id' => 'form_active']) !!}
        {!! Form::hidden('module_id', null, ['id' => 'module_id']) !!}
        {!! Form::hidden('type_id', null, ['id' => 'type_id']) !!}
    {!! Form::close() !!}
@endsection

@section('scripts')
    <script>
        $('.sw').on('click', function(){
            var module = $(this).data("module");
            var type =  $(this).data("type");
            var form = $("#form_active");
            
            $('#module_id').val(module);
            $('#type_id').val(type);

            var data = form.serialize();
            var url = form.attr('action');

            $.post(url, data, function(result){
                console.log(result.message);
            }).fail(function(){
                alert("Lo sentimos hubo un error al realizar peticiones asincronicas !!");
                //location.reload();
            });
        });
    </script>
@endsection