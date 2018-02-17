{!! Form::open(['route' => ['sentry.modules.destroy', ':MODULE_ID'], 'method' => 'DELETE', 'id' => 'form_delete_module', 'class' => 'inline']) !!}
    {!! Form::submit('Eliminar Módulo', ['class' => 'btn btn-default btn-sm btn-round']) !!}
{!! Form::close() !!}
