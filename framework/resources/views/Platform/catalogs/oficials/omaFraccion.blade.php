@extends('suite.enterprise')

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('suite.platform.index') }}">Home</a></li>
    <li><a href="{{ route('platform.catalogs.index') }}">Catálogos</a></li>
    <li>OMA (Fracción Arancelaria)</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="widget-title widget-title-green">
                            <div class="flex-box">
                                <div><i class="icon-books"></i></div>
                                <div>
                                    <h3>Fracción Arancelaria</h3>
                                    <p>Correspondiente a los catálogos de la OMA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <table class="table table-striped table-datatable">
                            <thead>
                                <tr>
                                    <th>Fracción</th>
                                    <th>Descripción</th>
                                    <th>Descripción II</th>
                                    <th>Descripción III</th>
                                    <th>Unidad</th>
                                    <th>Advotr</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fractions as $fraction)
                                <tr>
                                    <td>{{ $fraction->fra_fraccion }}</td>
                                    <td>{{ $fraction->fra_descrip1 }}</td>
                                    <td>{{ $fraction->fra_descrip2 }}</td>
                                    <td>{{ $fraction->fra_descrip3 }}</td>
                                    <td>{{ $fraction->fra_unidad }}</td>
                                    <td>{{ $fraction->fra_advotr }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $fractions->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection