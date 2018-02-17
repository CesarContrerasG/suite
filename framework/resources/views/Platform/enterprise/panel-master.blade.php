<div class="panel panel-default">
    <div class="panel-heading heading-logo">
        @if(auth()->user()->master->company->logo != "")
            <img src="{{ Storage::disk('companies')->url(auth()->user()->master->company->id.'/'.auth()->user()->master->company->logo) }}" alt="Logo Empresa">
        @else
            <img src="" alt="Logo Empresa">
        @endif
    </div>
    <div class="list-group enterprise-list-group">
        <div class="list-group-item">
            <i class="icon-room"></i> {{ auth()->user()->master->company->state.", ".auth()->user()->master->company->country }}
        </div>
        <div class="list-group-item">
            <i class="icon-local_offer"></i> Comercio Exterior{{-- auth()->user()->master->company->sector --}}
        </div>
        <div class="list-group-item">
            <i class="icon-phone2"></i> {{ auth()->user()->master->company->phone }}
        </div>
        <div class="list-group-item">
            <i class="icon-language"></i>
            @if(isset($configuration))
                @if($configuration->website != "")
                    <a href="http://{{ $configuration->website }}" target="_blank" class="configuration-anchor"><strong>Sitio Web {{ auth()->user()->master->company->name }}</strong></a>
                @else
                    Sitio Web No Configurado
                @endif
            @else
                Sitio Web No Registrado
            @endif
        </div>
    </div>
</div>