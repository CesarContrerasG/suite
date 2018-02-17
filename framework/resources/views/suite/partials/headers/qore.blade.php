<div class="navbar navbar-default navbar-static-top navbar-fixed navbar-green">
    <div class="container">
        <header class="flex-box space-between">
            <div class="flex-box">
                <div class="app-logo">
                    <img src="{{ asset('img/application/qore.png') }}" alt="Logo Qore">
                </div>
                <div class="app-title">
                    <div class="app-name app-green">Qore</div>
                    <div class="app-decription">Administración Interna</div>
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
            <ul class="navbar-anchors anchors-green">
                <a href="{{ route('qore.home') }}"><li class="anchor">Dashboard</li></a>
                <a href="{{ route('qore.accounts') }}"><li class="anchor">Cuentas</li></a>
                <a href="{{ route('qore.administration') }}"><li class="anchor">Administraciòn</li></a>
                <a href="{{ route('qore.applications') }}"><li class="anchor">Aplicaciones</li></a>
            </ul>
        </nav>
    </div>
</div>