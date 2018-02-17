<div class="panel-notifications">
    <div class="panel-notifications-close">
        <i class="icon-close"></i>
    </div>
    <div class="enterprise-notifications">
        @if(count($notifications) > 0)
            @foreach($notifications as $notification)
                <div class="notification">
                    <p class="without-margin"><strong><span class="configuration-primary">{{ $notification->notification_title }}</span></strong></p>
                    <p class="without-margin">{!! $notification->notification !!}</p>
                    <div class="flex-box space-between with-margin-top">
                        <p class="notification-date"><strong>{{ $notification->date_show }}</strong></p>
                        <p><a href="#" class="btn btn-sm btn-round btn-round-green notification-view" data-notification="{{ $notification->id }}">Marcar como visto</a></p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="with-padding text-center text-notification">
                <i class="icon-tag_faces"></i> No hay notificaciones
            </div>
        @endif
    </div>
</div>