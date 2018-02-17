@if(count($strategics) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Aduana</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($strategics as $strategic)
                    <tr>
                        <td>{{ $strategic->rec_clave }}</td>
                        <td>{{ $strategic->short_name }}</td>
                        <td>{{ $strategic->aduana->extrashort_denomination }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.strategics.edit', $strategic) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $strategic->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $strategics->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
