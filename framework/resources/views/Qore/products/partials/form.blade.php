    <div class="row">
        <div class="col-md-12">
            <div class="form-group form-green{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Nombre</label>
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-green{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description">Descripción</label>
                {!! Form::textarea('description', null, ['rows' => '6', 'class' => 'form-control']) !!}
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-green">
                <label for="logo">Logotipo</label>
                {!! Form::file('logo', ['class' => 'form-control']) !!}
            </div>
            @include('Qore.partials.errors',['id'=>'logo'])
        </div>
        <div class="col-md-4">
            <div class="form-group form-green">
                <label for="version">Versión (opcional)</label>
                {!! Form::text('version', null, ['class' => 'form-control']) !!}
            </div>
            @include('Qore.partials.errors',['id'=>'version'])
        </div>
        <div class="col-md-4">
            <div class="form-group form-green">
                <label for="price">Precio</label>
                {!! Form::number('price', null, ['class' => 'form-control']) !!}
            </div>
            @include('Qore.partials.errors',['id'=>'version'])
        </div>
        <div class="col-md-4">
            <div class="form-group form-green">
                <label for="type">Tipo</label>
                {!! Form::select('type', ['product' => 'Producto', 'service' => 'Service'], null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-green{{ $errors->has('date') ? ' has-error' : '' }}">
                <label for="publish">Fecha de Publicación</label>
                {!! Form::text('date', null, ['class' => 'form-control','id' => 'date_start']) !!}
                @if ($errors->has('date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-green{{ $errors->has('date_close') ? ' has-error' : '' }}">
                <label for="date_close">Fecha de Expiración</label>
                {!! Form::text('date_close', null, ['class' => 'form-control','id' => 'date_end']) !!}
                @if ($errors->has('date_close'))
                    <span class="help-block">
                        <strong>{{ $errors->first('date_close') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::hidden('master_id', Auth::user()->current_master->id) !!}
            </div>
        </div>
        <div class="col-md-12 text-right">
            <div class="form-group">
                <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar</button>
                <a href="{{ route('qore.products.index') }}"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Cancelar</button></a>
            </div>
        </div>
    </div>
