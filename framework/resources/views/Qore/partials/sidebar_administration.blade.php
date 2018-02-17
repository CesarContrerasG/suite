<div id="navigation-app">    
    <div class="panel panel-default panel-green">
        <div class="panel-heading"><i class="icon-tune"></i> Administración Interna</div>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('qore.products.index') }}" class="flex-box">Productos</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('qore.departaments.index') }}" class="flex-box">Departamentos</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('qore.users.index') }}" class="flex-box">Usuarios</a>
            </li>
        </ul>
    </div>

    <div class="panel panel-default panel-green">
        <div class="panel-heading"><i class="icon-domain"></i> Administración Empresas</div>
        <div class="list-group">
            <li class="list-group-item">
                <a href="{{ route('qore.companies.index') }}" class="flex-box">Clientes</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('qore.providers.index') }}" class="flex-box">Proveedores</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('qore.prospects.index') }}" class="flex-box">Prospectos</a>
            </li>
        </div>
    </div>

    <div class="panel panel-default panel-green">
        <div class="panel-heading">
            <i class="icon-folder_open"></i> Información General
        </div>
        <div class="list-group">
            <li class="list-group-item">
                <a href="{{ route('qore.catalogs.index') }}" class="flex-box">Catálogos</a>
            </li>
        </div>
    </div>
</div>
