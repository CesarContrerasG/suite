<div class="panel panel-default">
    <ul class="list-group">
        @foreach($users as $user)
            <li class="list-group-item">
                <div class="row flex-box">
                    <div class="col-md-3"><i class="icon-person"></i> {{ $user->fullname }}</div>
                    <div class="col-md-3"><i class="icon-domain"></i> {{ $user->departament->company->name }}</div>
                    <div class="col-md-3">
                        @if($user->extra == NULL)
                            <span class="secundary-element"><i class="icon-star_border"></i> No Autorizado</span>
                        @else
                            <span class="secundary-element"><i class="icon-star"></i> Autorizado</span>
                        @endif
                    </div>
                    <div class="col-md-3 text-right">
                        {!! Form::open(['route' => ['sentry.users.authorize', \Hashids::connection('security')->encode($user->id)], 'method' => 'POST', 'role' => 'form']) !!}
                            @if($user->extra == NULL)
                                <button class="bnt btn-default btn-sm btn-round btn-round-primary">
                                    <i class="icon-check"></i> Autorizar
                                </button>
                            @else
                                <button class="bnt btn-default btn-sm btn-round btn-round-primary">
                                    <i class="icon-close"></i> Cancelar
                                </button>
                            @endif 
                        {!! Form::close() !!}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>