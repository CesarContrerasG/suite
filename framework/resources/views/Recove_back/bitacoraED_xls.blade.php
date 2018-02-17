        <table>
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>ED</th>
                    <th>Status</th>
                    <th colspan="5">Observaciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($documents as $doc)
                <tr>
                    <td>{{ $doc->referencia }}</td>
                    <td>{{ $doc->edocument }}</td>
                    @if($doc->status == 1)
                        <td>RECUPERADO</td>             
                    @elseif($doc->status == 2)
                        <td>NO RECUPERADO</td>  
                        @else
                        <td>PENDIENTE</td>
                    @endif
                    <td colspan="5">
                        {{ $doc->observaciones }}
                    </td> 
                </tr>
            @endforeach
            </tbody>
        </table>
    
    
