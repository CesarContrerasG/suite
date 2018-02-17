@extends('suite.enterprise')

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('suite.platform.index') }}">Home</a></li>
    <li>Catálogos</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
             <div class="col-md-4">
                @include('Platform.enterprise.panel-master')
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                    
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs suite-tabs-green" role="tablist">
                                <li role="presentation" class="active"><a href="#oficials" aria-controls="oficials" role="tab" data-toggle="tab">Catálogos Oficiales</a></li>
                                <li role="presentation"><a href="#empresarials" aria-controls="empresarials" role="tab" data-toggle="tab">Catálogos Empresariales</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="oficials">
                                    @include('Platform.catalogs.oficials.grid')
                                </div>
                                <div role="tabpanel" class="tab-pane" id="empresarials">
                                    @include('Platform.catalogs.empresarials.grid')
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection