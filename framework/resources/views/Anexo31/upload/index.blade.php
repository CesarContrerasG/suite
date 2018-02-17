@extends('suite.esuite')

@section('html-title')
    Anexo 31 - Upload
@endsection

@section('header')
    @include('suite.partials.headers.anexo31')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div>
                        <ul class="nav nav-tabs suite-tabs-green" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#data" aria-controls="data" role="tab" data-toggle="tab">Datastage</a>
                            </li>
                            <li role="presentation">
                                <a href="#inventory" aria-controls="inventory" role="tab" data-toggle="tab">Inventario Inicial</a>
                            </li>
                            <li role="presentation">
                                <a href="#discharge" aria-controls="discharge" role="tab" data-toggle="tab">Descargos</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="data">
                                <div class="with-padding">
                                    @include('Anexo31.upload.datastage')
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="inventory">
                                <div class="with-padding">
                                    @include('Anexo31.upload.inventory')
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="discharge">
                                <div class="with-padding">
                                    @include('Anexo31.upload.discharge')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection