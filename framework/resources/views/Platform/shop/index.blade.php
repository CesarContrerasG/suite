@extends('suite.enterprise')

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}">Home</a></li>
    <li>Tienda de Aplicaciones</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <p><strong>Cuenta de Prueba:</strong> Su cuenta no puede realizar compras, ya que pertenece a un demo.</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="widget-title widget-title-green">
                            <div class="flex-box">
                                <div><i class="icon-cart"></i></div>
                                <div>
                                    <h3>Tienda de Aplicaciones</h3>
                                    <p>Correspondiente al Apendice 08 del Anexo 22</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="card-application-shop text-center">
                    <img src="{{ asset('img/application/qore.png') }}" alt="qore">
                    <div class="card-application-name">
                        QORE
                    </div>
                    <div class="card-application-action">
                        <a href="#">COMPRAR</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card-application-shop text-center">
                    <img src="{{ asset('img/application/cove.png') }}" alt="qore">
                    <div class="card-application-name">
                        COVE
                    </div>
                    <div class="card-application-action">
                        <a href="#">COMPRAR</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card-application-shop text-center">
                    <img src="{{ asset('img/application/recove.png') }}" alt="qore">
                    <div class="card-application-name">
                        RECOVE
                    </div>
                    <div class="card-application-action">
                        <a href="#">COMPRAR</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card-application-shop text-center">
                    <img src="{{ asset('img/application/secenet.png') }}" alt="qore">
                    <div class="card-application-name">
                        SECENET
                    </div>
                    <div class="card-application-action">
                        <a href="#">COMPRAR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection