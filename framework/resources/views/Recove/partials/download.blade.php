<div class="col-md-12">
        <div class="form-group form-red{{ $errors->has('type') ? ' has-error' : '' }}">
            {!! Form::label('type1', 'Sitio FTP')!!}
            {!! Form::radio('type', '1') !!}
            {{--  Form::label('type2', 'Carpeta Local')
            Form::radio('type', '2') --}}
            @if($errors->has('type'))
            <span class="help-block">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group form-red{{ $errors->has('path') ? ' has-error' : '' }}">
            {!! Form::label('path', 'Directorio Sitio FTP')!!}
            {!! Form::text('path', null, ['class' => 'form-control']) !!}
            @if($errors->has('path'))
            <span class="help-block">
                <strong>{{ $errors->first('path') }}</strong>
            </span>
            @endif
        </div>
    </div>    
    <div class="col-md-12">
        <label>* Datos requeridos para conexion FTP</label><br>
        <div class="col-md-6">
            <div class="form-group form-red{{ $errors->has('user') ? ' has-error' : '' }}">
                {!! Form::label('user','Usuario')!!}
                {!! Form::text('user', null, ['class' => 'form-control']) !!}
                @if($errors->has('user'))
                    <span class="help-block">
                        <strong>{{ $errors->first('user') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-red{{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::label('password','Contraseña')!!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
                @if($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div> 
    </div>  
    
    <div class="col-md-12">
        <div class="form-group text-right">
            {!! Form::button('Guardar',['type' => 'submit', 'class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
        </div>
    </div>