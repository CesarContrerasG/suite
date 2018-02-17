{!! Form::open(['route' => ['qore.catalogs.identifiers.destroy', $identifier], 'method' => 'DELETE', 'class' => 'inline']) !!}
    {!! Form::submit('Eliminar', ['class' => 'btn btn-default btn-sm btn-round btn-round-danger']) !!}
{!! Form::close() !!}
