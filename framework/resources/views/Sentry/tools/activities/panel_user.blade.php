<div class="panel panel-default">
    <div class="panel-body">
        <div class="flex-box space-between">
            <div class="flex-box">
                <div class="sticker sticker-activity">
                    <i class="icon-person"></i>
                </div>
                <div>
                    <p class="without-margin"><i class="icon-person"></i> {{ $user->fullname  }}</p>
                    <p class="without-margin"><i class="icon-drafts"></i> {{ $user->email}}</p>
                    <p class="without-margin"><i class="icon-style"></i> {{ $user->departament->name }}</p>
                </div>
            </div>
            <div>
                <p class="without-margin"><span class="secundary-element"><i class="icon-domain"></i> {{ $user->departament->company->name }}</span></p>
                <p class="without-margin"><i class="icon-share3"></i> {{ substr($user->last_logged_at, 0, 10) }}</p>
            </div>
        </div>
    </div>
</div>