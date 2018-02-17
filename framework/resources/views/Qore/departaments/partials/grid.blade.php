@if(count($departaments) > 0)
    @foreach ($departaments as $departament)
        <div class="list-group-item">
            <div class="flex-box space-between">
                <div class="flex-box">
                    @if($departament->status == 1)
                        <div class="badge-circle badge-active-green">
                            <i class="icon-layers"></i>
                        </div>
                    @else
                        <div class="badge-circle">
                            <i class="icon-layers_clear"></i>
                        </div>
                    @endif
                    <div class="paragraph-info">
                        <h3>{{ $departament->name }}</h3>
                        <p>{{ $departament->description }}</p>
                    </div>
                </div>

                <div class="collection_options">
                    <div class="dropdown">
                        <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-departament" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Opciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdown-departament">
                            <li><a href="{{ route('qore.departaments.disabled', Hashids::encode($departament->id)) }}">
                                @if($departament->status == 1)
                                    Desactivar
                                @else
                                    Activar
                                @endif
                            </a></li>
                            <li><a href="{{ route('qore.departaments.edit', Hashids::encode($departament->id)) }}">Editar</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" data-method="delete" rel="nofollow" data-url="departaments/{{ Hashids::encode($departament->id) }}/destroy" class="delete" data-token="{{ csrf_token() }}">Eliminar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="list-group-item">
        <div class="alert alert-warning">
            <strong><i class="icon-alert"></i> Advertencia.</strong> Usted no tiene departamentos registrados
        </div>
    </div>
@endif
