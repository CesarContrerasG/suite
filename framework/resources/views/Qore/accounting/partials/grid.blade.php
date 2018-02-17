<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                @if(count($records) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th>Importe</th>
                                <th>IVA</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)
                            <tr>
                                <td>{{ $record->description }}</td>
                                @if($record->type == 1)
                                    <td><strong class="text-color text-green">INGRESO</strong></td>
                                @else
                                    <td><strong class="text-color text-yellow">EGRESO</strong></td>
                                @endif
                                <td><strong class="text-color text-green">${{ number_format($record->amount, 2, '.', ',') }}</strong></td>
                                <td><strong class="text-color text-green">${{ number_format($record->iva, 2, '.', ',') }}</strong></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Opciones <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdown-accounting">
                                            <li><a href="{{ route('qore.accounting.show', $record->id) }}">Detalles</a></li>
                                            <li><a href="{{ route('qore.accounting.edit', $record->id) }}">Editar</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#" class="btn-delete" data-record="{{ $record->id }}">Eliminar</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning">
                        <strong>Advertencia</strong> No se encontrarón datos registrados
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>