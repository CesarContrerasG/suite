@extends('suite.esuite')

@section('html-title')
    Qore - Contratos
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.accounts') }}">Cuentas</a></li>
    <li>Contratos</li>
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
                    <div class="widget-title widget-title-green">
                        <div class="flex-box">
                            <div><i class="icon-file-text2"></i></div>
                            <div>
                                <h3>Contratos</h3>
                                <p>Contratos vigentes registrados en Qore</p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item text-right">
                        <a href="{{ route('qore.contracts.create') }}" class="btn btn-default btn-sm btn-round">agregar contrato</a>
                    </li>
                    @include('Qore.contracts.partials.grid')
                </ul>
            </div>
        </div>
    </div>

{!! Form::open(['route' => ['qore.contracts.destroy', ':ID_CONTRACT'], 'method' => 'DELETE', 'id' => 'form_delete']) !!}
{!! Form::close() !!}
@endsection

@section('scripts')
    <script type="text/javascript">
    $(document).ready(function(){
        moment.locale('es');
        var globalLocale = moment();
        var localLocale = moment();

        localLocale.locale('es');
        localLocale.format('LLLL');
        globalLocale.format('LLLL');

        dates = $('.moment-span');
        dates.each(function(){
            fecha = $(this).text();
            time = moment(fecha+" 19:00" , "YYYY-MM-DD, H:mm A").fromNow();
            $(this).text(time);
        });
    });

    $('.btn-delete').click(function(e){
        e.preventDefault();
        var contract = $(this).data('contract');
        var section = $(this).parent().parent();
        var details = $('#details-contract-' + contract);
        var form = $('#form_delete');
        var url =  form.attr('action').replace(':ID_CONTRACT', contract);
        var data = form.serialize();

        section.fadeOut();
        details.fadeOut();

        $.post(url, data, function(result){
            alert(result.message);
        }).fail(function(){
            alert("Lo sentimos hubo un error al realizar peticiones asincronas !!");
            location.reload();
        });
    });
    </script>
@endsection
