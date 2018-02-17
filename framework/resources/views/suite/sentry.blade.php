<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Sentry | @yield('html-title', 'Nameless')
    </title>

    <!-- Styles -->
    @yield('html-head')
    <link href="{{ asset('dist/css/sentry.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

@yield('header')

<div class="breadcrumb">
    <div class="container">
        <ul class="flex-box flex-end">
            @yield('breadcrumb')
        </ul>
    </div>
</div>

<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<!-- Scripts -->
<script src="{{ asset('dist/js/jquery-3.1.0.min.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
{{--<script src="{{ asset('dist/js/app.js') }}"></script> --}}
@yield('scripts')
</body>
</html>
