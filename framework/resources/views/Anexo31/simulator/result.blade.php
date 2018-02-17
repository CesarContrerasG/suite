@extends('suite.esuite')

@section('html-title')
    Anexo 31 - Simulador
@endsection

@section('header')
    @include('suite.partials.headers.anexo31')
@endsection

@section('content')
   <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Inicia tu descargo
                </div>
                <div class="panel-body">  
                    <table class="table table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>FRACCION</th>
                                <th>CARGOS</th>
                                <th>CARGOS - IVA</th>
                                <th>ABONOS</th>
                                <th>ABONOS - IVA</th>
                                <th>SALDO</th>
                                <th>CREDITO IVA</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($result as $res)            
                            <tr>    
                                <td>{{ $res->fraccion }}</td>
                                <td>{{ $res->cargo }}</td>
                                <td>{{ $res->iva_inv }}</td>
                                <td>{{ $res->abono }}</td>
                                <td>{{ $res->iva_des }}</td>
                                <td>{{ $res->saldo }}</td>
                                <td>{{ $res->iva }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection