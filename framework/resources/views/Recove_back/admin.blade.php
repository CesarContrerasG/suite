@extends('layouts.recove')

@section('content')
    <div class="col-md-12">
        <div class="recove_title">
            <h2>Administracion de operaciones</h2>
        </div>
    </div>    
    <div class="recove_form_content col-md-12">
        <div class="recove_results">
            <table>
                <thead>
                    <tr>
                        <th>ADUANA</th>
                        <th>PATENTE</th>
                        <th>PEDIMENTO</th>
                        <th>TIPO</th>
                        <th>FECHA</th>
                        <th>CLAVE</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedimentos as $ped)
                    <tr>
                        <td>{{ $ped->pk_aduana }}</td>
                        <td>{{ $ped->pk_patente }}</td>
                        <td>{{ $ped->pk_pedimento }}</td>
                        <td>{{ $ped->ref_tipope }}</td>
                        <td>{{ $ped->ref_fechapago }}</td>
                        <td>{{ $ped->ref_clave }}</td>
                        <td>
                            <a href="{{ route('recove.cove.show',$ped->pk_aduana.'-'.$ped->pk_patente.'-'.$ped->pk_pedimento) }}" class="btn btn-cove" title="COVE"><i class="material-icons">description</i></a>
                            <a href="{{ route('recove.document.show',$ped->pk_aduana.'-'.$ped->pk_patente.'-'.$ped->pk_pedimento) }}" class="btn btn-ed" title="E-Document"><i class="material-icons">description</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>           
        </div>
        <div class="pagination_content pagination_recove">
         {{ $pedimentos->links() }}
        </div>
    </div>
@endsection
