            @if(count($modules) > 0) 
                @if(count($clients) > 0)
                    @foreach($clients as $client)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="widget-account-client">
                                    <div class="account-client-heading">
                                        <div class="flex-box">
                                            <div class="account-client-logo">
                                                @if($client->logo != "")
                                                    <img src="{{ Storage::disk('companies')->url($client->id.'/'.$client->logo) }}" alt="">
                                                @else
                                                    <img src="{{ asset('img/default/default_img.png') }}" alt="logo client">
                                                @endif
                                            </div>
                                        <div class="account-client-data">
                                            <p class="without-margin account-client-name">{{ $client->name }}</p>
                                            <p class="without-margin account-client-phone">{{ $client->phone }}</p>
                                            <p class="without-margin account-client-email">{{ $client->contact }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-client-applications row">
                                    @foreach($modules as $module)
                                        @if(count($client->modules()->where('module_id', $module->id)->get()) > 0)                                        
                                            <?php 
                                            $record = $client->modules()->where('module_id', $module->id)->first(); 
                                            $active = $record->pivot->active;
                                            ?>
                                        @else
                                            <?php $active = 0;  ?>
                                        @endif
                                        <div class="account-application col-md-2 text-center {{ ($active==0) ? ' blocked' : '' }}">
                                            <img src="{{ Storage::disk('logos')->url($module->logo) }}" alt="logo application">
                                            <p>{{ $module->name }}</p>
                                            <div>
                                                <input type="checkbox" name="toggle" class="sw module-activate" id="{{ $client->name."-".$module->name }}"  data-company="{{ \Hashids::encode($client->id) }}" data-module="{{ $module->id }}" {{ ($active==1) ? 'checked' : '' }}>
                                                <label for="{{ $client->name."-".$module->name }}"></label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">Encontramos un inconveniente en tu Suite de Aplicaciones</div>
                        <div class="panel-body">
                            <div class="alert alert-warning">
                                <p><strong>Warning</strong>: No tienes clientes registrados. <strong>¡Registra un cliente para poder asignarle aplicaciones!</strong></p>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="panel panel-default">
                    <div class="panel-heading">Encontramos un inconveniente en tu Suite de Aplicaciones</div>
                    <div class="panel-body">
                        <div class="alert alert-warning">
                            <p><strong>Warning</strong>: No tienes aplicaciones activas. <strong>¡Contacta a Ecode para resolver este inconveniente!</strong></p>
                        </div>
                    </div>
                </div>
            @endif