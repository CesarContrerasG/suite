@if(count($users) > 0)
    @foreach($users as $user)
        <div class="col-md-6">
            <div class="panel panel-default">
            	<div class="panel-body">
            		<div class="widget-card-user">
						<div class="card-data-user">
            				<div>
								@if($user->photo != "")
            						<img src="{{ Storage::disk('users')->url($user->id.'/'.$user->photo) }}" alt="{{ $user->name }}">
								@else
									<img src="{{ asset('img/default/avatar.png') }}" alt="{{ $user->name }}">
								@endif
            				</div>
            				<div class="widget-card-user-data">
            					<p class="without-margin">{{ $user->fullname }}</p>
            					<p class="without-margin data-email">{{ $user->email }}</p>
            					<p class="without-margin color-secundary"><strong>{{ $user->company->name }}</strong></p>
            				</div>
						</div>
						<div class="widget-card-user-options">
							<div class="dropdown">
								<button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<div class="only-icon">
                            			<i class="icon-more_vert"></i>
									</div>
                        		</button>
								<ul class="dropdown-menu" aria-labelledby="dropdown-user">
                            		<li><a href="{{ route('platform.users.edit', Hashids::encode($user->id)) }}">Editar</a></li>
                            		<li><a href="{{ route('platform.applications.config', Hashids::encode($user->id)) }}">Permisos</a></li>
                           	 		<li role="separator" class="divider"></li>
                            		<li><a href="#" class="btn-delete" data-user="{{ Hashids::encode($user->id) }}">Eliminar</a></li>
                        		</ul>
							</div>
						</div>
            		</div>
            	</div>
            </div>
        </div>
    @endforeach
@else
    No se encontraron usuarios registrados.
@endif
