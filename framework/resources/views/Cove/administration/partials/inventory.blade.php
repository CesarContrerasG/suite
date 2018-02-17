{!! Form::open(['route' => 'cove.inventory.store', 'method' => 'POST', 'files' => true]) !!}
    <div class="col-md-6">
        {!! Form::hidden('inv_item', $cove->pk_item) !!}
        {!! Form::hidden('inv_cove', $cove->pk_referencia) !!}
        {!! Form::hidden('pk_item', null, ['id' => 'id_inventory']) !!}
        <div class="form-group form-purple{{ $errors->has('inv_factura') ? ' has-error' : '' }}">
            {!! Form::label('inv_factura', 'Factura') !!}
            {!! Form::select('inv_factura', $list_invoice, null, ['class' => 'form-control', 'id' => 'factura']) !!}
            @if ($errors->has('inv_factura'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_factura') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-purple{{ $errors->has('inv_numparte') ? ' has-error' : '' }}">
            {!! Form::label('inv_numparte', 'No. Parte') !!}
            {!! Form::select('inv_numparte', $parts, null, ['class' => 'form-control chosen-select', 'id' => 'inv_numparte']) !!}
            @if ($errors->has('inv_numparte'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_numparte') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group form-purple{{ $errors->has('inv_descove') ? ' has-error' : '' }}">
            {!! Form::label('inv_descove', 'Descripcion') !!}
            {!! Form::text('inv_descove', null, ['class' => 'form-control', 'id' => 'inv_descove']) !!}
            @if ($errors->has('inv_descove'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_descove') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group form-purple{{ $errors->has('inv_item') ? ' has-error' : '' }}">
            {!! Form::label('inv_item', 'Cantidad') !!}
            {!! Form::text('inv_cantidad', null, ['class' => 'form-control', 'id' => 'inv_cantidad', 'onkeyUp' =>'calculateImport()']) !!}
            @if ($errors->has('inv_item'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_item') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group form-purple{{ $errors->has('inv_oma') ? ' has-error' : '' }}">
            {!! Form::label('inv_oma', 'Unidad Medida') !!}
            {!! Form::select('inv_oma', App\Qore\OMAUnit::orderby('oma_nombre')->pluck('oma_nombre','oma_clave'), null, ['class' => 'form-control chosen-select', 'id' => 'inv_oma']) !!}
            <br>
            @if ($errors->has('inv_oma'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_oma') }}</strong>
                </span>
            @endif
        </div>
    </div>
     <div class="col-md-4">
        <div class="form-group form-purple{{ $errors->has('inv_bultos') ? ' has-error' : '' }}">
            {!! Form::label('inv_bultos', 'Bultos') !!}
            {!! Form::text('inv_bultos', null, ['class' => 'form-control', 'id' => 'inv_bultos']) !!}
            <br>
            @if ($errors->has('inv_bultos'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_bultos') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-purple{{ $errors->has('inv_valorunitario') ? ' has-error' : '' }}">
            {!! Form::label('inv_valorunitario', 'Precio Unitario') !!}
            {!! Form::text('inv_valorunitario', null, ['class' => 'form-control', 'id' => 'inv_valorunitario', 'onkeyUp' =>'calculateImport()']) !!}
            @if ($errors->has('inv_valorunitario'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_valorunitario') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-purple{{ $errors->has('inv_valortotal') ? ' has-error' : '' }}">
            {!! Form::label('inv_valortotal', 'Importe M.E.') !!}
            {!! Form::text('inv_valortotal', null, ['class' => 'form-control', 'id' => 'inv_valortotal']) !!}
            @if ($errors->has('inv_valortotal'))
                <span class="help-block">
                    <strong>{{ $errors->first('inv_valortotal') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12 text-right">
        <div class="form-group">
            <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success" >Guardar</button>
        </div>
    </div>
{!! Form::close() !!}

    <table class="table table-striped table-condensed" id="table-inv">
        <thead>
            <tr>
                <th>#</th>
                <th style="display:none"></th>
                <th>Factura</th>
                <th>No. Parte</th>
                <th>Descripcion</th>
                <th>U.M.</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Importe Fac</th>
                <th>Importe USD</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(!is_null($inventory))
            @foreach($inventory as $inv)
                <tr>
                    <td class="index">{{ $inv->inv_sec }}</td>
                    <td style="display:none">{{ $inv->pk_item }}</td>
                    <td>{{ $inv->inv_factura }}</td>
                    <td>{{ $inv->inv_numparte }}</td>
                    <td>{{ $inv->inv_descove }}</td>
                    <td>{{ $inv->inv_oma}}</td>
                    <td>{{ $inv->inv_cantidad}}</td>
                    <td>{{ $inv->inv_valorunitario}}</td>
                    <td>{{ $inv->inv_valortotal}}</td>
                    <td>{{ $inv->inv_valorusd}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Opciones <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                <li><a href="#" onclick="showDetailInventory({{$inv->pk_item}})">Editar</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#detail_{{ $inv->pk_item }}">Detalle</a></li>
                                <li><a href="#" data-method="delete" rel="nofollow" class="delete" data-url="../inventory/{{ $inv->pk_item }}/destroy" data-token="{{ csrf_token() }}">Eliminar</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="detail_{{ $inv->pk_item }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    @include('Cove.administration.detail', ['item' => $inv->pk_item])
                </div>
            @endforeach
            @endif
        </tbody>
    </table>

    <div class="col-md-4 col-md-offset-8">
        <p class="bg-success text-success text-center with-sm-vertical-padding">
            <strong>Suma da las facturas en M.E <em>${{ $total }}</em></strong>
        </p>
    </div>
