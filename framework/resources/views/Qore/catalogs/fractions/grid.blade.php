@if(count($fractions) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Fraccion</th>
                    <th>Descripción</th>
                    <th>Descripción</th>
                    <th>Descripción</th>
                    <th>Unidad</th>
                    <th>Advotr</th>
                    <th>Acciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fractions as $fraction)
                    <tr>
                        <td>{{ $fraction->fra_fraccion }}</td>
                        <td>{{ $fraction->fra_descrip1 }}</td>
                        <td>{{ $fraction->fra_descrip2 }}</td>
                        <td>{{ $fraction->fra_descrip3 }}</td>
                        <td>{{ $fraction->fra_unidad }}</td>
                        <td>{{ $fraction->fra_advotr }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.fractions.edit', $fraction) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $fraction->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $fractions->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
