<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('pk_referencia') ? ' has-error' : '' }}">
        {!! Form::label('pk_referencia', 'Referencia COVE') !!}
        {!! Form::text('pk_referencia', $cove, ['class' => 'form-control']) !!}
        @if ($errors->has('pk_referencia'))
            <span class="help-block">
                <strong>{{ $errors->first('pk_referencia') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('imgRfc') ? ' has-error' : '' }}">
        {!! Form::label('imgRfc', 'RFC de Consulta') !!}
        {!! Form::select('imgRfc', \App\Cove\Consultation::orderby('nombre_consulta')->pluck('nombre_consulta','rfc_consulta'), null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('imgRfc'))
            <span class="help-block">
                <strong>{{ $errors->first('imgRfc') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group form-purple{{ $errors->has('imgtipodoc') ? ' has-error' : '' }}">
        {!! Form::label('imgtipodoc', 'Tipo Documento') !!}
        {!! Form::select('imgtipodoc', \App\Qore\Document::pluck('doc_nombre', 'doc_clave'), null, ['class' => 'form-control chosen-select']) !!}
        @if ($errors->has('imgtipodoc'))
            <span class="help-block">
                <strong>{{ $errors->first('imgtipodoc') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="col-md-6">
    <div class="form-group form-purple{{ $errors->has('imgNameFile') ? ' has-error' : '' }}">
        {!! Form::label('imgNameFile', 'Documento') !!}
        {!! Form::file('imgNameFile', ['class' => 'form-control']) !!}
        @if ($errors->has('imgNameFile'))
            <span class="help-block">
                <strong>{{ $errors->first('imgNameFile') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="col-md-12 text-right">
    <div class="form-group">
        <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar</button>
        <a href="{{ route('cove.administration.index') }}"><button type="button" class="btn btn-default btn-sm btn-round btn-round-danger">Cancelar</button></a>
    </div>
</div>

<div class="col-md-12">
{{--<a href="#" onclick="signAll(2)" class="btn btn-default btn-sm btn-round btn-round-success">firmar</a>--}}
<table class="table table-striped table-condensed" >
    <thead>
        <tr>
            {{--<th><input type="checkbox" id="checkTodos">Todos</th>--}}
            <th>Documento</th>
            <th>E-document</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($digital as $id => $dig)
        <tr>
           {{-- @if($dig->imgtipodoc)
            <td> <input type="checkbox" name="chk[{{$id}}]" value="{{$dig->iImageID}}" > </td>
            @else
            <td></td>
            @endif--}}
            <td>{{ $dig->strImageName }}</td>
            <td>{{ $dig->imgEdocument }}</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Opciones <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                        <li><a href="{{ route('cove.digital.view', $dig->iImageID) }}" target="_blank">Visualizar</a></li>
                        @if($dig->imgEdocument == '' && $dig->imgtipodoc != '000')
                        <li><a href="{{ route('cove.digital.sign', [$dig->iImageID, 0]) }}">Firmar</a></li>
                        @endif
                        <li><li><a href="#" data-method="delete" rel="nofollow" class="delete" data-url="../digital/{{ $dig->iImageID }}/destroy" data-token="{{ csrf_token() }}">Eliminar</a></li>                                                          </li>
                    </ul>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
