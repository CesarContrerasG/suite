@if(count($consultations) > 0)
    <div>
        <table class="table table-striped table-condensed" id="table">
            <thead>
                <tr>
                    <th>RFC</th>   
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consultations as $consultation)
                    <tr>                                            
                        <td>{{ $consultation->rfc_consulta }}</td>
                        <td>{{ $consultation->nombre_consulta }}</td>
                        <td>
                            <div class="dropdown">
                                @if($type < 6)
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                @endif
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    @if($type < 6)
                                    <li><a href="{{ route('cove.consultations.edit', $consultation->pk_item) }}">Editar</a></li>
                                    @endif
                                    @if($type < 5)
                                    <li><a href="#" data-method="delete" rel="nofollow" class="delete" data-url="consultations/{{ $consultation->pk_item }}/destroy" data-token="{{ csrf_token() }}">Eliminar</a></li>                                                          
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-warning">
        <strong><i class="icon-alert"></i> Advertencia.</strong> Usted no tiene clientes registrados
    </div>
@endif

