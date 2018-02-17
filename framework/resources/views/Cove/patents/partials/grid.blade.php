@if(count($patents) > 0)
    <div>
        <table class="table table-striped table-condensed" id="table">
            <thead>
                <tr>
                    <th>Patente</th>   
                    <th>Razón Social</th>
                    <th>R.F.C.</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patents as $patent)
                    <tr>
                        <td>{{ $patent->pk_age }}</td>
                        <td>{{ $patent->age_razon }}</td>
                        <td>{{ $patent->age_rfc }}</td>
                        <td>
                            <div class="dropdown">
                                @if($type < 6)
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                @endif
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    @if($type < 6)
                                    <li><a href="{{ route('cove.patents.edit', $patent->pk_item) }}">Editar</a></li>
                                    @endif
                                    @if($type < 5)
                                    <li><a href="#" data-method="delete" rel="nofollow" class="delete" data-url="patents/{{ $patent->pk_item }}/destroy" data-token="{{ csrf_token() }}">Eliminar</a></li> 
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
        <strong><i class="icon-alert"></i> Advertencia.</strong> Usted no tiene agentes aduanales registrados
    </div>
@endif

