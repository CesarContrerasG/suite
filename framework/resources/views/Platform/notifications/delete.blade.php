{!! Form::open(['route' => ['platform.notifications.destroy', $notification], 'method' => 'DELETE', 'class' => 'inline']) !!}
    {!! Form::submit('Eliminar Notificación', ['class' => 'btn btn-sm btn-round btn-round-red']) !!}
{!! Form::close() !!}