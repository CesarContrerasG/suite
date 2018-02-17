<div id="navigation-app">    
    <div class="panel panel-default panel-purple">
        <div class="panel-heading"><i class="icon-domain"></i> Opciones</div>
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('cove.company.index') }}">Empresa</a></li>                 
        </ul>
    </div>

    <div class="panel panel-default panel-purple">
        <div class="panel-heading"><i class="icon-inbox"></i> Insumos</div>
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('cove.materials.index') }}">Materiales Importación</a></li>
            <li class="list-group-item"><a href="{{ route('cove.products.index') }}">Productos Exportación</a></li>
            <li class="list-group-item"><a href="{{ route('cove.assets.index') }}">Activo Fijo</a></li>
        </ul>
    </div>

    <div class="panel panel-default panel-purple">
        <div class="panel-heading"><i class="icon-people"></i> Catálogo</div>
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('cove.providers.index') }}">Proveedores</a></li>
            <li class="list-group-item"><a href="{{ route('cove.customers.index') }}">Clientes</a></li>
            <li class="list-group-item"><a href="{{ route('cove.consultations.index') }}">RFC Consulta</a></li>
            <li class="list-group-item"><a href="{{ route('cove.patents.index') }}">Agente Aduanal</a></li>
        </ul>
    </div>
</div>