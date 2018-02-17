        <div class="col-md-6">
            <div class="form-group form-red{{ $errors->has('sello_rfc') ? ' has-error' : '' }}">
                {!! Form::label('sello_rfc','RFC sello') !!}
                {!! Form::text('sello_rfc', null, ['required', 'class' => 'form-control']) !!}
                @if($errors->has('sello_rfc'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sello_rfc') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        @if(!is_null($seal))
        <div class="col-md-6">
            <div class="form-group form-red{{ $errors->has('sello_vigencia') ? ' has-error' : '' }}">
                {!! Form::label('sello_vigencia','Fecha de Vigencia') !!}
                {!! Form::text('sello_vigencia', null, ['class' => 'form-control']) !!}
                @if($errors->has('sello_vigencia'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sello_vigencia') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        @endif
        <div class="col-md-6">
            <div class="form-group form-red">
            {!! Form::label('key','Archivo .KEY') !!}            
                @if(is_null($seal))
                    {!! Form::file('sello_key', ['required', 'class' => 'form-control']) !!}
                @else            
                    <div class="form-field-fake">
                        {{ $seal->sello_key }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-red">
                {!! Form::label('cer','Archivo .CER') !!}            
                @if(is_null($seal))
                    {!! Form::file('sello_cer', ['required', 'class' => 'form-control']) !!}
                @else
                    <div class="form-field-fake">
                        {{ $seal->sello_cer }}
                    </div>
                @endif
            </div>
        </div>       
        <div class="col-md-6">
            <div class="form-group form-red{{ $errors->has('sello_password') ? ' has-error' : '' }}">
                {!! Form::label('sello_password','Clave de seguridad') !!}
                {!! Form::password('sello_password', ['placeholder' => '*************','required', 'class' => 'form-control']) !!}
                @if($errors->has('sello_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sello_password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-red{{ $errors->has('sello_wsp') ? ' has-error' : '' }}">
                {!! Form::label('sello_wsp','Password Web Service') !!}
                {!! Form::text('sello_wsp', null, ['required', 'class' => 'form-control']) !!}
                @if($errors->has('sello_wsp'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sello_wsp') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-red">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group text-right">
                {!! Form::button('Guardar', ['type' => 'submit', 'class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                @if(!is_null($seal))
                    @if($type < 5)
                    <a href="#" data-method="delete" rel="nofollow" data-url="seals/{{ $seal->pk_item }}/destroy" data-token="{{ csrf_token() }}" class="delete"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Eliminar</button></a>
                    @endif
                @endif
            </div>
        </div>
