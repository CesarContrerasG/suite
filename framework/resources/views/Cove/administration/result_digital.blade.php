@extends('suite.esuite')

@section('html-title')
    Digitalizar Documentos - Firma E-document
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('cove.administration.index') }}"><i class="icon-icon"></i>Administracion</a></li>
    <li>Firma E-document</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Resultado Firma E-document
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>No. Operación: {{ $operacion }}</label><br>
                            @if($result != '')           
                                <label>Tiene errores: {{ $result['error'] }}</label> <br>  
                                @if($result['leyenda'] != '')       
                                <label>Leyenda: {{ $result['leyenda'] }}</label><br>
                                @endif
                                @if($result['edocument']  == '')
                                    <div class="col-md-12">
                                        <a href="{{ route('cove.digital.sign', [$id, 1]) }}" class="btn btn-default btn-sm btn-round btn-round-success">reenviar</a><br>
                                    </div> 
                                @else
                                    <label>E-document: {{ $result['edocument'] }}</label><br>
                                    <a href="{{ route('cove.digital.acuse', $result['acuse']) }}" class="btn btn-default btn-sm btn-round btn-round-success">Descargar Acuse</a>
                                @endif
                            @else
                                <div class="col-md-12">
                                    <a href="{{ route('cove.digital.sign', [$id, 1]) }}" class="btn btn-default btn-sm btn-round btn-round-success">reenviar</a><br>
                                </div> 
                            @endif
                        </div>                        
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection