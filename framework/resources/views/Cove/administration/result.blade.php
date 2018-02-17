@extends('suite.esuite')

@section('html-title')
    COVE - Firma Cove
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('cove.administration.index') }}"><i class="icon-icon"></i>Administracion</a></li>
    <li>Firma Cove</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Resultado Firma Cove
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>No. Operación: {{ $operation }}</label> <br>
                            <label>Tiene errores: {{  $acuse == '' ? 'SI' : ($result['error'] == 0 ? 'NO' : 'SI') }}</label> <br>
                            <label>Leyenda: {{ $acuse == '' && $operation == '' ? $result : $result['leyenda'] }}</label>   <br>
                            @if($operation == '' || $result['edocument'] =='')
                                <div class="col-md-12">
                                    <a href="{{ route('cove.sign', [$id, 1]) }}" class="btn btn-default btn-sm btn-round btn-round-success">reenviar</a>
                                </div> 
                            @else
                                <label>COVE: {{ $result['edocument'] }}</label><br>
                                <label>Adenda: {{ $result['adenda'] != '' ? $result['adenda'] : 'N/A' }}</label><br>
                                @if($acuse != '')
                                <div class="col-md-12">
                                    <a href="{{ route('cove.acuse', $acuse) }}" class="btn btn-default btn-sm btn-round btn-round-success">Descargar Acuse</a>
                                </div> 
                                @endif
                            @endif

                        </div>                        
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection