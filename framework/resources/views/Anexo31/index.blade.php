@extends('suite.esuite')

@section('html-title')
    Anexo 31 - Dashboard
@endsection

@section('header')
    @include('suite.partials.headers.anexo31')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel with-padding row">
                <div class="col-md-12 text-xs-center">
                    <div class="with-padding">
                        <strong>ESTADO DE CUENTA GENERAL</strong>
                    </div>
                </div>
                <div class="col-md-6 text-xs-center with-sm-padding bg-qore-thin text_right">
                    <div class="with-padding">
                        <strong>INVENTARIO INICIAL</strong>
                    </div>
                </div>
                <div class="col-md-2 with-border-right">
                    <div class="with-padding">
                        <p class="text-xs">Valor Comercial</p>
                        <p class="text-lg"><strong><span id="animate-number-prospects">{{ number_format($inventario->inicial) }}</span></strong></p>
                    </div>                
                </div>
                <div class="col-md-2 with-border-right">
                    <div class="with-padding">
                        <p class="text-xs">Abonos</p>
                        <p class="text-lg"><strong><span id="animate-number-providers">{{ number_format($inventario->descargo) }}</span></strong></p>
                    </div>
                </div>
                <div class="col-md-2 with-border-right">
                    <div class="with-padding">
                        <p class="text-xs">Saldo</p>
                        <p class="text-lg text-success"><strong><span id="animate-number-clients">{{ number_format($inventario->saldo) }}</span></strong></p>
                    </div>            
                </div>
                <div class="col-md-12 with-border-top">
                </div>
                <div class="col-md-2">
                    <div class="with-padding">
                        <p class="text-xs">Cargos</p>
                        <p class="text-lg"><strong><span id="animate-number-users">{{ number_format($posterior->cargos) }}</span></strong></p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="with-padding">
                        <p class="text-xs">I.V.A Cargos</p>
                        <p class="text-lg"><strong><span id="animate-number-users">{{ number_format($posterior->iva_cargos) }}</span></strong></p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="with-padding">
                        <p class="text-xs">Abonos</p>
                        <p class="text-lg"><strong><span id="animate-number-users">{{ number_format($posterior->abonos) }}</span></strong></p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="with-padding">
                        <p class="text-xs">I.V.A. Abonos</p>
                        <p class="text-lg"><strong><span id="animate-number-users">{{ number_format($posterior->iva_abonos) }}</span></strong></p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="with-padding">
                        <p class="text-xs">Saldo</p>
                        <p class="text-lg"><strong><span id="animate-number-users">{{ number_format($posterior->saldo) }}</span></strong></p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="with-padding">
                        <p class="text-xs">IVA</p>
                        <p class="text-lg text-primary"><strong><span id="animate-number-users">{{ number_format($posterior->iva) }}</span></strong></p>
                    </div>
                </div>
                <div id="container"></div>      
            </div> 
        </div>
    </div>
@endsection
