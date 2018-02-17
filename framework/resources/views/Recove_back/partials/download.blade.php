<div class="row">

    <div class="col-md-10">
        <div class="form-group form-red{{ $errors->has('ftp') ? ' has-error' : '' }}">
            <label for="ftp">Directorio Sitio FTP</label>
            {!! Form::text('ftp', null, ['class' => 'form-control']) !!}
            @if ($errors->has('ftp'))
                <span class="help-block">
                    <strong>{{ $errors->first('ftp') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-10">
        <div class="form-group form-red{{ $errors->has('user') ? ' has-error' : '' }}">
            <label for="user">Usuario</label>
            {!! Form::text('user', null, ['class' => 'form-control']) !!}
            @if ($errors->has('user'))
                <span class="help-block">
                    <strong>{{ $errors->first('user') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-10">
        <div class="form-group form-red{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Contraseña</label>
            {!! Form::password('password', ['class' => 'form-control']) !!}
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    <div class="col-md-12 text-right">
        <div class="form-group">
            <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar</button>
        </div>
    </div>