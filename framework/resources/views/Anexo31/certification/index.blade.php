@extends('suite.esuite')

@section('html-title')
    Anexo 31 - Configuración
@endsection

@section('header')
    @include('suite.partials.headers.anexo31')
@endsection

@section('content')
   <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Datos de la empresa
                </div>
                <div class="panel-body">   
                    <div class="col-md-6">
                        <div class="col-md-8">
                            <label>{{$company->business_name}}</label>
                        </div>
                        <div class="col-md-8">
                            <label>R.F.C. {{ $company->rfc }}</label>
                        </div>
                        <div class="col-md-12">
                            <label>Domicilio: {{ $company->address }} {{ $company->outdoor }}</label> 
                        </div>
                    </div>                    
                    <div class="col-md-6">
                        <div class="form-group form-red">
                            <div class="col-md-12">
                                <strong>CERTIFICACIONES</strong>
                            </div>
                            @if(!is_null($certification))
                                @foreach($certification as $cert)
                                {!! Form::model($cert,["route" => ["anexo31.certification.update", $cert->id], 'method' => 'PUT']) !!}
                                    <div class="col-md-3">
                                        <p class="text-ls">{{ $cert->name }}</p>                        
                                        <p class="text-ls">{!! Form::date('date_cert', $cert->pivot->date_cert) !!}</p>                        
                                        <button type="submit" class="btn btn-default success btn-xs">modificar</button>
                                    </div>
                                {!! Form::close() !!}     
                                @endforeach  
                            @endif                                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

