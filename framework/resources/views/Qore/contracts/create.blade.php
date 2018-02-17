@extends('suite.esuite')

@section('html-title')
    Qore - Registrar Nuevo Contrato
@endsection

@section('html-head')
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css')  }}">
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.accounts') }}">Cuentas</a></li>
    <li><a href="{{ route('qore.contracts.index') }}">Contratos</a></li>
    <li>Registrar Nuevo Contrato</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            @include('Qore.partials.sidebar_accounts')
        </div>
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar Nuevo Contrato</div>
                <div class="panel-body">
                    {{ Form::open(['route' => 'qore.contracts.store', 'method' => 'POST', 'class' => 'form']) }}
                    @include('Qore.contracts.partials.form')
                    <div class="row">
                        <div class="col-md-12 section-divider divider-green">
                            <p><strong>Servicios del Contrato</strong></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-list-option">
                                @foreach($products as $product)
                                    <label class="list-option-item" data-hidden="{{ $product->id }}">
                                        <input type="checkbox" class="option" name="product-{{ $product->id }}">
                                        <div class="flex-box">
                                            <div class="badge-circle badge-active-green">
                                                <i class="icon-layers"></i>
                                            </div>
                                            <p><strong>{{ $product->name }}</strong></p>
                                        </div>
                                    </label>
                                    <div class="form-register-service form-hidden" id="form-hidden-{{ $product->id }}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {!! Form::textarea('conditions-'.$product->id, null, ['placeholder'
                                                    => 'Condiciones', 'rows' => 3, 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">$</div>
                                                        {!! Form::number("price-".$product->id, $product->price,
                                                        ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::select('billing_cycle-'.$product->id, $cycles, null,
                                                    ['class' => 'form-control'])!!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="icon-insert_invitation"></i>
                                                        </div>
                                                        {!! Form::text('billing_date-'.$product->id, null, ['class' =>
                                                        'dates form-control', 'placeholder' => 'Fecha Facturación', 'id' =>
                                                        'billing_date-'.$product->id]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            {!! Form::submit('Registrar Contrato', ['class' => 'btn btn-default btn-sm btn-round
                            btn-round-success']) !!}
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.nice-select.min.js')  }}" charset="utf-8"></script>
    <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select').niceSelect();


            $('.dates').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
            $('#opening_date').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
            $('#ending_date').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
            $('#revision_time').bootstrapMaterialDatePicker({
                date: false,
                shortTime: false,
                format: 'HH:mm'
            });
            $('#payment_time').bootstrapMaterialDatePicker({
                date: false,
                shortTime: false,
                format: 'HH:mm'
            });

            $('.list-option-item').click(function(){
                if($(this).children('.option').prop('checked')){
                    $(this).addClass('active');
                    hidden_item = $(this).data('hidden');
                    $('#form-hidden-' + hidden_item ).addClass('form-visible animated pulse');
                }else{
                    $(this).removeClass('active');
                    hidden_item = $(this).data('hidden');
                    $('#form-hidden-' + hidden_item ).removeClass('form-visible animated pulse');
                }
            });

        });
    </script>
@endsection
