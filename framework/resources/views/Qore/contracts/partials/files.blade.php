<div class="with-padding">
    {!! Form::open(['route' => ['qore.receivables.files.store', Hashids::encode($contract->id)], 'method' => 'POST', 'files' => true, 'class' => 'form row without-border']) !!}
    <div class="col-md-6">
        <div class="form-group form-green{{ $errors->has('concept') ? ' has-error' : '' }}">
            {!! Form::label('concept', 'Concepto') !!}
            {!! Form::text('concept', null, ['class' => 'form-control']) !!}
            @if ($errors->has('concept'))
                <span class="help-block">
                    <strong>{{ $errors->first('concept') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-green{{ $errors->has('emition_date') ? ' has-error' : '' }}">
            {!! Form::label('emition_date', 'Fecha de Emición') !!}
            {!! Form::text('emition_date', null, ['class' => 'form-control', 'id' => 'emition_date']) !!}
            @if ($errors->has('emition_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('emition_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group form-green{{ $errors->has('description') ? ' has-error' : '' }}">
            {!! Form::label('description', 'Descripción') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group form-green{{ $errors->has('document') ? ' has-error' : '' }}">
            {!! Form::label('document', 'Documento') !!}
            {!! Form::file('document', ['class' => 'form-control']) !!}
            @if ($errors->has('document'))
                <span class="help-block">
                    <strong>{{ $errors->first('document') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::hidden('contract_id', $contract->id) !!}
            @if ($errors->has('contract_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('contract_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12 text-right">
        <div class="form-group">
            {!! Form::submit('Guardar', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>

<div class="with-padding">
    @if(count($contract->files))
        <ul class="list-group">
            @foreach ($contract->files as $file)
                <div class="list-group-item">
                    <div class="flex-box space-between">
                        <div class="flex-box">
                            <div class="badge-circle badge-active-green">
                                <i class="icon-description"></i>
                            </div>
                            <div class="paragraph-info">
                                <h3>{{ $file->concept}}</h3>
                                <p>{{ $file->description }}</p>
                            </div>
                        </div>
                        <div class="paragraph-info">
                            <h3>Fecha de Emición</h3>
                            <p class="text-color text-blue">{{ $file->emition_date }}</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Opciones <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdown">
                                <li><a href="#">Descargar</a></li>
                                {{--<li><a href="{{ route('qore.receivables.files.download', $file) }}" disabled="disabled">Descargar</a></li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>
    @else
        <div class="alert alert-warning">
            <strong>Advertencia.</strong> Usted no tiene documentos registrados para este contrato.
        </div>
    @endif
</div>

