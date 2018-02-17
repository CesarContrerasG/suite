{!! Form::open(['route' => ['qore.catalogs.containers.destroy', $container], 'method' => 'DELETE', 'class' => 'inline']) !!}
    {!! Form::submit('Eliminar', ['class' => 'btn btn-default btn-sm btn-round btn-round-danger']) !!}
{!! Form::close() !!}
