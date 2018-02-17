<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', 'Nombre') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('last_name') ? ' has-error' : '' }}">
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
    <div class="form-group form-green{{ $errors->has('email') ? ' has-error' : '' }}">
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('password') ? ' has-error' : '' }}">
        {!! Form::label('password', 'Contraseña') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group form-green{{ $errors->has('photo') ? ' has-error' : '' }}">
        {!! Form::label('photo', 'Foto de Perfil') !!}
        {!! Form::file('photo', ['class' => 'form-control']) !!}
        @if ($errors->has('photo'))
            <span class="help-block">
                <strong>{{ $errors->first('photo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group form-green{{ $errors->has('master_id') ? ' has-error' : '' }}">
        {!! Form::hidden('master_id', auth()->user()->current_master->id) !!}
        @if ($errors->has('master_id'))
            <span class="help-block">
                <strong>{{ $errors->firts('master_id') }}</strong>
            </span>
        @endif
    </div>
</div>
{!! Form::hidden('company_id', auth()->user()->company_id) !!}
{!! Form::hidden('departament_id', 0) !!}