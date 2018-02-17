@foreach(auth()->user()->master->clients as $company)
    <div class="panel panel-default panel-hidden" id="panel-company-{{ $company->id }}">
        <div class="panel-heading border-primary">
            <span class="configuration-primary">Suite del Cliente: {{ $company->name }}</span>
        </div>
        <div class="panel-body">
            @if(count($company->modules()->where('active', 1)->get()) > 0)
                @foreach($company->modules()->where('active', 1)->get() as $module)
                    <div class="col-md-6">
                        <div class="flex-box with-md-margin">
                            <div class="enterprise-logo-app">
                                <img src="{{ Storage::disk('logos')->url($module->logo) }}">
                            </div>
                            <div>
                                <strong>{{ $module->name }}</strong>
                                <p class="without-margin">{{ $module->description }}</p>
                                <p class="with-md-margin-top">
                                    <a href="{{ route($module->url, [Hashids::encode($company->id)]) }}" class="btn btn-sm btn-round btn-round-green"><i class="icon-filter_center_focus"></i> Entrar</a>
                                    <a href="{{ route($module->url, [Hashids::encode($company->id)]) }}" class="btn btn-sm btn-round btn-round-green" target="_blank"><i class="icon-open_in_new"></i> Nuevo Tab</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-warning">
                    <p><strong>Warning:</strong> No ha asociado ninguna aplicación a la empresa</p>
                </div>
            @endif
        </div>
    </div>
@endforeach