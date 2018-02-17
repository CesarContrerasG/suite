@if(count($users) > 0)
    @foreach($users as $user)
        <div class="list-group-item">
            <div class="flex-box space-between">
                <div class="flex-box">
                    @if($user->status == 1)
                        <div class="badge-circle badge-active-green">
                            <i class="icon-layers"></i>
                        </div>
                    @else
                        <div class="badge-circle">
                            <i class="icon-layers_clear"></i>
                        </div>
                    @endif
                    <div class="paragraph-info">
                        <h3>{{ $user->name.' '.$user->last_name }}</h3>
                        <p>{{ $user->current_master->business_name }}</p>
                    </div>
                </div>

                <div class="collection_options">
                    <div class="dropdown">
                        <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Opciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdown-user">
                            <li><a href="{{ route('qore.users.disabled', Hashids::encode($user->id)) }}">
                                @if($user->status == 1)
                                    Desactivar
                                @else
                                    Activar
                                @endif
                            </a></li>
                            @if($user->departament_id != 0)
                                <li><a href="{{ route('qore.users.edit', Hashids::encode($user->id)) }}">Editar</a></li>
                            @else 
                                <li><a href="{{ route('qore.users.client.edit', Hashids::encode($user->id)) }}">Editar</a></li>
                            @endif
                            <li><a href="{{ route('qore.applications.users.associate', Hashids::encode($user->id)) }}">Permisos</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" data-method="delete" rel="nofollow" data-url="users/{{ Hashids::encode($user->id) }}/destroy" class="delete" data-token="{{ csrf_token() }}">Eliminar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="list-group-item">
        <div class="alert alert-warning">
            <strong><i class="icon-alert"></i> Advertencia.</strong> Usted no tiene usuarios registrados
        </div>
    </div>
@endif
