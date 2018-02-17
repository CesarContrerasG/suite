@extends('suite.esuite')

@section('html-title')
    RECOVE - Agentes Aduanales
@endsection

@section('header')
    @include('suite.partials.headers.recove')
@endsection

@section('breadcrumb')
    <li><a href="#">Dashboard</a></li>
    <li>Agentes Aduanales</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-red">
                        <div class="flex-box">
                            <div><i class="icon-users"></i></div>
                            <div>
                                <h3>Agentes Aduanales</h3>
                                <p>Listado con la información del Agente Aduanal con los que han realizado operaciones.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    
                    {!! Form::open(['route' => 'recove.agents.store','enctype' => 'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-red">
                                    {!! Form::label('file', 'Layout de Agentes Aduanales')  !!}
                                    {!! Form::file('file', ['class' => 'form-control']) !!}
                                </div>                                
                            </div>
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    @if($type < 6)
                                    <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Importar</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    {{Form::close()}}

                    <div>
                        <table class="table table-striped table-condensed text-small">
                            <thead>
                                <tr>
                                    <th>PATENTE</th>
                                    <th>RFC</th>
                                    <th>RAZON SOCIAL</th>
                                </tr>
                            </thead>
                            <tbody>                   
                                @foreach($agents as $agent)
                                <tr>
                                    <td>{{ $agent->pk_age }}</td>
                                    <td>{{ $agent->age_rfc }}</td>
                                    <td>{{ $agent->age_razon }}</td>                       
                                </tr>
                                @endforeach
                            </tbody>
                        </table>           
                    </div>
                    <div class="text-center suite-pagination-red">
                        {{ $agents->links() }}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
