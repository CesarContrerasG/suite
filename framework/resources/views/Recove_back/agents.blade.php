@extends('suite.esuite')

@section('html-title')
    RECOVE - Patente Aduanales
@endsection

@section('header')
    @include('suite.partials.headers.recove')
@endsection


@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Patentes Aduanales
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'recove.agents.store','enctype' => 'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::file('file') !!}
                                    <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Importar</button>
                                </div>                                
                            </div>
                        </div>
                    {{Form::close()}}
                    <div>
                        <table class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>PATENTE</th>
                                    <th>RFC</th>
                                    <th>RAZON SOCIAL</th>
                                </tr>
                            </thead>
                            <tbody>                   
                                @foreach($agents as $age)
                                <tr>
                                    <td>{{ $age->pk_age }}</td>
                                    <td>{{ $age->age_rfc }}</td>
                                    <td>{{ $age->age_razon }}</td>                       
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
