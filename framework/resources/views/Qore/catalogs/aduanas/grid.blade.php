@if(count($aduanas) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Aduana</th>
                    <th>Sección</th>
                    <th>Denominación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aduanas as $aduana)
                    <tr>
                        <td>{{ $aduana->adu_numero }}</td>
                        <td>{{ $aduana->adu_seccion }}</td>
                        <td>{{ $aduana->short_denomination }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.aduana.edit', $aduana) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $aduana->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $aduanas->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
