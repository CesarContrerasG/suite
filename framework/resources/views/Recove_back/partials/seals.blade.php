<div class="row">

    <div class="col-md-10">
        <div class="form-group form-red{{ $errors->has('sello_rfc') ? ' has-error' : '' }}">
            <label for="sello_rfc">RFC Sello</label>
            {!! Form::text('sello_rfc', null, ['class' => 'form-control']) !!}
            @if ($errors->has('sello_rfc'))
                <span class="help-block">
                    <strong>{{ $errors->first('sello_rfc') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-10">
        <div class="form-group form-red{{ $errors->has('sello_key') ? ' has-error' : '' }}">
            <label for="sello_key">Archivo .KEY</label>
            @if(is_null($seal))
                {!! Form::file('sello_key', null, ['class' => 'form-control']) !!}
            @else            
                <p>{{ $seal->sello_key }}</p>
            @endif
            @if ($errors->has('sello_key'))
                <span class="help-block">
                    <strong>{{ $errors->first('sello_key') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-10">
        <div class="form-group form-red{{ $errors->has('sello_cer') ? ' has-error' : '' }}">
            <label for="sello_cer">Archivo .CER</label>
            @if(is_null($seal))
                {!! Form::file('sello_cer', null, ['class' => 'form-control']) !!}
            @else            
                <p>{{ $seal->sello_cer }}</p>
            @endif
            @if ($errors->has('sello_cer'))
                <span class="help-block">
                <strong>{{ $errors->first('sello_cer') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-10">
        <div class="form-group form-red{{ $errors->has('sello_password') ? ' has-error' : '' }}">
            <label for="sello_password">Contraseña</label>                
            {!! Form::password('sello_password', ['class' => 'form-control', 'placeholder' => '*************']) !!}
            @if ($errors->has('sello_password'))
                <span class="help-block">
                    <strong>{{ $errors->first('sello_password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-10">
        @if(!is_null($seal))
        <div class="form-group form-red{{ $errors->has('sello_vigencia') ? ' has-error' : '' }}">
            <label for="sello_vigencia">Fecha Vigencia</label>                
             {!! Form::text('sello_vigencia', null, ['class' => 'form-control']) !!}
             @if ($errors->has('sello_vigencia'))
                <span class="help-block">
                    <strong>{{ $errors->first('sello_vigencia') }}</strong>
                </span>
            @endif
        </div>        
        @endif
    </div>

    <div class="col-md-10">
        <div class="form-group form-red{{ $errors->has('sello_wsp') ? ' has-error' : '' }}">
            <label for="sello_wsp">Contraseña Web Service</label>                
            {!! Form::text('sello_wsp', null, ['class' => 'form-control']) !!}
            @if ($errors->has('sello_wsp'))
                <span class="help-block">
                    <strong>{{ $errors->first('sello_wsp') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-md-12 text-right">
        <div class="form-group">
            <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar</button>
            @if(!is_null($seal))
                <a href="#" data-method="delete" rel="nofollow" data-url="seals/{{ $seal->pk_item }}/destroy" data-token="{{ csrf_token() }}" class="delete"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Eliminar</button></a>
            @endif
        </div>
    </div>
</div>
