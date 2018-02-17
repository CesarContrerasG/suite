{!! Form::open(['route' => ['qore.contracts.destroy', Hashids::encode($contract)], 'method' => 'DELETE', 'class' => 'inline']) !!}
    {!! Form::submit('Eliminar Contrato', ['class' => 'btn btn-default btn-sm btn-round btn-round-danger']) !!}
{!! Form::close() !!}
