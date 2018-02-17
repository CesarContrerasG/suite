{!! Form::open(['route' => ['sentry.masters.destroy', \Hashids::encode($master->id)], 'methos' => 'DELETE', 'class' => 'inline']) !!}
    {!! Form::submit ('Eliminar Cuenta Maestra', ['class' => 'btn btn-default btn-sm btn-round']) !!}
{!! Form::close() !!}
