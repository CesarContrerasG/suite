<div>
    <ul class="nav nav-tabs suite-tabs-green" role="tablist">
        <li role="presentation" class="active"><a href="#create" aria-controls="create" role="tab" data-toggle="tab">Nuevo Registro</a></li>
        <li role="presentation"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">Cargar Información</a></li>
        <li role="presentation"><a href="#filter" aria-controls="filter" role="tab" data-toggle="tab">Buscar</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="create">
            <div class="with-padding">
                <div class="row">
                    {!! Form::open(['route' => 'qore.catalogs.countries.store', 'method' => 'POST']) !!}
                    @include('Qore.catalogs.countries.form')
                    @if(count($errors) > 0)
                        <div class="col-md-12 with-errors">
                            @foreach($errors->all() as $error)
                                <ul>
                                    <li>{{ $error }}</li>
                                </ul>
                            @endforeach
                        </div>
                    @endif

                    <div class="col-md-12 text-right">
                        <div class="form-group">
                            {!! Form::submit('Guardar Registro', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="upload">
            <div class="with-padding">
                <div class="row">
                    {!! Form::open(['route' => 'qore.catalogs.countries.import', 'method' => 'POST', 'files' => true]) !!}
                    <div class="col-md-12">
                        <div class="form-group form-green">
                            {!! Form::label('file', 'Archivo con los datos a importar') !!}
                            {!! Form::file('file', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="form-group">
                            {!! Form::submit('Procesar Archivo', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                            {!! Form::close() !!}
                            <a href="{{ route('qore.catalogs.countries.layout') }}" class="btn btn-default btn-sm btn-round">Descargar Layout</a>
                            <a href="{{ route('qore.catalogs.countries.export') }}" class="btn btn-default btn-sm btn-round btn-round-warning">Descargar Información</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="filter">
            <div class="with-padding">
                <div class="row">
                    {!! Form::open() !!}
                    <div class="col-md-12">
                        <div class="form-group form-green">
                            {!! Form::label('search', 'Parametro de busqueda') !!}
                            {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            {!! Form::submit('Buscar Clave de País', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
