<div class="navbar navbar-default navbar-static-top navbar-fixed navbar-purple">
    <div class="container">
        <header class="flex-box space-between">
            <div class="flex-box">
                <div class="app-logo">
                     <img src="{{ asset('img/application/cove.png') }}" alt="Logo Cove">
                </div>
                <div class="app-title">
                    <div class="app-name app-purple">Cove</div>
                    <div class="app-decription">Administración de Comprobantes de Valor Elec.</div>
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
            <ul class="navbar-anchors anchors-purple">
                <?php $company = Hashids::encode(session()->get('company')); ?>
                <a href="{{ route('cove.home', $company) }}"><li class="anchor">Dashboard</li></a>
                <a href="{{ route('cove.catalogs.index') }}"><li class="anchor">Catálogos</li></a>
                <a href="{{ route('cove.administration.index') }}"><li class="anchor">Administración</li></a>
                <a href="{{ route('cove.reports.index') }}"><li class="anchor">Reportes</li></a>
            </ul>
        </nav>
    </div>
</div>
