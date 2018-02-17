{!! Form::open(['route' => ['sentry.modules.update', ':MODULE_ID'], 'method' => 'PUT', 'id' => 'form_edit_module', 'files' => true]) !!}
@include('Sentry.modules.form')
<div class="col-md-12">
    <div class="form-group text-right">
{!! Form::submit('Guardar Cambios', ['class' => 'btn btn-default btn-sm btn-round']) !!}
{!! Form::close() !!}
@include('Sentry.modules.delete')
