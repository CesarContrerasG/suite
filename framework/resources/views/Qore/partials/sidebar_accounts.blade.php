<div id="navigation-app">
    <div class="panel panel-default panel-green">
        <div class="panel-heading">
            <i class="icon-attach_money"></i> Cuentas
        </div>
        <ul class="list-group">
            @if(Auth::user()->departament->company->has_crm)
                <li class="list-group-item">Cotizaciones</li>
            @endif
            <li class="list-group-item"><a href="{{ route('qore.contracts.index') }}">Contratos</a></li>
            <li class="list-group-item"><a href="{{ route('qore.receivables.index') }}">Cuentas por Cobrar</a></li>
            <li class="list-group-item"><a href="{{ route('qore.accounting.index') }}">Registros Contables</a></li>
        </ul>
    </div>

    <div class="panel panel-default panel-green">
        <div class="panel-heading">
            <i class="icon-equalizer3"></i> Reportes
        </div>
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('qore.history.index') }}">Historial Contable</a></li>
        </ul>
    </div>
</div>
