{!! Form::open(['route' => ['sentry.configuration.store', \Hashids::encode($master->id)], 'method' => 'POST', 'files' => true]) !!}
    @include('Sentry.configurations.fields')
    <div class="col-md-12 text-right">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::hidden('master_id', $master->id) !!}
                        @if ($errors->has('master_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('master_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::submit('Guardar Configuración', ['class' => 'btn btn-default btn-sm btn-round']) !!}
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
