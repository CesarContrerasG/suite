@extends('suite.esuite')

@section('html-title')
    RECOVE - Recuperación
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/snippets-datepicker-red.css')  }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('header')
    @include('suite.partials.headers.recove')
@endsection

@section('breadcrumb')
    <li><a href="#">Dashboard</a></li>
    <li>Recuperación</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-red">
                        <div class="flex-box">
                            <div><i class="icon-spinner"></i></div>
                            <div>
                                <h3>Recuperación</h3>
                                <p>Busca tus pedimenos en especifico o en un rango de fechas.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('recove.process.store') }}" method="post" enctype="multipart/form-data"> 
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-upper">Carga el listado con pedimentos a recuperar</label>
                                <div class="form-group form-red">
                                    {!! Form::file('file', ['class' => 'form-control']) !!}  
                                </div>   
                            </div>

                            <div class="col-md-12">
                                <br>
                                <div class="section-divider divider-red"></div>
                                <br>
                            </div>

                            <div class="col-md-12">
                                <label>Buscar por rango de fechas y aduanas</label>              
                            </div>                  

                            <div class="col-md-6">
                                <div class="form-group form-red{{ $errors->has('fecha_ini') ? ' has-error' : '' }}">
                                    <label for="fecha_ini">Fecha Inicial</label>
                                    {!! Form::text('fecha_ini', session()->get('fechaini'), ['class' => 'form-control','id' => 'date_start']) !!}
                                    @if ($errors->has('fecha_ini'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fecha_ini') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-red{{ $errors->has('fecha_fin') ? ' has-error' : '' }}">
                                    <label for="fecha_fin">Fecha Inicial</label>
                                    {!! Form::text('fecha_fin', session()->get('fechafin'), ['class' => 'form-control','id' => 'date_end']) !!}
                                    @if ($errors->has('fecha_fin'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fecha_fin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12"> 
                                <div class="form-group form-red">
                                    <label for="aduana">Aduanas</label>
                                    {!! Form::select('aduana',$aduanas,null,['data-placeholder'=>'Selecciona aduana...', 'class'=>'chosen-select form-control', 'multiple'=>true, 'tabindex'=>'4','id'=>'adu_select','style'=>'width:100%']) !!}        
                                </div>
                                {{ Form::hidden('adu_oculto', '', array('id' => 'adu_oculto')) }}
                                {{ Form::hidden('aduanas', null ,['id' => 'aduanas']) }}
                                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                            </div>
                            <div class="col-md-12 text-right">
                                <button onclick="searchList()" type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Buscar</button> 
                            </div>               
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>  
    <script src="{{ asset('dist/js/chosen.jquery.js') }}"></script>
    <script type="text/javascript">
        $('#date_start').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        $('#date_end').bootstrapMaterialDatePicker({ weekStart : 0, time: false });

        var config = {
          '.chosen-select'           : {},
          '.chosen-select-deselect'  : {allow_single_deselect:true},
          '.chosen-select-no-single' : {disable_search_threshold:10},
          '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'}
        }

        for (var selector in config) {
          $(selector).chosen(config[selector]);
        }
        function searchList()
        {
            var url = 'process';
            var aduanas = [];
            $(".chosen-choices li" ).each(function(index ) {
                aduanas.push($(this).text());
            });
            $('#aduanas').val(aduanas);
        }
    </script>
@endsection