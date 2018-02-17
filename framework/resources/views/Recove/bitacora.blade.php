@extends('suite.esuite')

@section('html-title')
    RECOVE - Patente Aduanales
@endsection

@section('header')
    @include('suite.partials.headers.recove')
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">         
                    @if($type == 1)
                        <div>
                            <p>Se concluyo la recuperación de la información, puedes descargar tu bitacora:
                                <a href="{{ route('recove.export') }}" class="btn btn-default btn-sm btn-round btn-round-success">Bitacora Pedimentos</a></button>
                            </p>
                        </div>               
                    @elseif(count($bitacora) == 0)        
                        <div>
                            No hay información para la búsqueda solicitada o ya se ha recuperado
                        </div>                    
                    @else 
                        <h2>Pedimentos a recuperar</h2>
                        <div>
                            <table class="table table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Aduana</th>
                                        <th>Patente</th>
                                        <th>Pedimento</th>
                                        <th>Fecha</th>
                                        <th>Observaciones Pedimento</th>
                                        <th>Observaciones Cove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($bitacora as $bit)
                                    <tr>
                                        <td>{{ $bit->aduana }}</td>
                                        <td>{{ $bit->patente }}</td>
                                        <td>{{ $bit->pedimento }}</td>
                                        <td>{{ $bit->fecha }}</td>
                                        <td>{{ $bit->observaciones }}</td>
                                        <td>{{ $bit->observa_cove }}</td>
                                    </tr> 
                                @endforeach
                                </tbody>                                
                            </table>                
                            {{-- <div class="text-center suite-pagination-red">
                                {{ $bitacora->links() }}
                            </div>--}}
                            <div class="col-md-12 text-right">
                                <a href="{{ route('recove.store')  }}" class="btn btn-default btn-sm btn-round btn-round-success">Recuperar</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection