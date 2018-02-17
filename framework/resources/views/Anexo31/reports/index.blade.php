@extends('suite.esuite')

@section('html-title')
    Anexo 31 - Simulador
@endsection

@section('header')
    @include('suite.partials.headers.anexo31')
@endsection

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Estado de Cuenta
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <strong>  Inventario Inicial</strong>
                        </div>
                        <div class="col-md-12">
                            Valor Comercial: {{ $inventario->inicial }}
                        </div>
                        <div class="col-md-12">
                            Abonos: {{ $inventario->descargo }}
                        </div>
                        <div class="col-md-12">
                            Saldo: {{ $inventario->saldo }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            Cargos: {{ $posterior->cargos }}
                        </div>
                        <div class="col-md-12">
                            I.V.A. Cargos: {{ $posterior->iva_cargos }}
                        </div>
                        <div class="col-md-12">
                            Abonos: {{ $posterior->abonos }}
                        </div>
                        <div class="col-md-12">
                            I.V.A. Abonos: {{ $posterior->iva_abonos }}
                        </div>
                        <div class="col-md-12">
                            Saldo: {{ $posterior->saldo }}
                        </div>
                        <div class="col-md-12">
                            I.V.A.: {{ $posterior->iva }}
                        </div>
                    </div>
                    @foreach($fracciones as $frac)
                        <div class="col-md-12">
                            <label>FRACCION: {{ $frac->fraccion }}</label>
                        </div>
                        <div class="col-md-4">
                            <p class="text-xs">Inventario Inicial: {{ $frac->inicial }}</p>    
                        </div>        
                        <div class="col-md-2">
                            <p class="text-xs">Cargos: {{ $frac->cargos }}</p>
                        </div>
                        <div class="col-md-2">
                            <p class="text-xs">I.V.A. Cargos: {{ $frac->iva_cargos }}</p>
                        </div>
                        <div class="col-md-2">
                            <p class="text-xs">Abonos: {{ $frac->abonos }}</p>
                        </div>
                        <div class="col-md-2">
                            <p class="text-xs">I.V.A. Abonos: {{ $frac->iva_abonos }}</p>
                        </div>
                        <div class="col-md-2">
                            <p class="text-xs">Saldo: {{ $frac->saldo }}</p>
                        </div>
                        <div class="col-md-2">
                            <p class="text-xs">I.V.A.: {{ $frac->iva }}</p>
                        </div>
                        <div class="col-md-2">
                            @if($frac->total < $frac->abonos)
                            <p class="text-xs text-danger">SOBREDESCARGO {{ $frac->abonos - $frac->total}}</p>
                            @endif
                        </div>
                       
                        <div class="col-md-12">                            
                            <table class="table table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>REFERENCIA</th>
                                        <th></th>
                                        <th>CARGOS</th>
                                        <th>IVA CARGOS</th>
                                        <th>ABONOS</th>
                                        <th>IVA ABONOS</th>                        
                                        <th>SALDO</th>
                                        <th>IVA PENDIENTE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Anexo31\Balance::where('fraccion', $frac->fraccion)->get() as $detalle)
                                    <tr>
                                        <td>{{ $detalle->aduana }} - {{ $detalle->patente }} - {{ $detalle->pedimento }}</td>
                                        @if($detalle->tipo == 1)
                                            <td>INICIAL</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{ $detalle->saldo_ini }}</td>
                                        <td>{{ $detalle->iva_inv }}</td>
                                        <td>{{ $detalle->descargo }}</td>
                                        <td>{{ $detalle->iva_des }}</td>
                                        <td>{{ $detalle->saldo }}</td>
                                        <td>{{ $detalle->iva }}</td>
                                    </tr>                        
                                    @endforeach
                                </tbody>
                            </table>  
                        </div>                                   
                    @endforeach          
                </div>
            </div> 
        </div>
    </div>
@endsection
