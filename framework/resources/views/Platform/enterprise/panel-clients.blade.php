<div class="panel panel-default">
    <div class="panel-heading border-primary">
        <span class="configuration-primary">Suite de nuestros Clientes</span>
    </div>
    <div class="list-group">
        @foreach(auth()->user()->master->clients as $company)
            <div class="list-group-item">
                <a href="#" class="configuration-anchor show-suite" data-company="{{ $company->id }}"><strong><i class="icon-yelp"></i> {{ $company->name }}</strong></a>
            </div>
        @endforeach
    </div>
</div>