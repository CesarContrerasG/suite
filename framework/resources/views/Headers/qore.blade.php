<header class="qore">
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
                <img src="{{ asset('img/logos/thumbnails/thumbnail_qore.jpg') }}" alt="logo" />
            </div>
            <h1>Qore</h1>
        </div>
    </div>
    <div class="navigation_app">
        <div class="container">
            <nav>
                <div class="navigation">
                    <ul>
                        <li><a href="{{ url('home') }}"><i class="icon-pentagonal-chart"></i>Suite</a></li>
                        <li><a href="{{ route('qore.home') }}"><i class="icon-equalization-control"></i>Dashboard</a></li>
                        <li><a href="{{ route('qore.accounts') }}"><i class="icon-dollar-symbol"></i>Cuentas</a></li>
                        <li><a href="{{ route('qore.administration') }}"><i class="icon-icon"></i>Administración</a></li>
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
