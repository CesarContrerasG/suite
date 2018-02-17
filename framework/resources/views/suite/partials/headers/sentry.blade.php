<div class="navbar navbar-default navbar-static-top navbar-fixed navbar-sentry">
    <div class="container">
        <header class="flex-box space-between">
            <div class="app-title">
                <div class="app-name app-green">Sentry</div>
                <div class="app-decription">Background Control of the Suite</div>
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
            <ul class="navbar-anchors anchors-sentry">
                <a href="{{ route('sentry.home') }}"><li class="anchor">Dashboard</li></a>
                <a href="{{ route('sentry.masters.index') }}"><li class="anchor">Cuentas Maestras</li></a>
                <a href="{{ route('sentry.modules.index') }}"><li class="anchor">Modulos</li></a>
                <a href="{{ route('sentry.tools.index') }}"><li class="anchor">Herramientas</li></a>
            </ul>
        </nav>
    </div>
</div>