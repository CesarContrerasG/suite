@if(count($contributions) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Descripción</th>
                    <th>Abreviación</th>
                    <th>Nivel</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contributions as $contribution)
                    <tr>
                        <td>{{ $contribution->con_clave }}</td>
                        <td>{{ $contribution->short_description }}</td>
                        <td>{{ $contribution->con_abrev }}</td>
                        <td>{{ $contribution->con_nivel }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.contributions.edit', $contribution) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $contribution->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $contributions->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
