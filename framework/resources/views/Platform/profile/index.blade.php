@extends('suite.enterprise')

@section('html-head')
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('js/chartjs.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
@endsection

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}">Home</a></li>
    <li>Perfil de Usuario</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="widget-title widget-title-green">
                            <div class="flex-box">
                                <div><i class="icon-stats-dots"></i></div>
                                <div>
                                    <h3>Actividad en la Plataforma</h3>
                                    <p>Registro correspondiente a la actividad del Usuario</p>
                                </div>
                            </div>
                        </div>
                    </div>                        
                    <div class="panel-body">
                        {!! $chartjs->render() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="widget-profile-user">
                            @if(auth()->user()->photo != "")
                                <img src="{{ Storage::disk('users')->url(auth()->user()->id.'/'.auth()->user()->photo) }}" alt="avatar user">
                            @else
                                <img src="{{ asset('img/default/avatar.png') }}" alt="avatar user">
                            @endif
                            <p class="profile-user-name">{{ auth()->user()->fullname }}</p>
                            <p class="profile-user-departament">
                                @if(auth()->user()->departament_id != 0)
                                    <i class="icon-style"></i> <strong>{{ auth()->user()->departament->name }}</strong>
                                @else
                                    <i class="icon-style"></i> <strong>Cliente</strong>
                                @endif
                            </p>
                            <p class="profile-user-email">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="widget-profile-data data-with-margin">
                            <div class="profile-data-item">
                                <p class="without-margin data-tag">TRABAJANDO JUNTOS DESDE</p>
                                <p class="without-margin">
                                    <span class="moment-span">{{ substr(auth()->user()->created_at, 0, 10) }}</span>
                                </p>
                            </div>
                            <div class="profile-data-item">
                                <p class="without-margin data-tag">EMPRESA</p>
                                <p class="without-margin">{{ auth()->user()->master->company->name }}</p>
                            </div>
                        </div>

                    </div>
                </div>

                @include('Platform.profile.panel-access-modules')
                
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            moment.locale('es');
            var globalLocale = moment();
            var localLocale = moment();

            localLocale.locale('es');
            localLocale.format('LLLL');
            globalLocale.format('LLLL');

            dates = $('.moment-span');
            dates.each(function(){
                time = moment("{{ auth()->user()->created_at }}" , "YYYY-MM-DD, H:mm A").fromNow();
                $(this).text(time);
            });
        });
    </script>
@endsection