@if(count($identifiers) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Descripción</th>
                    <th>Nivel</th>
                    <th>Complemento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($identifiers as $identifier)
                    <tr>
                        <td>{{ $identifier->ide_clave }}</td>
                        <td>{{ $identifier->short_description }}</td>
                        <td>{{ $identifier->ide_nivel }}</td>
                        <td>{{ $identifier->ide_comp }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.identifiers.edit', $identifier) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $identifier->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $identifiers->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
