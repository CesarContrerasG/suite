@if(count($customers) > 0)
    <div>
        <table class="table table-striped table-condensed" id="table">
            <thead>
                <tr>
                    <th>Razón Social</th>   
                    <th>Identificador</th>
                    <th>Tipo</th>
                    <th>Calle</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->short_name }}</td>
                        @if($customer->cli_tipo == 1)
                        <td>{{ $customer->cli_rfc }}</td>
                        <td>NACIONAL</td>
                        @else
                        <td>{{ $customer->cli_taxid }}</td>
                        <td>EXTRANJERO</td>                        
                        @endif                        
                        <td>{{ $customer->short_street }}</td>
                        <td>
                            <div class="dropdown">
                                @if($type < 6)
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>
                                @endif
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                    @if($type < 6)
                                    <li><a href="{{ route('cove.customers.edit', $customer->pk_item) }}">Editar</a></li>
                                    @endif
                                    @if($type < 5)
                                    <li><a href="#" data-method="delete" rel="nofollow" class="delete" data-url="customers/{{ $customer->pk_item }}/destroy" data-token="{{ csrf_token() }}">Eliminar</a></li>                                                          
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-warning">
        <strong><i class="icon-alert"></i> Advertencia.</strong> Usted no tiene clientes registrados
    </div>
@endif

