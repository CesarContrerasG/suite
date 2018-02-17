<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('dist/css/enterprise.css') }}">

    <title>Esuite - Iniciar Sesión</title>
</head>
<body>
    <div class="login-content">
        <div class="login-form">

            <div class="panel panel-default">
                <div class="panel-body position-relative">
                    <div class="login-brand">
                        <div class="flex-box space-between">
                            <div class="login-message">
                                <h1 class="without-margin">Inicia Sesión</h1>
                                <p class="without-margin">con tu cuenta de ESuite</p>
                            </div>
                            <div class="login-logo">
                                <img src="{{ asset('img/default/esuite.png') }}" alt="esuite">
                            </div>
                        </div>
                    </div>

                    @yield('content')

                </div>
            </div>

            <div class="text-center">
                <div class="login-application-list">
                    <p>Una cuenta de Esuite para todas tus Aplicaciones</p>
                    <img src="{{ asset('img/application/secenet.png') }}" alt="secenet">
                    <img src="{{ asset('img/application/recove.png') }}" alt="recove">
                    <img src="{{ asset('img/application/cove.png') }}" alt="cove">
                    <img src="{{ asset('img/application/qore.png') }}" alt="qore">
                </div>
            </div>
        </div>
    </div>
</body>
</html>