<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Esuite Home</title>
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    @yield('html-head')
    <link rel="stylesheet" href="{{ asset('dist/css/enterprise.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css')  }}">
    <link rel="stylesheet" href="{{ asset('css/datetimepicker.css') }}">


    <?php
        $primary_color = "#16a085";
        $secundary_color = "#db4a5b";

        if(isset($configuration)){
            if($configuration->primary_color != "") {
                $primary_color = $configuration->primary_color;
            }

            if($configuration->secundary_color != "") {
                $secundary_color = $configuration->secundary_color;
            }
        }
    ?>

    <style>

        a.configuration-anchor { color: {{ $primary_color }}; }
        a.configuration-anchor:hover { color: {{ $secundary_color }}; text-decoration: none; }

        span.configuration-primary { color: {{ $primary_color }}; }
        span.configuration-secundary { color: {{ $secundary_color }}; }

        .border-primary { border-bottom: 1px solid {{ $primary_color }} !important; }

        .background-primary { background-color: {{ $primary_color }}; }

        .color-secundary { color: {{ $secundary_color }}; 

    </style>

</head>
<body>
    @yield('header')

    @if(Session::has('announcement'))
        <div class="announcement animated slideInDown">
            <div class="container">
                <h4 class="without-margin">{{ Session::get('announcement-title') }}</h4>
                <p class="without-margin">{{ Session::get('announcement') }}</p>
                <p class="with-margin-vertical"><a href="#" class="announcement-close btn btn-sm btn-round">Cerrar Notificación</a></p>
            </div>
        </div>
    @endif

    @include('Platform.enterprise.demo-announcements')

    <div class="sidebar">
        <ul class="sidebar-menu">
            <li><a href="{{ url('/home') }}"><i class="icon-apps"></i></a></li>
            <li><a href="{{ route('platform.profile.index') }}" data-toggle="tooltip" data-placement="right" title="Perfil"><i class="icon-person"></i></a></li>
            
            @if(auth()->user()->have_any_admin)
                <li><a href="{{ route('platform.users.index') }}" data-toggle="tooltip" data-placement="right" title="Usuarios"><i class="icon-people"></i></a></li>
            @endif
            @if(auth()->user()->company_id == auth()->user()->master_id)
                <li><a href="{{ url('/configuration') }}"  data-toggle="tooltip" data-placement="right" title="Personalización"><i class="icon-palette"></i></a></li>
                <li><a href="{{ route('platform.notifications.index') }}" data-toggle="tooltip" data-placement="right" title="Notificaciones"><i class="icon-notifications"></i></a></li>
            @endif
            <li><a href="{{ route('platform.catalogs.index') }}"  data-toggle="tooltip" data-placement="right" title="Catálogos"><i class="icon-folder2"></i></a></li>
            {{-- <li><a href="{{ route('platform.storage.index') }}"  data-toggle="tooltip" data-placement="right" title="Almacenamiento"><i class="icon-save"></i></a></li>
            <li><a href="{{ route('platform.shop.index') }}"  data-toggle="tooltip" data-placement="right" title="Tienda"><i class="icon-shopping_cart"></i></a></li>--}}
            <li>
                <a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  data-toggle="tooltip" data-placement="right" title="Logout">
                    <i class="icon-switch"></i>
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>

    <div class="breadcrumb">
        <div class="container">
            <ul class="flex-box flex-end">
                @yield('breadcrumb')
            </ul>
        </div>
    </div>

    @yield('content')

    <div class="container">
        <footer>
            <div class="with-padding text-right">
                <img src="{{ asset('img/default/esuite-footer.png') }}" alt="Logo Cuenta Maestra" class="enterprise-footer">
            </div>
        </footer>
    </div>

</body>
<script src="{{ asset('dist/js/jquery-3.1.0.min.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $('.announcement-close').click(function(e){
        e.preventDefault();
        announcement = $(this).parent().parent().parent();
        announcement.animate({
            height: "toggle"
        }, 500);
    });

    $('.announcement-demo').click(function(e){
        e.preventDefault();
        $('.announcement-app').hide("fast");
        app = $(this).data('app');
        $('#announcement-' + app).show("fast");
    });
</script>
@yield('scripts')
</html>
