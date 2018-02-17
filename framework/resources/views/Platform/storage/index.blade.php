@extends('suite.enterprise')

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}">Home</a></li>
    <li>Almacenamiento</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="widget-storage-backup">
                            <div class="storage-backup-icon">
                                <i class="icon-database"></i>
                            </div>
                            <div class="storage-backup-content">
                                <div class="storage-database-name">DATABASE: ETAM</div>
                                <div class="storage-database-info row">
                                    <div class="col-md-4">
                                        <p class="without-margin">Last Backup</p>
                                        <p class="without-margin"><span>16 Jun, 2017</span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="without-margin">Next Backup</p>
                                        <p class="without-margin"><span>23 Jun, 2017</span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="without-margin">Total Size</p>
                                        <p class="without-margin"><span>460 MB <i class="icon-onedrive"></i></span></p>
                                    </div>
                                </div>
                                <div class="storage-database-actions">
                                    <a href="#" class="btn btn-primary btn-sm disabled">Descargar</a>
                                    <a href="#" class="btn btn-default btn-sm disabled">Restaurar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="widget-storage-backup">
                            <div class="storage-backup-icon">
                                <i class="icon-spinner4"></i>
                            </div>
                            <div class="storage-backup-content">
                                <div class="storage-database-name">DATABASE CATEGORIES</div>
                                <div class="storage-database-info row">
                                    <div class="col-md-4">
                                        <p class="without-margin">Last Backup</p>
                                        <p class="without-margin"><span>16 Jun, 2017</span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="without-margin">Next Backup</p>
                                        <p class="without-margin"><span>23 Jun, 2017</span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="without-margin">Total Size</p>
                                        <p class="without-margin"><span>460 MB <i class="icon-onedrive"></i></span></p>
                                    </div>
                                </div>
                                <div class="storage-database-actions">
                                    <a href="#" class="btn btn-primary btn-sm" id="show-categories">Seleccionar Categorias</a>
                                </div>
                            </div>
                        </div>
                        <div class="widget-storage-categories row text-center">
                            <div class="storage-category col-md-2">
                                <i class="icon-box-add"></i>
                                <p><a href="#" class="btn btn-xs btn-primary disabled">Categoria</a></p>
                            </div>
                            <div class="storage-category col-md-2">
                                <i class="icon-box-add"></i>
                                <p><a href="#" class="btn btn-xs btn-primary disabled">Categoria</a></p>
                            </div>
                            <div class="storage-category col-md-2">
                                <i class="icon-box-add"></i>
                                <p><a href="#" class="btn btn-xs btn-primary disabled">Categoria</a></p>
                            </div>
                            <div class="storage-category col-md-2">
                                <i class="icon-box-add"></i>
                                <p><a href="#" class="btn btn-xs btn-primary disabled">Categoria</a></p>
                            </div>
                            <div class="storage-category col-md-2">
                                <i class="icon-box-add"></i>
                                <p><a href="#" class="btn btn-xs btn-primary disabled">Categoria</a></p>
                            </div>
                            <div class="storage-category col-md-2">
                                <i class="icon-box-add"></i>
                                <p><a href="#" class="btn btn-xs btn-primary disabled">Categoria</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong><span class="heading-title-platform"><i class="icon-earth"></i> Almacenamiento Global</span></strong></div>
                    <div class="panel-body">
                        <div class="widget-storage-list">
                            <div class="storage-list-item">
                                <div class="flex-box">
                                    <div class="storage-item-icon">
                                        <i class="icon-stackoverflow clear-blue"></i>
                                    </div>
                                    <div class="storage-item-data">
                                        <p>460 MB</p>
                                        <span>Información en su Base de Datos</span>
                                    </div>
                                </div>
                            </div>
                            <div class="storage-list-item">
                                <div class="flex-box">
                                    <div class="storage-item-icon">
                                        <i class="icon-file-zip clear-purple"></i>
                                    </div>
                                    <div class="storage-item-data">
                                        <p>804 MB</p>
                                        <span>Archivos en su sitio FTP.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="storage-list-item">
                                <div class="flex-box">
                                    <div class="storage-item-icon">
                                        <i class="icon-camera clear-green"></i>
                                    </div>
                                    <div class="storage-item-data">
                                        <p>235 MB</p>
                                        <span>Imagenes en su cuenta.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#show-categories").click(function(e){
            e.preventDefault();
            $(".widget-storage-categories").toggle("slow");
        });
    </script>
@endsection