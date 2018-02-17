@if(count($substances) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Medio de Transporte</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($substances as $substance)
                    <tr>
                        <td>{{ $substance->sus_clase }}</td>
                        <td>{{ $substance->sus_denomina }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.substances.edit', $substance) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $substance->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $substances->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
