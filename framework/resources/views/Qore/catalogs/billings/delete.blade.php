{!! Form::open(['route' => ['qore.catalogs.billings.destroy', $billing], 'method' => 'DELETE', 'class' => 'inline']) !!}
    {!! Form::submit('Eliminar', ['class' => 'btn btn-default btn-sm btn-round btn-round-danger']) !!}
{!! Form::close() !!}
