@if(count($consolids) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Campo</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consolids as $consolid)
                    <tr>
                        <td>{{ $consolid->con_campo }}</td>
                        <td>{{ $consolid->con_tipo }}</td>
                        <td>{{ $consolid->con_valor }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.consolids.edit', $consolid) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $consolid->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $consolids->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
