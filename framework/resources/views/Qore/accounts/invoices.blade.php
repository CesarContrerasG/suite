@extends('suite.esuite')

@section('html-title')
    Qore - Facturas del Contrato
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chosen.min.css')  }}">
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.accounts') }}"><i class="icon-dollar-symbol"></i>Cuentas</a></li>
    <li><a href="{{ route('qore.receivables.index') }}">Cuentas por Cobrar</a></li>
    <li>Facturas del Contrato con {{ $contract->company->name }}</li>
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="notification_bar animated fadeInRight">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_accounts')
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registrar Nueva Factura
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => ['qore.receivable.invoices.store', Hashids::encode($contract->id)], 'method' => 'POST', 'files' => true, 'class' => 'form row']) !!}
                    <div class="col-md-12">
                        <div class="form-group form-green">
                            <label for="chosen" style="margin:6px 0;">Servicios a Facturar</label>
                            {!! Form::select('chosen', $services, null, ['class' => 'chosen-select form-control', 'multiple', 'data-placeholder' => 'Selecciona los servicios a facturar...', 'data-contract' => Hashids::encode($contract->id)]) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-green{{ $errors->has('folio') ? ' has-error' : '' }}">
                            {!! Form::label('folio', 'Folio') !!}
                            {!! Form::text('folio', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('folio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('folio') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-green{{ $errors->has('concepto') ? ' has-error' : '' }}">
                            {!! Form::label('concepto', 'Concepto') !!}
                            {!! Form::text('concepto', null, ['class' => 'form-control', 'id' => 'field_concepto']) !!}
                            @if ($errors->has('concepto'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('concepto') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-green{{ $errors->has('payment_amount') ? ' has-error' : '' }}">
                            {!! Form::label('payment_amount', 'Cantidad a Pagar') !!}
                            {!! Form::number('payment_amount', null, ['class' => 'form-control', 'id' => 'field_payment_amount']) !!}
                            @if ($errors->has('payment_amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('payment_amount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-green{{ $errors->has('billing_register') ? ' has-error' : '' }}">
                            {!! Form::label('billing_register', 'Fecha Emición') !!}
                            {!! Form::text('billing_register', null, ['class' => 'form-control', 'id' => 'billing_register']) !!}
                            @if ($errors->has('billing_register'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('billing_register') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-green{{ $errors->has('pdf') ? ' has-error' : '' }}">
                            {!! Form::label('pdf', 'Archivo PDF') !!}
                            {!! Form::file('pdf', ['class' => 'form-control']) !!}
                            @if ($errors->has('pdf'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pdf') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-green{{ $errors->has('xml') ? ' has-error' : '' }}">
                            {!! Form::label('xml', 'Archivo XML') !!}
                            {!! Form::file('xml', ['class' => 'form-control']) !!}
                            @if ($errors->has('xml'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('xml') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="form-group text-green">
                            {!! Form::hidden('contract_id', $contract->id) !!}
                            {!! Form::hidden('services', null, ['id' => 'services_index']) !!}
                            {!! Form::submit('Guardar Factura', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Facturas del Contrato con {{ $contract->company->name }}
                </div>
                <ul class="list-group">
                    @if(count($invoices) > 0)
                        @foreach($invoices as $invoice)
                            <div class="list-group-item">
                                <div class="flex-box space-between">
                                    <div class="flex-box">
                                        <div class="badge-circle badge-active-green">
                                            <i class="icon-description"></i>
                                        </div>
                                        <div class="paragraph-info">
                                            <h3>{{ $invoice->folio }}</h3>
                                            <p>{{ $invoice->concepto }}</p>
                                        </div>
                                    </div>
                                    <div class="collection_options ">
                                        <div class="dropdown">
                                            <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Opciones <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdown">
                                                <li><a href="{{ route('qore.receivables.invoices.pdf', $invoice) }}">Descargar PDF</a></li>
                                                <li><a href="{{ route('qore.receivables.invoices.xml', $invoice) }}">Descargar XML</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="list-group-item">
                            <div class="alert alert-warning">
                                <strong>Advertencia:</strong> <spam>No hay datos registrados</spam>
                            </div>
                        </div>
                    @endif
                </ul>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('js/moment.js')  }}"></script>
    <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
    <script>
        $('#billing_register').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        $(".chosen-select").chosen({disable_search_threshold: 10}).change(function(){
            var values = $(this).val();
            var contract = $(this).data('contract');

            if(values.length > 0){
                $.get("http://localhost/esuite/api/invoices/"+ contract +"/services/" + values, function( data ) {
                    if(values.length == 1){
                        data.forEach(function(array, index){
                            //console.log("indice: " + index + " - precio: $", array.price);
                            $('#field_concepto').val(array.name);
                            $('#field_payment_amount').val(array.price);
                        });
                    }else{
                        total_price = 0;
                        data.forEach(function(array, index){
                            total_price += array.price;
                            //console.log("total acumulado: " + total_price);
                        });
                        //console.log(total_price);
                        $('#field_concepto').val('');
                        $('#field_payment_amount').val(total_price);
                    }
                });
                $('#services_index').val(values);
            }
            else{
                $('#field_concepto').val('');
                $('#field_payment_amount').val('');
                $('#services_index').val('');
            }

        });
    </script>
@endsection
