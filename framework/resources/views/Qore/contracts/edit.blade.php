@extends('suite.esuite')

@section('html-title')
    Qore - Administrar Contrato
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
    <li><a href="{{ route('qore.accounts') }}"><i class="icon-dollar-symbol"></i>Cuentas</a></li>
    <li><a href="{{ route('qore.contracts.index') }}">Contratos</a></li>
    <li>Administrar Contrato</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('Qore.partials.sidebar_accounts')
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div>
                        <ul class="nav nav-tabs suite-tabs-green" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#gral" aria-controls="gral" role="tab" data-toggle="tab">Información
                                    General</a>
                            </li>
                            <li role="presentation">
                                <a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">Editar
                                    Contrato</a>
                            </li>
                            <li role="presentation">
                                <a href="#files" aria-controls="files" role="tab" data-toggle="tab">Archivos</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="gral">
                                <div class="with-padding">
                                    <p>Información General del Contrato</p>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="edit">
                                <div class="with-padding">
                                    {{ Form::model($contract, ['route' => ['qore.contracts.update', Hashids::encode($contract->id)], 'method' => 'PUT', 'class' => 'form']) }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::hidden('master_id', Auth::user()->current_master->id) !!}
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Cliente</label>
                                                <p>{{ $contract->company->name }}</p>
                                                {!! Form::hidden('company_id', $contract->company_id) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('credit_days', 'Dias de Credito') !!}
                                                {!! Form::number('credit_days', $contract->dates->credit_days, ['class' =>
                                                'form-control']) !!}
                                                @if ($errors->has('credit_days'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('credit_days') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('revision_day', 'Día de Revisión') !!}
                                                {!! Form::select('revision_day', [1 => "Lunes", 2 => "Martes", 3 => "Miercoles", 4 => "Jueves", 5 => "Viernes", 6 => "Sabado", 7 => "Domingo"], $contract->dates->revision_day, ['class' => 'form-control']) !!}
                                                @if ($errors->has('revision_day'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('revision_day') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('revision_time', 'Hora de Revisión') !!}
                                                {!! Form::text('revision_time', $contract->dates->revision_time, ['class' =>
                                                'form-control', 'id' => 'revision_time']) !!}
                                                @if ($errors->has('revision_time'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('revision_time') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('payment_day', 'Día de Pago') !!}
                                                {!! Form::select('payment_day', [1 => "Lunes", 2 => "Martes", 3 => "Miercoles", 4 => "Jueves", 5 => "Viernes", 6 => "Sabado", 7 => "Domingo"], $contract->dates->payment_day, ['class' => 'form-control']) !!}
                                                @if ($errors->has('payment_day'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('payment_day') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('payment_time', 'Hora de Pago') !!}
                                                {!! Form::text('payment_time', $contract->dates->payment_time, ['class' =>
                                                'form-control', 'id' => 'payment_time']) !!}
                                                @if ($errors->has('payment_time'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('payment_time') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('opening_date') ? ' has-error' : '' }}">
                                                {!! Form::label('opening_date', 'Fecha de Apertura') !!}
                                                {!! Form::text('opening_date', $contract->dates->opening_date, ['class' =>
                                                'form-control', 'id' => 'opening_date']) !!}
                                                @if ($errors->has('opening_date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('opening_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('ending_date') ? ' has-error' : '' }}">
                                                {!! Form::label('ending_date', 'Fecha de Cierre') !!}
                                                {!! Form::text('ending_date', $contract->dates->ending_date, ['class' =>
                                                'form-control', 'id' => 'ending_date']) !!}
                                                @if ($errors->has('ending_date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('ending_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 section-divider divider-green">
                                            <p><strong>Servicios del Contrato</strong></p>
                                        </div>
                                    </div>

                                    <div class="form-list-option">
                                        @foreach($contract->details as $detail)
                                            <label class="list-option-item {{ $detail->active == 1 ? "active" : "" }}"
                                                   data-hidden="{{ $detail->service->id }}">
                                                <input type="checkbox" class="option" name="product-{{ $detail->service->id }}" {{ $detail->active == 1 ? "checked" : "" }}>
                                                <div class="flex-box">
                                                    <div class="badge-circle badge-active-green">
                                                        <i class="icon-layers"></i>
                                                    </div>
                                                    <p><strong>{{ $detail->service->name }}</strong></p>
                                                </div>
                                            </label>
                                            <div class="form-register-service form-hidden {{ $detail->active == 1 ? "form-visible animated pulse" : "" }}" id="form-hidden-{{ $detail->service->id }}">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            {!! Form::textarea('conditions-'.$detail->service->id, $detail->conditions, ['placeholder' => 'Condiciones', 'rows' => 3, 'class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">$</div>
                                                                {!! Form::number("price-".$detail->service->id, $detail->contract_price, ['class' => 'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            {!! Form::select('billing_cycle-'.$detail->service->id, $cycles, $detail->billing_cycle, ['class' => 'form-control'])!!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="icon-insert_invitation"></i>
                                                                </div>
                                                                {!! Form::text('billing_date-'.$detail->service->id, $detail->billing_date, ['class' => 'dates form-control', 'placeholder' => 'Fecha Facturación', 'id' => 'billing_date-'.$detail->service->id]) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            {!! Form::submit('Guardar Cambios del Contrato', ['class' => 'btn
                                            btn-default btn-sm btn-round btn-round-success']) !!}
                                            {{ Form::close() }}
                                            @include('Qore.contracts.partials.delete')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="files">
                                <div class="with-padding">
                                    <div class="row">
                                        @include('Qore.contracts.partials.files')
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
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
            $('#emition_date').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
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

            $('.item-selection').click(function(){
                if($(this).children('.option').prop('checked')){
                    $(this).addClass('active');
                    hidden_item = $(this).data('hidden');
                    $('#form-hidden-' + hidden_item ).addClass('visible animated pulse');
                }else{
                    $(this).removeClass('active');
                    hidden_item = $(this).data('hidden');
                    $('#form-hidden-' + hidden_item ).removeClass('visible animated pulse');
                }
            });
        });
    </script>
@endsection
