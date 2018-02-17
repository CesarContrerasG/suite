            @if(auth()->user()->company_id == auth()->user()->master_id)
                <div class="panel panel-default">
                    <div class="panel-heading border-primary">
                        <span class="configuration-primary">Módulos exclusivos de la Suite</span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            @if(count(auth()->user()->master->suite_applications) > 0)
                                @foreach(auth()->user()->master->suite_applications as $module)
                                     <div class="col-md-6">
                                        <div class="flex-box with-md-margin">
                                            <div class="enterprise-logo-app">
                                                <img src="{{ Storage::disk('logos')->url($module->logo) }}">
                                            </div>
                                            <div>
                                                <strong>{{ $module->name }}</strong>
                                                <p class="without-margin">{{ $module->description }}</p>
                                                <p class="with-md-margin-top">
                                                    <a href="{{ route($module->url) }}" class="btn btn-sm btn-round btn-round-green"><i class="icon-filter_center_focus"></i> Entrar</a>
                                                    <a href="{{ route($module->url) }}" class="btn btn-sm btn-round btn-round-green" target="_blank"><i class="icon-open_in_new"></i> Nuevo Tab</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <p><strong>Warning:</strong> Parece que no tiene módulos de administración de la <strong>ESuite</strong> activados</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading border-primary">
                        <span class="configuration-primary">Módulos Activos</span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            @if(count(auth()->user()->company->modules()->where('active', 1)->get()) > 0)
                                @foreach(auth()->user()->company->modules()->where('active', 1)->get() as $module)
                                    <div class="col-md-6">
                                        <div class="flex-box with-md-margin">
                                            <div class="enterprise-logo-app">
                                                <img src="{{ Storage::disk('logos')->url($module->logo) }}">
                                            </div>
                                            <div>
                                                <strong>{{ $module->name }}</strong>
                                                <p class="without-margin">{{ $module->description }}</p>
                                                <p class="with-md-margin-top">
                                                    <a href="{{ route($module->url, [Hashids::encode(auth()->user()->company_id)]) }}" class="btn btn-sm btn-round btn-round-green"><i class="icon-filter_center_focus"></i> Entrar</a>
                                                    <a href="{{ route($module->url, [Hashids::encode(auth()->user()->company_id)]) }}" class="btn btn-sm btn-round btn-round-green" target="_blank"><i class="icon-open_in_new"></i> Nuevo Tab</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <p><strong>Warning:</strong> Parece que no tiene módulos de administración de la <strong>ESuite</strong> activados</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
