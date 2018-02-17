        <table>
            <thead>
                <tr>
                    <th>Aduana</th>
                    <th>Patente</th>
                    <th>Pedimento</th>
                    <th>Fecha</th>
                    <th>COVE</th>
                    <th colspan="5">ED a recuperar</th>
                    <th colspan="10">Observaciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($pedimentos as $ped)
                <tr>
                    <td>{{ $ped->aduana }}</td>
                    <td>{{ $ped->patente }}</td>
                    <td>{{ $ped->pedimento }}</td>
                    <td>{{ $ped->fecha }}</td>              
                    <td>{{ $ped->cove}}</td>
                    <?php 
                    $referen = $ped->aduana.'-'.$ped->patente.'-'.$ped->pedimento;
                    $edocument = \DB::connection('mysql')->table('bitacora_ED')->where('referencia',$referen)->get();   
                    $observaciones = 'Pedimento: '.$ped->obs_ped.' COVE: '.$ped->obs_cove;
                    ?>
                    <td colspan="5">
                        @foreach($edocument as $ed)
                        {{ $ed->edocument }},
                        @endforeach
                    </td>
                    <td colspan="10">
                        {{ $observaciones }}
                    </td> 
                </tr>

            @endforeach
            </tbody>
        </table>
    
    
