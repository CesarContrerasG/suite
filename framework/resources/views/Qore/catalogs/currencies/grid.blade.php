@if(count($currencies) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Pais</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($currencies as $currency)
                    <tr>
                        <td>{{ $currency->mon_clave }}</td>
                        <td>{{ $currency->mon_nombre }}</td>
                        @if($currency->mon_pais == 0)
                            <td>País no especificado </td>
                        @else
                            <td>{{ $currency->country->short_nombre }}</td>
                        @endif
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.currencies.edit', $currency) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $currency->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $currencies->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
