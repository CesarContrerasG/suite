{!! Form::open(['route' => ['anexo31.inventory.store'], 'method' => 'POST', 'files' => true]) !!}                       
    <div class="col-md-6">
        <div class="form_group">
            <label for="folio">Folio</label>
            {!! Form::text('folio_original', null, ['id' => 'folio', 'class' => 'form_control']) !!}<br>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form_group">
            {!! Form::file('file') !!}<br>            
        </div>
    </div>    
    <div class="col-md-8">
        <div class="form_group">
            <label>Rectificacion</label>
            {!! Form::checkbox('tipo', 1, false, ['class' => 'form_control']) !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="form_group">
            {!! Form::submit('subir', ['class' => 'btn btn-default success btn-xs']) !!}
        </div>
    </div>
{!! Form::close() !!} 
<br><br>
<div class="col-md-8">
    <table class="table table-striped table-condensed">
        <thead>
            <tr>
                <th>FOLIO</th>
                <th>TIPO</th>
            </tr>
        </thead>
        <tbody>   
            @foreach($inventory as $inv)
            <tr>
                <td>{{ $inv->folio_original }}</td>
                <td>
                    @if($inv->tipo == '09')
                        RECTIFICACIÓN
                    @else
                        INICIAL
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>