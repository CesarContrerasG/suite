@extends('suite.esuite')

@section('html-title')
    Qore - Pagos del Contrato
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datetimepicker.css') }}">
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.accounts') }}"><i class="icon-dollar-symbol"></i>Cuentas</a></li>
    <li><a href="{{ route('qore.receivables.index') }}">Cuentas por Cobrar</a></li>
    <li>Pagos de la Factura {{ $invoice->folio }}</li>
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success animated fadeInRight">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-4">
             @include('Qore.partials.sidebar_accounts')
        </div>
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar Nuevo Pago</div>
                <div class="panel-body">
                    {!! Form::open(['route' => ['qore.receivable.payments.store', $invoice], 'method' => 'POST', 'files' => true, 'class' => 'form row']) !!}
                    <div class="col-md-6">
                        <div class="form-group form-green{{ $errors->has('payment_date') ? ' has-error' : '' }}">
                            {!! Form::label('payment_date', 'Fecha de Pago') !!}
                            {!! Form::text('payment_date', null, ['class' => 'form-control', 'id' => 'payment_date']) !!}
                            @if ($errors->has('payment_date'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('payment_date') }}</strong>
                                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-green{{ $errors->has('payment_amount') ? ' has-error' : '' }}">
                            {!! Form::label('payment_amount', 'Importe de Pago') !!}
                            {!! Form::number('payment_amount', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('payment_amount'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('payment_amount') }}</strong>
                                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-green{{ $errors->has('voucher') ? ' has-error' : '' }}">
                            {!! Form::label('voucher', 'Comprobante de Pago') !!}
                            {!! Form::file('voucher', ['class' => 'form-control']) !!}
                            @if ($errors->has('voucher'))
                                <span class="help-block">
                                                        <strong>{{ $errors->first('voucher') }}</strong>
                                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="form-group">
                            {!! Form::hidden('invoice_id', $invoice->id) !!}
                            {!! Form::submit('Guardar Factura', ['class' => 'btn btn-default btn-sm btn-round btn-round-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Pagos de la Factura</div>
                <ul class="list-group">
                    @if(count($payments) > 0)
                        @foreach($payments as $payment)
                            <div class="list-group-item">
                                <div class="flex-box space-between">
                                    <div class="paragraph-info col-md-4">
                                        <h3>{{ $payment->payment_date }}</h3>
                                        <p>Fecha de Pago</p>
                                    </div>
                                    <div class="paragraph-info col-md-3">
                                        <h3 class="text-color text-green"><strong>{{ '$'.number_format($payment->payment_amount, 2, '.', '') }}</strong></h3>
                                        <p>Importe de Pago</p>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Opciones <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdown">
                                            <li><a href="{{ route('qore.receivables.payment.pdf', $payment) }}">Descargar</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <li class="list-group-item">
                            <p class="alert alert-warning">
                                <strong>Advertencia:</strong> No hay datos registrados
                            </p>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/moment.js')  }}"></script>
    <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
    <script>
        $('#payment_date').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        $('select').niceSelect();
    </script>
@endsection
