
    {!! Form::open(['route' => ['anexo31.datastage.store'], 'method' => 'POST', 'files' => true]) !!}
        <p class="text-md">Archivos DataStage</p>
        {!! Form::file('file[]',['multiple' => true]) !!}
        <p class="text-xs">Reemplazar{!! Form::checkbox('reemplazar',1, false)!!}</p>
        {!! Form::submit('subir', ['class' => 'btn btn-default success btn-xs']) !!}
    {!! Form::close() !!}

    <p class="text-md"><strong>FOLIOS CARGADOS:</strong></p>
    <table class="table table-striped table-condensed">
        <thead>
            <tr>
                <th>FECHA</th>
                <th>FOLIO</th>
            </tr>
        </thead>
        <tbody>                
            @foreach($datastage as $ds)        
                <tr>
                    <td>{{ $ds->mes }} - {{ $ds->anio }}</td>
                    <td>{{ $ds->folio_ds }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
