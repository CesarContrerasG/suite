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
                        <th>COVE</th> 
                        <th>FACTURA</th>                      
                        <th>FECHA</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($coves as $cov)
                <tr>
                    <td>{{ $cov->cove_edocument }}</td>                    
                    <td>{{ $cov->cove_factura }}</td>
                    <td>{{ $cov->cove_fecha_edocument }}</td>
                    <td>
                        <a href="{{ route('recove.cove.download',[$cov->cove_edocument,$referen,1]) }}" class="btn btn-xml" title="XML"><i class="material-icons">description</i></a>
                        <a href="{{ route('recove.cove.download',[$cov->cove_edocument,$referen,2]) }}" class="btn btn-acuse" title="Acuse"><i class="material-icons">description</i></a>
                    </td>
                </tr>                
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
