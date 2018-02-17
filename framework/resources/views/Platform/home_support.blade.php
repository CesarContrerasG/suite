@extends('layouts.apps')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel hover_banner animated fadeInUp">
                <div class="row flexbox">
                    <div class="col-md-3 with-border-bottom with-border-right with-padding text_left">
                        <strong class="text-upper text-sm">Empresa</strong>
                        <p class="text-sm">{{ Auth::user()->departament->company->name }}</p>
                    </div>
                    <div class="col-md-6 with-border-bottom with-padding text_center">
                        <div class="suite_avatar_home">
                        </div>
                        <p><strong class="text-upper text-sm">{{ Auth::user()->name }}</strong></p>
                        <p class="text-sm">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="col-md-3 with-border-bottom with-border-left with-padding text_right">
                        <strong class="text-upper text-sm">Departamento</strong>
                        <p class="text-sm">{{ Auth::user()->departament->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <p class="with-border-bottom with-sm-padding text_center text-xs text-primary">
                      Empresas disponible
                    </p>
                </div>
                <div class="row">
                    <div class="col-sm-10 col-md-offset-1 with-padding">
                        <div class="collection_app">
                            @foreach ($companies as $company) 
                               <div class="collection_item row">
                                    <div class="col-md-6">
                                        <div class="module_name">
                                            <p class="text-sm"><strong>{{ $company->business_name }}</strong></p>
                                            <p class="text-xs">R.F.C.: {{ $company->rfc }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="text_right with-padding">
                                            <a href="{{ route($url) }}"><i class="material-icons">trending_flat</i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
