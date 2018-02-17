@if(count($countries) > 0)
    <div>
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>Clave SAAI FIII</th>
                    <th>Clave SAAI m3</th>
                    <th>Pais</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country)
                    <tr>
                        <td>{{ $country->pai_clavefiii }}</td>
                        <td>{{ $country->pai_clavem3 }}</td>
                        <td>{{ $country->short_nombre }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    <li><a href="{{ route('qore.catalogs.countries.edit', $country) }}">Editar</a></li>
                                    <li><a href="#" class="option-delete" data-id="{{ $country->id }}">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center suite-pagination-green">
        {{ $countries->links() }}
    </div>
@else
    No hay registros en la base de datos
@endif
