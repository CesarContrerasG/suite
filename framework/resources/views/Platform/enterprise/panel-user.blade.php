<div class="panel panel-default">
    <div class="panel-body">
        <div class="flex-box space-between flex-start">
            <div class="flex-box">
                <div class="enterprise-user-avatar">
                    @if(auth()->user()->photo != "")
                        <img src="{{ Storage::disk('users')->url(auth()->user()->id.'/'.auth()->user()->photo) }}" alt="avatar user">
                    @else
                        <img src="{{ asset('img/default/avatar.png') }}" alt="avatar user">
                    @endif
                </div>
                <div class="enterprise-user-data">
                    <h3 class="without-margin with-md-margin-top">{{ auth()->user()->fullname }}</h3>
                    <h4 class="without-margin">{{ auth()->user()->email }}</h4>
                    <p class="with-md-margin-vertical">
                        <span class="configuration-primary">
                            @if(auth()->user()->departament_id != 0)
                                <i class="icon-style"></i> <strong>{{ auth()->user()->departament->name }}</strong>
                            @else
                                <i class="icon-style"></i> <strong>Cliente</strong>
                            @endif
                        </span>
                    </p>
                </div>
            </div>
            <div class="with-margin-vertical">
                <p class="without-margin"><i class="icon-insert_invitation"></i> En la Suite desde:</p>
                <p class="without-margin text-right">
                    <strong><span class="moment-span configuration-secundary">{{ substr(auth()->user()->created_at, 0, 10) }}</span></strong>
                </p>
            </div>
        </div>
    </div>
</div>