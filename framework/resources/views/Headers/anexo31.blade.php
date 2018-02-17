<header class="anexo31">
    <div class="suite_name_brand">
        <div class="container">
            @if(Auth::user()->departament->company->name != "")
                <?php $master = Auth::user()->departament->company->name; ?>
            @else
                <?php $master = "E-Code"; ?>
            @endif
            <h2><strong>E</strong> Suite <small>powered by {{ $master }}</small></h2>
        </div>
    </div>
    <div class="container">
        <div class="suite_name_app">
            <div class="suite_logo_app">
            </div>
            <h1>Anexo 31</h1>
        </div>
    </div>
    <div class="navigation_app">
        <div class="container">
            <nav>
                <div class="navigation">
                    <ul>
                        <li><a href="{{ url('home') }}"><i class="icon-pentagonal-chart"></i>Suite</a></li>
                        <li><a href="{{ route('anexo31.certification.index') }}"><i class="icon-equalization-control"></i>Configuración</a></li>
                        <li><a href="{{ route('anexo31.upload.index') }}"><i class="icon-upload"></i>Carga Información</a></li>
                        <li><a href="{{ route('anexo31.simulator.index') }}"><i class="icon-recovery"></i>Descargos</a></li>   
                        <li><a href="{{ route('anexo31.reports.index') }}"><i class="icon-file"></i>Reportes</a></li>                        
                        <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"><i class="icon-power-button-sign"></i>Logout</a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
