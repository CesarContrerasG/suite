<div class="panel panel-default">
    <div class="panel-heading"><span class="heading-title-platform"><i class="icon-flag"></i> Accesos & Permisos</span></div>
    <div class="panel-body">
        @if(count(auth()->user()->companies) > 0)
            @foreach(auth()->user()->companies->groupBy('id') as $company)
                <div><strong class="text-color text-purple">{{ $company[0]['name'] }}</strong></div>
                <div class="widget-profile-data">
                    @if(auth()->user()->applications()->where("company_id", $company[0]['id'])->get())
                        @foreach(auth()->user()->applications()->where("company_id", $company[0]['id'])->get() as $module)
                            <div class="profile-data-item">
                                <p class="without-margin data-tag">{{ $module->name }}</p>
                                <p class="without-margin">{{ \App\Sentry\Type::where('id', $module->pivot->type_id)->first()->name }}</p>
                            </div>
                        @endforeach
                    @else 
                        <p class="without-margin data-tag">SIN APLICACIONES PARA ESTA EMPRESA</p>
                    @endif
                </div>
            @endforeach
        @else
            <div class="profile-data-item">
                <p class="without-margin data-tag">SIN PERMISOS CONFIGURADOS</p>
            </div>
        @endif
    </div>
</div>