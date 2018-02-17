@extends('suite.esuite')

@section('html-title')
    COVE - Reportes
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/snippets-datepicker-purple.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('header')
    @include('suite.partials.headers.cove')
@endsection

@section('breadcrumb')
    <li>Reportes</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="widget-title widget-title-purple">
                        <div class="flex-box">
                            <div><i class="icon-books"></i></div>
                            <div>
                                <h3>Reporte COVE</h3>
                                <p>Reportes del Módulo COVE</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'cove.reports.search', 'method' => 'POST', 'class' => 'form']) !!}                                        
                        <div class="col-md-6">
                            <div class="form-group form-purple{{ $errors->has('date_start') ? ' has-error' : '' }}">
                                {!! Form::label('date_start', 'Fecha Inicial') !!}
                                {!! Form::text('date_start', null, ['class' => 'form-control', 'id' => 'date_start']) !!}
                                @if ($errors->has('date_start'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('date_start') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-purple{{ $errors->has('date_end') ? ' has-error' : '' }}">
                                {!! Form::label('date_end', 'Fecha Final') !!}
                                {!! Form::text('date_end', null, ['class' => 'form-control', 'id' => 'date_end']) !!}
                                @if ($errors->has('date_end'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_end') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default btn-sm btn-round">BUSCAR</button> 
                                <a href="{{ route('cove.reports.index') }}" class="btn btn-default btn-sm btn-round">RECARGAR</a>                               
                            </div>
                        </div>
                    {!! Form::close() !!}


                    <div class="col-sm-12">
                        <div class="widget-datatable datatable-purple text-small">

                        <table class="table table-striped table-condensed" id="report">
                            <thead>
                                <tr>
                                    <th>Referencia</th>
                                    <th>Tipo</th>
                                    <th>Factura</th>
                                    <th>Fecha de Factura</th>
                                    <th>Edocument</th>
                                    <th>Fecha Edocument</th>
                                    <th>Relacion</th>
                                    <th>Subdivision</th>
                                    <th>Certificado Origen</th>
                                    <th>No. Operacion</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!is_null($coves))
                                @foreach($coves as $cove)
                                    @for($i=0; $i<count($cove->invoices); $i++)
                                    <tr>
                                        <td>{{ $cove->pk_referencia }}</td>
                                        <td>{{ $cove->pk_tipo == 1 ? 'Importación' : 'Exportación' }}</td>
                                        <td>{{ $cove->invoices[$i]->inv_factura }}</td>
                                        <td>{{ $cove->cove_fecha }}</td>
                                        <td>{{ $cove->cove_edocument }}</td>
                                        <td>{{ $cove->cove_fecha_edocument }}</td>
                                        <td>{{ $cove->cove_relacion == 1 ? 'SI' : 'NO' }}</td>
                                        <td>{{ $cove->invoices[$i]->inv_subdivision == 1 ? 'SI' : 'NO' }}</td>
                                        <td>{{ $cove->invoices[$i]->inv_certorigen == 1 ? 'SI' : 'NO' }}</td>
                                        <td>{{ $cove->cove_operacion }}</td>
                                        <td>{{ $cove->cove_firma }}</td>
                                    </tr>
                                    @endfor
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

    <script>            
        $('#date_start').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        $('#date_end').bootstrapMaterialDatePicker({ weekStart : 0, time: false });

        $(document).ready(function() {
            var date_start = $("#date_start").val();
            var date_end = $("#date_end").val();

            $('#report').DataTable( {
                "language": {
                    "url": "{{ asset('js/Spanish.json') }}"
                },
                "searching": false,
                dom: 'Bfrtip',
                buttons: [ {
                    extend: 'excelHtml5',
                    title: 'reporte_coves_' + date_start + '_' + date_end,
                    customize: function( xlsx ) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];    
                        $('row c[r^="C"]', sheet).attr( 's', '2' );
                    }
                } ]
            } );
        } );
    </script>
@endsection
