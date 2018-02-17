@if(count($inpc) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Año</th>
                    <th>Periodo</th>
                    <th>Valor</th>
                    <th>Recargo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inpc as $record)
                    <tr>
                        <td>{{ $record->inp_anio }}</td>
                        <td>{{ $record->inp_periodo }}</td>
                        <td>{{ $record->inp_valor }}</td>
                        <td>{{ $record->inp_recargo }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.inpc.edit', $record) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $record->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $inpc->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
