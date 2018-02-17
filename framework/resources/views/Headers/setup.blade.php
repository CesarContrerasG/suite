<header>
    <div class="suite_name_brand">
        <div class="container">
            <h2><strong>E</strong> Suite <small>made by E-Code</small></h2>
        </div>
    </div>
    <div class="container">
        <div class="suite_name_app">
            <div class="suite_logo_app">
                <img src="{{ asset('img/logos/thumbnails/thumbnail_apps.jpg') }}" alt="logo" />
            </div>
            <h1>Security & Updates</h1>
        </div>
    </div>
    <div class="navigation_app">
        <div class="container">
            <nav>
                <div class="navigation">
                    <ul>
                        <li><a href="{{ url('home') }}"><i class="icon-pentagonal-chart"></i>Suite</a></li>
                        <li><a href="{{ route('sentry.home') }}"><i class="icon-dashboard"></i>Dashboard</a></li>
                        <li><a href="{{ route('sentry.masters.index') }}"><i class="icon-crown"></i>Master Users</a></li>
                        <li><a href="{{ route('sentry.modules.index') }}"><i class="icon-aplications"></i>Modules</a></li>
                        <li><a href="#"><i class="icon-tools"></i>Tools</a></li>
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
