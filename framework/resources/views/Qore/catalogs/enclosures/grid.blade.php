@if(count($enclosures) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <td>Clave</td>
                    <td>Recinto Fiscalizado</td>
                    <td>Aduana</td>
                    <td>Acciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($enclosures as $enclosure)
                    <tr>
                        <td>{{ $enclosure->rec_clave }}</td>
                        <td>{{ $enclosure->rec_nombre }}</td>
                        <td>{{ $enclosure->aduana->adu_denomina }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.enclosures.edit', $enclosure) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $enclosure->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $enclosures->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
