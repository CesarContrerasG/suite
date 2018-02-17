<header class="recove">
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
                <img src="{{ asset('img/logos/thumbnails/thumbnail_recove.jpg') }}" alt="logo" />
            </div>
            <h1>Recove</h1>
        </div>
    </div>
    <div class="navigation_app">
        <div class="container">
            <nav>
                <div class="navigation">
                    <ul>
                        <li><a href="{{ url('home') }}"><i class="icon-pentagonal-chart"></i>Suite</a></li>
                        <li><a href="{{ route('recove.seals.index') }}"><i class="icon-seal"></i>Sellos</a></li>
                        <li><a href="{{ route('recove.agents.index') }}"><i class="icon-aduanal-user"></i>Patentes Aduanales</a></li>
                        <li><a href="{{ url('recove/download') }}"><i class="icon-ftp"></i>Config. FTP</a></li>
                        <li><a href="{{ route('recove.process.index') }}"><i class="icon-recovery"></i>Recuperación</a></li>
                        <li><a href="{{ route('recove.admin.index') }}"><i class="icon-equalization-control"></i>Administración</a></li>
                        <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"><i class="icon-power-button-sign"></i>Logout</a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
