@extends('suite.enterprise')

@section('content')
    <!-- Banner Degradado -->
    <div class="banner-gradient {{ $classtime }}"></div>

    <div class="container overbanner">
        <div class="row" style="position:relative;">

            <div class="col-md-4">
                <!-- Datos Generales de la Empresa -->
                @include('Platform.enterprise.panel-master')

                @if(auth()->user()->belongs_master)
                    @include('Platform.enterprise.panel-clients')
                @endif

                <!-- Panel de Contacto -->                
                @include('Platform.enterprise.panel-contact')
            </div>

           <div class="col-md-8">
                <!-- Panel con la información de la Empresa -->
                @include('Platform.enterprise.panel-company')

                <!-- Panel con la información del Usuario -->
                @include('Platform.enterprise.panel-user')

                <!-- Panel con Módulos activos de la Suite -->
                @include('Platform.enterprise.panel-suite')

                @if(auth()->user()->belongs_master)
                    @include('Platform.enterprise.panel-suite-client')
                @endif
            </div>

            <div class="notification-badge animated tada background-primary">
                <i class="icon-textsms"></i>
            </div>

            @include('Platform.enterprise.panel-notifications')

        </div>
    </div>

    {!! Form::open(['url' => 'api/notification/viewed', 'method' => 'POST', 'id' => 'form_delete']) !!}
        {!! Form::hidden('user_id', auth()->user()->id) !!}
        {!! Form::hidden('notification_id', null, ['id' => 'notification_id']) !!}
    {!! Form::close() !!}
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
                time = moment("{{ auth()->user()->created_at }}" , "YYYY-MM-DD, H:mm A").fromNow();
                $(this).text(time);
            });
        });

        $('.notification-badge').click(function(){
            button = $(this);
            notification = $('.panel-notifications');
            button.addClass('bounceOutDown');
            setTimeout(function(){
                button.hide();
                notification.animate(
                    {
                        "right": 0
                    }, 500);
            }, 600);
        });

        $('.panel-notifications-close').click(function(){
           notification = $(this).parent();
           button = $('.notification-badge');
           notification.animate(
               {
                   "right": "-410px"
               }, 500);
           button.removeClass('bounceOutDown');
           setTimeout(function(){
               button.addClass('bounceIn').show();
           }, 600);
        });

        $('.notification-view').click(function(e){
            e.preventDefault();

            var content = $(this).parent().parent().parent();
            var notification = $(this).data('notification');

            $('#notification_id').val(notification);

            var form = $('#form_delete');
            var url = form.attr('action');
            var data = form.serialize();

            content.fadeOut();

            $.post(url, data, function(result){
                console.log(result);
            }).fail(function(error){
               console.log(error);
               content.fadeIn();
            });
        });

        $('.show-suite').click(function(e){
            e.preventDefault();
            $('.panel-hidden').hide();
            $('#panel-company-' + $(this).data('company')).toggle();
        });
    </script>
@endsection