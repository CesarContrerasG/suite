@if(count($factors) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Moneda</th>
                    <th>Equivalencia</th>
                    <th>Fecha</th>
                    <th>Acciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factors as $factor)
                    <tr>
                        <td>{{ $factor->fmo_moneda }}</td>
                        <td>{{ $factor->fmo_equival }}</td>
                        <td>{{ $factor->fmo_fecha }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.factors.edit', $factor) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $factor->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $factors->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
