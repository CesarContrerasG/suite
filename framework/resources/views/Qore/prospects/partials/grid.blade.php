@if(count($prospects) > 0)
    @foreach($prospects as $prospect)
        <div class="list-group-item">
            <div class="flex-box space-between">
                <div class="flex-box">
                    @if($prospect->status == 1)
                        <div class="badge-circle badge-active-green">
                            <i class="icon-eye"></i>
                        </div>
                    @else
                        <div class="badge-circle">
                            <i class="icon-eye-blocked"></i>
                        </div>
                    @endif
                    <div class="paragraph-info">
                        <h3>{{ $prospect->name }}</h3>
                        <p class="text-color text-blue">{{ $prospect->phone }}</p>
                    </div>
                </div>

                <div class="collection_options">
                    <div class="dropdown">
                        <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-prospect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Opciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdown-prospect">
                            <li><a href="{{ route('qore.companies.disabled', Hashids::encode($prospect->id)) }}">
                                @if($prospect->status == 1)
                                    Desactivar
                                @else
                                    Activar
                                @endif
                            </a></li>
                            <li><a href="{{ route('qore.prospects.edit', Hashids::encode($prospect->id)) }}">Editar</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" data-method="delete" rel="nofollow" data-url="prospects/{{ Hashids::encode($prospect->id) }}/destroy" class="delete" data-token="{{ csrf_token() }}">Eliminar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="list-group-item">
        <div class="alert alert-warning">
            <strong>Advertencia.</strong> Usted no tiene prospectos registrados
        </div>
    </div>
@endif
