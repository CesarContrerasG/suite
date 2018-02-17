@if(count($units) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $unit)
                    <tr>
                        <td>{{ $unit->ume_clave }}</td>
                        <td>{{ $unit->ume_nombre }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.units.edit', $unit) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $unit->id }}">Eliminar</a></li>
                                </ul>
                            </div>                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $units->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
