@extends('layouts.recove')

@section('content')
    <div class="col-md-12">
        <div class="recove_title">
            <h2>Administracion de ED</h2>
        </div>
    </div>    
    <div class="recove_form_content col-md-12">
        <div class="recove_results">            
            <table>
                <thead>
                   <tr>
                        <th>ARCHIVO</th>                        
                        <th>E-DOCUMENT</th>
                        <th>ACUSE</th>
                        <th>
                            <a href="{{ route('recove.document.export') }}"><button>bitacora</button></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($documents as $ed)
                   <tr>
                        <td><a href="{{ route('recove.ed.download',[$referen,$ed->imgNameFile]) }}"><label>{{ $ed->imgNameFile }}</label></a></td>
                        <td>{{ $ed->imgEdocument }}</td>
                        <td colspan="2">
                            <a href="{{ route('recove.ed.download',[$referen,$ed->imgEdocument]) }}" class="btn btn-acuse" title="Acuse"><i class="material-icons">description</i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
        </ul>
        </div>
    </div>
@endsection
