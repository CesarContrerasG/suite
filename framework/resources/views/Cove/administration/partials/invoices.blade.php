{!! Form::open(['route' => 'cove.invoices.store', 'method' => 'POST', 'files' => true]) !!}
    <div class="col-md-6">
        {!! Form::hidden('pk_item', $cove->pk_item, ['class' => 'form-control']) !!}
        {!! Form::hidden('inv_item', null, ['id' => 'id_invoice']) !!}
        <div class="form-group form-purple{{ $errors->has('inv_factura') ? ' has-error' : '' }}">
            {!! Form::label('inv_factura', 'Factura') !!}
            {!! Form::text('inv_factura', null, ['class' => 'form-control', 'id' => 'inv_factura']) !!}
            @if ($errors->has('inv_factura'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_factura') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-purple{{ $errors->has('inv_fecha') ? ' has-error' : '' }}">
            {!! Form::label('inv_fecha', 'Fecha') !!}
            {!! Form::text('inv_fecha', null, ['class' => 'form-control date', 'id' => 'inv_fecha']) !!}
            @if ($errors->has('inv_fecha'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_fecha') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group form-purple{{ $errors->has('inv_moneda') ? ' has-error' : '' }}">
            {!! Form::label('inv_moneda', 'Moneda') !!}
            {!! Form::select('inv_moneda', \App\Qore\OMACurrency::join('mdb_paises', 'oma_pais', '=', 'mdb_paises.id')->selectRaw('CONCAT(oma_clave,"-",pai_clavem3) as clave, CONCAT(oma_clave,"-",pai_nombre) as nombre')->orderby('nombre')->pluck('nombre','clave'), null, ['class' => 'form-control chosen-select', 'id' => 'inv_moneda']) !!}
            @if ($errors->has('inv_moneda'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_moneda') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group form-purple{{ $errors->has('inv_subdivision') ? ' has-error' : '' }}">
            {!! Form::label('inv_subdivision', 'Subdivision') !!}
            <div>
                {!! Form::checkbox('inv_subdivision', null, null, ['class' => 'form-control sw', 'id' => 'inv_subdivision']) !!}
                <label for="inv_subdivision"></label>
            </div>
            @if ($errors->has('inv_subdivision'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_subdivision') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group form-purple{{ $errors->has('inv_certorigen') ? ' has-error' : '' }}">
            {!! Form::label('inv_certorigen', 'Cer. Origen') !!}
            <div>
                {!! Form::checkbox('inv_certorigen', null, null, ['class' => 'form-control sw', 'id' => 'inv_certorigen']) !!}
                <label for="inv_certorigen"></label>
            </div>
            @if ($errors->has('inv_certorigen'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_certorigen') }}</strong>
                </span>
            @endif
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group form-purple{{ $errors->has('inv_factorme') ? ' has-error' : '' }}">
            {!! Form::label('inv_factorme', 'Factor M.E.') !!}
            {!! Form::text('inv_factorme', null, ['class' => 'form-control', 'id' => 'inv_factorme']) !!}
            @if ($errors->has('inv_factorme'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_factorme') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group form-purple{{ $errors->has('inv_tipocambio') ? ' has-error' : '' }}">
            {!! Form::label('inv_tipocambio', 'Tipo Cambio') !!}
            {!! Form::text('inv_tipocambio', null, ['class' => 'form-control', 'id' => 'inv_tipocambio']) !!}
            @if ($errors->has('inv_tipocambio'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_tipocambio') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <br>
    <div class="col-md-8">
        <div class="form-group form-purple{{ $errors->has('emisor_clave') ? ' has-error' : '' }}">
            {!! Form::label('emisor_clave', 'Emisor') !!}
            @if($cove->pk_tipo == 2)
            {!! Form::select('emisor_clave', $company, null, ['class' => 'form-control chosen-select', 'id' => 'emisor_id', 'data-type' => $cove->pk_tipo]) !!}
            @else
            {!! Form::select('emisor_clave',  $provider, null, ['class' => 'form-control chosen-select', 'id' => 'emisor_id', 'data-type' => $cove->pk_tipo]) !!}
            @endif
            @if ($errors->has('emisor_clave'))
                <span class="help-block">
                    <strong>{{ $errors->first('emisor_clave') }}</strong>
                </span>
            @endif
            <a href="#" onclick="show('transmitter_div')" class="btn btn-default btn-round btn-xs">mostrar detalle</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group form-purple{{ $errors->has('emisor_tipoid') ? ' has-error' : '' }}">
            {!! Form::label('emisor_tipoid', 'Tipo Identificador') !!}
            {!! Form::select('emisor_tipoid', [0 => 'TAX ID', 1 => 'RFC', 2 => 'CURP', 3 => 'SIN TAX ID'], null, ['class' => 'form-control']) !!}
            @if ($errors->has('emisor_tipoid'))
                <span class="help-block">
                    <strong>{{ $errors->first('emisor_tipoid') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12" id="transmitter_div" style="display:none">
        DETALLE EMISOR <a href="#" onclick="show('transmitter_div')" class="btn btn-default btn-round btn-round-danger btn-xs">cerrar detalle</a>
        {!! Form::hidden('emisor_nombre', $transmitter != '' ? $transmitter->business_name : null, ['id' => 'emisor_nombre']) !!}
        <div class="col-md-12">
            <div class="form-group form-purple{{ $errors->has('emisor_identificador') ? ' has-error' : '' }}">
                {!! Form::label('emisor_identificador', 'Identificador') !!}            
                {!! Form::text('emisor_identificador', $transmitter != '' ? $transmitter->rfc : null, ['class' => 'form-control', 'id' => 'emisor_rfc']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('emisor_paterno') ? ' has-error' : '' }}">
                {!! Form::label('emisor_paterno', 'Apellido Paterno') !!}
                {!! Form::text('emisor_paterno', null, ['class' => 'form-control', 'id' => 'emisor_paterno']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('emisor_materno') ? ' has-error' : '' }}">
                {!! Form::label('emisor_materno', 'Apellido Materno') !!}
                {!! Form::text('emisor_materno', null, ['class' => 'form-control', 'id' => 'emisor_materno']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-purple{{ $errors->has('emisor_calle') ? ' has-error' : '' }}">
                {!! Form::label('emisor_calle', 'Calle') !!}            
                {!! Form::text('emisor_calle', $transmitter != '' ? $transmitter->address : null, ['class' => 'form-control','id' => 'emisor_calle']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('emisor_col') ? ' has-error' : '' }}">
                {!! Form::label('emisor_col', 'Colonia') !!}         
                {!! Form::text('emisor_col', $transmitter != '' ? $transmitter->colony : null, ['class' => 'form-control', 'id' => 'emisor_col']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group form-purple{{ $errors->has('emisor_noext') ? ' has-error' : '' }}">
                {!! Form::label('emisor_noext', 'No. Exterior') !!}         
                {!! Form::text('emisor_noext', $transmitter != '' ? $transmitter->outdoor : null, ['class' => 'form-control', 'id' => 'emisor_noext']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group form-purple{{ $errors->has('emisor_noint') ? ' has-error' : '' }}">
                {!! Form::label('emisor_noint', 'No. Interior') !!}   
                {!! Form::text('emisor_noint', $transmitter != '' ? $transmitter->interior : null, ['class' => 'form-control', 'id' => 'emisor_noint']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('emisor_localidad') ? ' has-error' : '' }}">
                {!! Form::label('emisor_localidad', 'Localidad') !!} 
                {!! Form::text('emisor_localidad', $transmitter != '' ? $transmitter->location : null, ['class' => 'form-control', 'id' => 'emisor_localidad']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('emisor_mpo') ? ' has-error' : '' }}">
                {!! Form::label('emisor_mpo', 'Municipio') !!} 
                {!! Form::text('emisor_mpo', $transmitter != '' ? $transmitter->town : null, ['class' => 'form-control', 'id' => 'emisor_mpo']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('emisor_edo') ? ' has-error' : '' }}">
                {!! Form::label('emisor_edo', 'Estado') !!} 
                {!! Form::text('emisor_edo', $transmitter != '' ? $transmitter->state : null, ['class' => 'form-control', 'id' => 'emisor_edo']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('emisor_pais') ? ' has-error' : '' }}">
                {!! Form::label('emisor_pais', 'Pais') !!} 
                {!! Form::select('emisor_pais', \App\Qore\Country::orderby('pai_nombre')->pluck('pai_nombre','pai_clavem3'), $transmitter != '' ? $transmitter->country : null, ['class' => 'form-control', 'id' => 'emisor_pais']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('emisor_cp') ? ' has-error' : '' }}">
                {!! Form::label('emisor_cp', 'C.P.') !!} 
                {!! Form::text('emisor_cp', $transmitter != '' ? $transmitter->cpostal : null, ['class' => 'form-control', 'id' => 'emisor_cp']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group form-purple{{ $errors->has('dest_clave') ? ' has-error' : '' }}">
            {!! Form::label('dest_clave', 'Destinatario') !!}
            @if($cove->pk_tipo == 1)
            {!! Form::select('dest_clave', $company, null, ['class' => 'form-control chosen-select', 'id' => 'dest_id', 'data-type' => $cove->pk_tipo]) !!}
            @else
            {!! Form::select('dest_clave', $customer, null, ['class' => 'form-control chosen-select', 'id' => 'dest_id', 'data-type' => $cove->pk_tipo]) !!}
            @endif
            @if ($errors->has('dest_clave'))
                <span class="help-block">
                    <strong>{{ $errors->first('dest_clave') }}</strong>
                </span>
            @endif
            <a href="#" onclick="show('receiver_div')" class="btn btn-default btn-round btn-xs">mostrar detalle</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group form-purple{{ $errors->has('dest_tipoid') ? ' has-error' : '' }}">
            {!! Form::label('dest_tipoid', 'Tipo Identificador') !!}
            {!! Form::select('dest_tipoid', [0 => 'TAX ID', 1 => 'RFC', 2 => 'CURP', 3 => 'SIN TAX ID'], null, ['class' => 'form-control']) !!}
            @if ($errors->has('dest_tipoid'))
                <span class="help-block">
                    <strong>{{ $errors->first('dest_tipoid') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12" id="receiver_div" style="display:none">
        DETALLE DESTINATARIO <a href="#" onclick="show('receiver_div')" class="btn btn-default btn-round btn-round-danger btn-xs">cerrar detalle</a>
        {!! Form::hidden('dest_nombre', $receiver != '' ? $receiver->business_name : null, ['id' => 'dest_nombre']) !!}
        <div class="col-md-12">
            <div class="form-group form-purple{{ $errors->has('dest_identificador') ? ' has-error' : '' }}">
                {!! Form::label('dest_identificador', 'Identificador') !!}            
                {!! Form::text('dest_identificador', $receiver != '' ? $receiver->rfc : null, ['class' => 'form-control', 'id' => 'dest_rfc']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('dest_paterno') ? ' has-error' : '' }}">
                {!! Form::label('dest_paterno', 'Apellido Paterno') !!}
                {!! Form::text('dest_paterno', null, ['class' => 'form-control', 'id' => 'dest_paterno']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('dest_materno') ? ' has-error' : '' }}">
                {!! Form::label('dest_materno', 'Apellido Materno') !!}
                {!! Form::text('dest_materno', null, ['class' => 'form-control', 'id' => 'dest_materno']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-purple{{ $errors->has('dest_calle') ? ' has-error' : '' }}">
                {!! Form::label('dest_calle', 'Calle') !!}            
                {!! Form::text('dest_calle', $receiver != '' ? $receiver->address : null, ['class' => 'form-control', 'id' => 'dest_calle']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('dest_col') ? ' has-error' : '' }}">
                {!! Form::label('dest_col', 'Colonia') !!}         
                {!! Form::text('dest_col', $receiver != '' ? $receiver->colony : null, ['class' => 'form-control', 'id' => 'dest_col']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group form-purple{{ $errors->has('dest_noext') ? ' has-error' : '' }}">
                {!! Form::label('dest_noext', 'No. Exterior') !!}         
                {!! Form::text('dest_noext', $receiver != '' ? $receiver->outdoor : null, ['class' => 'form-control', 'id' => 'dest_noext']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group form-purple{{ $errors->has('dest_noint') ? ' has-error' : '' }}">
                {!! Form::label('dest_noint', 'No. Interior') !!}   
                {!! Form::text('dest_noint', $receiver != '' ? $receiver->interior : null, ['class' => 'form-control', 'id' => 'dest_noint']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('dest_localidad') ? ' has-error' : '' }}">
                {!! Form::label('dest_localidad', 'Localidad') !!} 
                {!! Form::text('dest_localidad', $receiver != '' ? $receiver->location : null, ['class' => 'form-control', 'id' => 'dest_localidad']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('dest_mpo') ? ' has-error' : '' }}">
                {!! Form::label('dest_mpo', 'Municipio') !!} 
                {!! Form::text('dest_mpo', $receiver != '' ? $receiver->town : null, ['class' => 'form-control', 'id' => 'dest_mpo']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('dest_edo') ? ' has-error' : '' }}">
                {!! Form::label('dest_edo', 'Estado') !!} 
                {!! Form::text('dest_edo', $receiver != '' ? $receiver->state : null, ['class' => 'form-control', 'id' => 'dest_edo']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('dest_pais') ? ' has-error' : '' }}">
                {!! Form::label('dest_pais', 'Pais') !!} 
                {!! Form::select('dest_pais', \App\Qore\Country::orderby('pai_nombre')->pluck('pai_nombre','pai_clavem3'), $receiver != '' ? $receiver->country : null, ['class' => 'form-control', 'id' => 'dest_pais']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('dest_cp') ? ' has-error' : '' }}">
                {!! Form::label('dest_cp', 'C.P.') !!} 
                {!! Form::text('dest_cp', $receiver != '' ? $receiver->cpostal : null, ['class' => 'form-control', 'id' => 'dest_cp']) !!}
            </div>
        </div>
    </div> 
    
    <div class="col-md-12 text-right">
        <div class="form-group">
            <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success" id="save_invoice" {{ !is_null($invoices) || $cove->cove_relacion == 1 ? '' : 'disabled'}}>Guardar</button>
        </div>
    </div>    
{!! Form::close() !!}
<div class="col-md-12">
    <table class="table table-striped table-condensed table" >
        <thead>
            <tr>
                <th>Factura</th>
                <th>Fecha</th>
                <th>Emisor</th>
                <th>Destinatario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(!is_null($invoices))
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->inv_factura }}</td>
                    <td>{{ $invoice->inv_fecha }}</td>
                    <td>{{ $invoice->emisor_nombre }}</td>
                    <td>{{ $invoice->dest_nombre}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Opciones <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                <li><a href="#" onclick="showDetail({{$invoice->inv_item}})">Editar</a></li>
                                @if($cove->pk_tipo == 1)
                                <li><a href="{{ route('cove.invoices.print', [$cove->pk_item, 1]) }}" target="_blank">Imprimir MX</a></li>
                                <li><a href="{{ route('cove.invoices.print', [$cove->pk_item, 2]) }}" target="_blank">Imprimir US</a></li>
                                @endif
                                <li><a href="#" data-method="delete" rel="nofollow" class="delete" data-url="../../invoices/{{ $invoice->inv_item }}/destroy" data-token="{{ csrf_token() }}">Eliminar</a></li>                                                          
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
