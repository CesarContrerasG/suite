{{--@if(count($coves) > 0)--}}
    <div>
        <table class="table table-striped table-condensed" id="table" >
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkTodos">Todos</th>
                    <th>Referencia</th>   
                    <th>Factura/Relación</th>
                    <th>COVE</th>
                    <th>Adenda</th>
                    <th>Fecha Expedicion</th>
                    <th>Patente</th>
                    <th>Tipo Operacion</th>
                    <th>Relación</th>
                    <th>Errores</th>
                    <th></th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                {{--@foreach ($coves as $id => $cove)
                    <tr>
                        @if($cove->cove_status != 2)
                        <td> <input type="checkbox" name="chk[{{$id}}]" value="{{$cove->pk_item}}" > </td>
                        @else
                        <td></td>
                        @endif
                        <td>{{ $cove->pk_referencia }}</td>
                        <td>{{ $cove->cove_factura}}</td>
                        <td>{{ $cove->cove_edocument }}</td>
                        <td>{{ $cove->cove_numadenda }}</td>
                        <td>{{ $cove->cove_fecha }}</td>
                        <td>{{ $cove->cove_patente }}</td>
                        <td>{{ $cove->pk_tipo == 1 ? 'Importación' : 'Exportación' }}</td>                        
                        <td>{{ $cove->cove_relacion == 1 ? 'SI' : 'NO' }}</td>
                        <td>{{ $cove->errores }}</td>
                        <td>
                            @if($cove->errores != '' || $cove->cove_edocument == '')
                            <i class="icon-cross text-color text-red"></i>
                            @else
                            <i class="icon-checkmark text-color text-green"></i></td>
                            @endif
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    @if($type < 6) 
                                        @if($cove->cove_status != 2)
                                        <li><a href="{{ route('cove.edit', $cove->pk_item) }}">{{ $cove->cove_edocument != '' ? 'Adendar' : 'Editar' }}</a></li>
                                        @endif
                                    @endif
                                    <li><a href="{{ route('cove.show', $cove->pk_item) }}" target="_blank">Visualizar</a></li>
                                    {{---<li><a href="{{ route('cove.sign', [$cove->pk_item, 0]) }}">Firmar</a></li>--}}
                                  {{-- <li><a href="{{ route('cove.digital', $cove->pk_item) }}">Digitalización</a></li>
                                    @if($cove->cove_edocument != '')
                                    <li><a href="{{ route('cove.download', $cove->pk_item) }}">XML</a></li>
                                    @endif
                                    @if($type < 5) 
                                    <li><a href="#" data-method="delete" rel="nofollow" class="delete" data-url="{{ $cove->pk_item }}/destroy" data-token="{{ csrf_token() }}">Eliminar</a></li>
                                    @endif                                                          
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach--}}
            </tbody>
        </table>
    </div>
{{--
@else
   <div class="list-group-item">
        <div class="alert alert-warning">
            <strong><i class="icon-alert"></i> Advertencia.</strong> Usted no tiene COVE registrados
        </div>
    </div>
@endif
--}}
