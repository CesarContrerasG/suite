@if(count($products) > 0)
    @foreach($products as $product)
        <li class="list-group-item">
            <div class="flex-box space-between">
                <div class="flex-box">
                    @if($product->status == 1)
                        <div class="badge-circle badge-active-green">
                            <i class="icon-layers"></i>
                        </div>
                    @else
                        <div class="badge-circle">
                            <i class="icon-layers_clear"></i>
                        </div>
                    @endif
                    <div class="paragraph-info">
                        <h3>{{ $product->name }}</h3>
                        <p class="text-color text-blue">{{ $product->description}}</p>
                    </div>
                </div>

                <div class="collection_options">
                    <div class="dropdown">
                        <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Opciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdown">
                            <li><a href="{{ route('qore.products.disabled', Hashids::encode($product->id)) }}">
                                @if($product->status == 1)
                                    Desactivar
                                @else
                                    Activar
                                @endif
                            </a></li>
                            <li><a href="{{ route('qore.products.edit', Hashids::encode($product->id)) }}">Editar</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" data-method="delete" rel="nofollow" data-url="products/{{ Hashids::encode($product->id) }}/destroy" class="delete" data-token="{{ csrf_token() }}">Eliminar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
@else
    <div class="list-group-item">
        <div class="alert alert-warning">
            <strong><i class="icon-alert"></i> Advertencia.</strong> Usted no tiene productos registrados
        </div>
    </div>
@endif
