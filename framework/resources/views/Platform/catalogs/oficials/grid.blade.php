<ul class="list-group">
    @foreach($catalogs as $catalog)
        <li class="list-group-item">
            <div class="flex-box space-between">
                <div>
                    <h3 class="without-margin text-medium">{{ $catalog["name"] }}</h3>
                    <p class="without-margin text-small">{{ $catalog["description"] }}</p>
                </div>
                <div><a href="{{ route($catalog['route']) }}" class="btn btn-sm btn-round btn-round-green">Ver Catálogo</a></div>
            </div>
        </li>
    @endforeach
</ul>