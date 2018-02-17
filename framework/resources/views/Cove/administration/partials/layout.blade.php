{!! Form::open(['route' => 'cove.inventory.upload', 'method' => 'POST', 'files' => true]) !!}
    <div class="col-md-6">
        {!! Form::hidden('pk_cove', $cove->pk_item) !!}
        <div class="form-group form-purple{{ $errors->has('file') ? ' has-error' : '' }}">
            {!! Form::label('file', 'Cargar XML de Factura o layout de mercancias') !!}
            {!! Form::file('file',  ['class' => 'form-control']) !!}
            @if ($errors->has('file'))
                <span class="help-block">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
            @endif
            <label>Sobreescribir</label>
            {!! Form::checkbox('overwrite',  null, ['class' => 'form-control']) !!}

        </div>
    </div>
    <div class="col-md-12 text-right">
        <div class="form-group">
            <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success" >Subir</button>
        </div>
    </div>
{!! Form::close() !!}