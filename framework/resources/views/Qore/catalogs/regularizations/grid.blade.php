@if(count($regularizations) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Descripción</th>
                    <th>Institución</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($regularizations as $regularization)
                    <tr>
                        <td>{{ $regularization->reg_clave }}</td>
                        <td>{{ $regularization->short_description }}</td>
                        <td>{{ $regularization->short_institution }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.regularizations.edit', $regularization) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $regularization->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $regularizations->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
