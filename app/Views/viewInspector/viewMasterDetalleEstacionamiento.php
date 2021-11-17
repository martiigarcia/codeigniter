<?= $this->extend("templates/master")?>

<?= $this->section('titulo') ?>
    Detalle de estacionamiento
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="caption uppercase text-taffy">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                             class="bi bi-book-half" viewBox="0 0 16 16">
                            <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                        </svg>
                        Detalle del estacionamiento
                    </div>

                </div>

                <div class="card-body" style="display: flex">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header">Datos del estacionamiento</div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        Estado: <?= $estadia['estado'] == 1 ? "ACTIVA" : "FINALIZADA"; ?></li>
                                    <li class="list-group-item">Cantidad de
                                        horas: <?= $estadia['cantidad_horas'] == null ? "INDEFINIDO" : $estadia['cantidad_horas'] ?></li>
                                    <li class="list-group-item">Fecha inicio: <?= $estadia['fecha_inicio'] ?></li>
                                    <li class="list-group-item">Fecha fin: <?= $estadia['fecha_fin'] ?></li>
                                    <li class="list-group-item">Zona: <?= $estadia['zona_nombre'] ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header">Datos del vehiculo</div>
                            <div class="card-body">

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Patente del
                                        vehiculo: <?= $estadia['vehiculo_patente'] ?></li>
                                    <li class="list-group-item">Marca y modelo del
                                        vehiculo: <?= $estadia['vehiculo_marca_nombre'] ?> <?= $estadia['vehiculo_modelo_nombre'] ?></li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header">Datos del usuario</div>
                            <div class="card-body">

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Nombre y apellido: <?= $estadia['nombre_usuario'] ?>
                                        , <?= $estadia['apellido_usuario'] ?></li>
                                    <li class="list-group-item">DNI: <?= $estadia['dni_usuario'] ?></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?= $this->endSection() ?>