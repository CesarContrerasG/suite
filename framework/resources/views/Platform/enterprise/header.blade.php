<div class="navbar navbar-default navbar-static-top">
    <div class="navbar-brand"><a href="{{ url('home') }}">E Suite</a></div>
        <div class="container">
            <header>
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                @if(auth()->user()->photo != "")
                                    <img src="{{ Storage::disk('users')->url(auth()->user()->id.'/'.auth()->user()->photo) }}" alt="{{ auth()->user()->fullname }}" class="navbar-user-thumbnail">
                                @else
                                    <img src="{{ asset('img/default/avatar.png') }}" alt="{{ auth()->user()->fullname }}" class="navbar-user-thumbnail">
                                @endif
                                <strong class="navbar-user-name">{{ auth()->user()->fullname }}</strong>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <div class="triangle-top"></div>
                                <li>
                                    <a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </header>
        </div>
    </div>