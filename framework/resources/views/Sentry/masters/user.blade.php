{!! Form::open(['route' => ['sentry.masters.users.store', \Hashids::encode($master->id)], 'method' => 'POST', 'files' => true, 'class' => 'form form_setup none-padding']) !!}
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('name', 'Nombre del Usuario') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('last_name', 'Apellidos') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('last_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('password', 'Contraseña') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('avatar', 'Foto de Perfil') !!}
            {!! Form::file('avatar', ['class' => 'form-control']) !!}
            @if ($errors->has('avatar'))
                <span class="help-block">
                    <strong>{{ $errors->first('avatar') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            @if(count($master->company->departaments) == 1)
                {!! Form::hidden('departament_id', $departament->id) !!}
            @elseif (count($master->company->departaments) > 1)
                {!! Form::label('departament_id', 'Departamento') !!}
                {!! Form::select('departament_id', $master->company->departaments->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
            @endif
            @if ($errors->has('departament_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('departament_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    {!! Form::hidden('master_id', $master->id) !!}
    {!! Form::hidden('company_id', $master->company->id) !!}
    <div class="col-md-12 text-right">
        <div class="form-group with-padding-vertical">
            {!! Form::submit('Guardar Usuario', ['class' => 'btn btn-default btn-sm btn-round']) !!}
        </div>
    </div>
{!! Form::close() !!}
