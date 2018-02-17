@extends('suite.esuite')

@section('html-title')
    Qore - Aplicaciones
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li>Aplicaciones</li>
@endsection

@section('content')
    <div class="row">

        <div class="col-md-4">
           @include('Qore.partials.sidebar_applications')
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-green">
                        <div class="flex-box">
                            <div><i class="icon-equalizer"></i></div>
                            <div>
                                <h3>Aplicaciones</h3>
                                <p>Empresas y aplicaciones a las cuales puede acceder.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="widget-account-client">
                        <div class="account-client-heading">
                            <div class="flex-box">
                                <div class="account-client-logo">
                                    <img src="{{ asset('img/default/logo-master.jpg') }}" alt="logo client">
                                </div>
                                <div class="account-client-data">
                                    <p class="without-margin account-client-name">E-Code</p>
                                    <p class="without-margin account-client-phone">4412345678</p>
                                    <p class="without-margin account-client-email">contacto@vitechmex.com.mx</p>
                                </div>
                            </div>
                        </div>
                        <div class="account-client-applications row">
                            <div class="account-application col-md-2 text-center blocked">
                                <img src="{{ asset('img/application/qore.png') }}" alt="logo application">
                                <p>QORE</p>
                            </div>
                            <div class="account-application col-md-2 text-center">
                                <img src="{{ asset('img/application/recove.png') }}" alt="logo application">
                                <p>RECOVE</p>
                            </div>
                            <div class="account-application col-md-2 text-center">
                                <img src="{{ asset('img/application/secenet.png') }}" alt="logo application">
                                <p>SECENET</p>
                            </div>
                        </div>
                    </div>

                    <div class="widget-account-client">
                        <div class="account-client-heading">
                            <div class="flex-box">
                                <div class="account-client-logo">
                                    <img src="{{ asset('img/default/logo-master.jpg') }}" alt="logo client">
                                </div>
                                <div class="account-client-data">
                                    <p class="without-margin account-client-name">E-Code Impostor</p>
                                    <p class="without-margin account-client-phone">4412345678</p>
                                    <p class="without-margin account-client-email">contacto@vitechmex.com.mx</p>
                                </div>
                            </div>
                        </div>
                        <div class="account-client-applications row">
                            <div class="account-application col-md-2 text-center">
                                <img src="{{ asset('img/application/qore.png') }}" alt="logo application">
                                <p>QORE</p>
                            </div>
                            <div class="account-application col-md-2 text-center blocked">
                                <img src="{{ asset('img/application/recove.png') }}" alt="logo application">
                                <p>RECOVE</p>
                            </div>
                            <div class="account-application col-md-2 text-center">
                                <img src="{{ asset('img/application/secenet.png') }}" alt="logo application">
                                <p>SECENET</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection