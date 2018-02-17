        <table>
            <thead>
                <tr>
                    <th colspan="4">BITACORA EDOCUMENT</th>
                </tr>
            </thead>
            <tbody>
            @foreach($pedimentos as $ped)                
                <tr>
                    <td colspan="3"><strong>Pedimento</strong>{{ $ped->aduana }}-{{ $ped->patente }}-{{ $ped->pedimento }}</td>
                    <td>{{ $ped->fecha }}</td>  
                </tr>               
                <?php
                    $referen = $ped->aduana.'-'.$ped->patente.'-'.$ped->pedimento;
                    $edocument = \DB::connection('mysql')->table('bitacora_ED')->where('reference',$referen)->get();   
                ?>                
                @foreach($edocument as $ed)
                <tr>
                    <td>{{ $ed->edocument }}</td>
                    <td colspan="3">
                        {{ $ed->observation == '' ? 'Recuperado'  : $ed->observation }}
                    </td> 
                </tr>
                @endforeach            
            @endforeach
            </tbody>
        </table>
    
    