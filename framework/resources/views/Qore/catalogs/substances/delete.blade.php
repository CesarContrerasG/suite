{!! Form::open(['route' => ['qore.catalogs.substances.destroy', $substance], 'method' => 'DELETE', 'class' => 'inline']) !!}
    {!! Form::submit('Eliminar', ['class' => 'btn btn-default btn-sm btn-round btn-round-danger']) !!}
{!! Form::close() !!}
