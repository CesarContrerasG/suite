{!! Form::open(['route' => ['qore.catalogs.contributions.destroy', $contribution], 'method' => 'DELETE', 'class' => 'inline']) !!}
    {!! Form::submit('eliminar', ['class' => 'btn btn-default btn-sm btn-round btn-round-danger']) !!}
{!! Form::close() !!}
