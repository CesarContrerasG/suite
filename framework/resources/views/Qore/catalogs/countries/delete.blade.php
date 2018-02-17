{!! Form::open(['route' => ['qore.catalogs.countries.destroy', $country], 'method' => 'DELETE', 'class' => 'inline']) !!}
    {!! Form::submit('Eliminar', ['class' => 'btn btn-default btn-sm btn-round btn-round-danger']) !!}
{!! Form::close() !!}
