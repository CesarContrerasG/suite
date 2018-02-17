<div class="navbar navbar-default navbar-static-top navbar-fixed navbar-red">
    <div class="container">
        <header class="flex-box space-between">
            <div class="app-title">
                <div class="app-name app-red">Anexo 31</div>
                <div class="app-decription">Simulador Anexo 31</div>
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
                <a href="{{ route('anexo31.home') }}"><li class="anchor">Dashboard</li></a>
                <a href="{{ route('anexo31.certification.index') }}"><li class="anchor">Configuración</li></a>
                <a href="{{ route('anexo31.upload.index') }}"><li class="anchor">Carga Información</li></a>
                <a href="{{ route('anexo31.simulator.index') }}"><li class="anchor">Descargos</li></a>
                <a href="{{ route('anexo31.reports.index') }}"><li class="anchor">Reportes</li></a>
            </ul>
        </nav>
    </div>
</div>
