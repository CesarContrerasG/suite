@if(count($companies) > 0)
    @foreach($companies as $company)
        <div class="list-group-item">
            <div class="flex-box space-between">
                <div class="flex-box">
                    @if($company->status == 1)
                        <div class="badge-circle badge-active-green">
                            <i class="icon-eye"></i>
                        </div>
                    @else
                        <div class="badge-circle">
                            <i class="icon-eye-blocked"></i>
                        </div>
                    @endif
                    <div class="paragraph-info">
                        <h3>{{ $company->name }}</h3>
                        <p>{{ $company->rfc }}</p>
                    </div>
                </div>

                <div class="collection_options">
                    <div class="dropdown">
                        <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-provider" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Opciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdown-provider">
                            <li><a href="{{ route('qore.providers.disabled', Hashids::encode($company->id)) }}">
                                @if($company->status == 1)
                                    Desactivar
                                @else
                                    Activar
                                @endif
                            </a></li>
                            <li><a href="{{ route('qore.providers.edit', Hashids::encode($company->id)) }}">Editar</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" data-method="delete" rel="nofollow" data-url="providers/{{ Hashids::encode($company->id) }}/destroy" class="delete" data-token="{{ csrf_token() }}">Eliminar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="list-group-item">
        <div class="alert alert-warning">
            <strong>Advertencia.</strong> Usted no tiene proveedores registrados
        </div>
    </div>
@endif
