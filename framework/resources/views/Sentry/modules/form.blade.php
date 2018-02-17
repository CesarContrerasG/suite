<div class="col-md-8">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', 'Nombre') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'module_name']) !!}
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group{{ $errors->has('version') ? ' has-error' : '' }}">
        {!! Form::label('version', 'Versión') !!}
        {!! Form::number('version', null, ['class' => 'form-control', 'id' => 'module_version']) !!}
        @if ($errors->has('version'))
            <span class="help-block">
                <strong>{{ $errors->first('version') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        {!! Form::label('description', 'Descripción') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'module_description']) !!}
        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-8">
    <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
        {!! Form::label('url', 'Route') !!}
        {!! Form::text('url', null, ['class' => 'form-control', 'id' => 'module_url']) !!}
        @if ($errors->has('url'))
            <span class="help-block">
                <strong>{{ $errors->first('url') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
        {!! Form::label('color', 'Color App') !!}
        {!! Form::input('color', 'color', null, ['class' => 'form-control', 'id' => 'module_color']) !!}
        @if ($errors->has('color'))
            <span class="help-block">
                <strong>{{ $errors->first('color') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-8">
    <div class="form-group{{ $errors->has('script') ? ' has-error' : '' }}">
        {!! Form::label('script', 'Script') !!}
        {!! Form::text('script', null, ['class' => 'form-control', 'id' => 'module_script']) !!}
        @if ($errors->has('script'))
            <span class="help-block">
                <strong>{{ $errors->first('script') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
        {!! Form::label('database', 'Requiere Base de Datos') !!}
        {!! Form::select('database', [0 => 'No requiere', 1 => 'Con Base de Datos'], null, ['class' => 'form-control', 'id' => 'module_database']) !!}
        @if ($errors->has('database'))
            <span class="help-block">
                <strong>{{ $errors->first('database') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
        {!! Form::label('logo', 'Logo') !!}
        {!! Form::file('logo', ['class' => 'form-control']) !!}
        @if($errors->has('logo'))
            <span class="help-block">
                <strong>{{ $errors->first('logo') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group{{ $errors->has('nivel') ? ' has-error' : '' }}">
        {!! Form::label('nivel', 'Nivel') !!}
        {!! Form::select('nivel', $nivels, null, ['class' => 'form-control']) !!}
        @if($errors->has('nivel'))
            <span class="help-block">
                <strong>{{ $errors->first('nivel') }}</strong>
            </span>
        @endif
    </div>
</div>
