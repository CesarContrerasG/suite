@extends('suite.esuite')

@section('html-title')
    Qore - Cuentas por Pagar
@endsection

@section('header')
    @include('suite.partials.headers.qore')
@endsection

@section('breadcrumb')
    <li><a href="{{ route('qore.accounts') }}"><i class="icon-dollar-symbol"></i>Cuentas</a></li>
    <li>Cuentas por Cobrar</li>
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
                            <div><i class="icon-files-empty"></i></div>
                            <div>
                                <h3>Cuentas por Cobrar</h3>
                                <p>Control de facturas y proximos pagos</p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item text-right">
                        <a href="#" class="btn btn-default btn-sm btn-round">Exportar PDF</a>
                    </li>
                    @include('Qore.accounts.partials.grid')
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/moment.js') }}"></script>
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
    </script>
@endsection
