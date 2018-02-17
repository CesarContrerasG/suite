<div class="navbar navbar-default navbar-static-top navbar-fixed navbar-red">
    <div class="container">
        <header class="flex-box space-between">
            <div class="flex-box">
                <div class="app-logo">
                    <img src="{{ asset('img/application/recove.png') }}" alt="Logo Recove">
                </div>
                <div class="app-title">
                    <div class="app-name app-red">Recove</div>
                    <div class="app-decription">Recuperación de Documentos WS</div>
                </div>
            </div>
            <div>
                <a href="{{ url('home') }}" class="btn btn-default btn-sm btn-round">Suite</a>
                <a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-sm btn-round">Cerrar Sesión</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </header>
        <nav class="app-navbar">
            <ul class="navbar-anchors anchors-red">
                <a href="#"><li class="anchor">Dashboard</li></a>
                <a href="{{ route('recove.seals.index') }}"><li class="anchor">Sellos Digitales</li></a>
                <a href="{{ route('recove.agents.index') }}"><li class="anchor">Agentes Aduanales</li></a>
                <a href="{{ route('recove.download.index') }}"><li class="anchor">Configuracion FTP</li></a>
                <a href="{{ route('recove.process.index') }}"><li class="anchor">Recuperación</li></a>
            </ul>
        </nav>
    </div>
</div>
