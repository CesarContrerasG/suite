<div class="panel panel-transparent">
    <div class="panel-body enterprise-name">
        <div class="flex-box space-between">
            <div class="enterprise-introduce">
                <h1>{{ auth()->user()->master->company->name }}</h1>
                <h4>
                    {{ auth()->user()->master->company->address }}
                    {{ auth()->user()->master->company->outdoor }},
                    {{ auth()->user()->master->company->colony }}
                </h4>
            </div>
            <div>
                <a href="#" class="btn btn-sm btn-round"><i class="icon-domain"></i>  CLIENTES</a>
            </div>
        </div>
    </div>
</div>