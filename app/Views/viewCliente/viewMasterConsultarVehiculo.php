<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
Mi vehiculo
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
                    Mi vehiculo
                </div>

            </div>

            <div class="card-body" style="display: flex">
                <div class="col-md-9">
                    <div class="card mb-3">
                        <div class="card-header">Datos del vehiculo y propietario</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">Datos del vehiculo</div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    Patente: <?= $dominioSeleccionado['vehiculo_patente'] ?>
                                                </li>
                                                <li class="list-group-item">
                                                    Marca: <?= $dominioSeleccionado['vehiculo_marca_nombre'] ?></li>
                                                <li class="list-group-item">
                                                    Modelo: <?= $dominioSeleccionado['vehiculo_modelo_nombre'] ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">Datos del Propietario</div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    Nombre y
                                                    apellido: <?= $dominioSeleccionado['vehiculo_usuario_nombre'] ?> <?= $dominioSeleccionado['vehiculo_usuario_apellido'] ?>
                                                </li>
                                                <li class="list-group-item">
                                                    DNI: <?= $dominioSeleccionado['vehiculo_usuario_dni'] ?></li>
                                                <li class="list-group-item">
                                                    Email: <?= $dominioSeleccionado['vehiculo_usuario_email'] ?></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <div class="caption uppercase text-taffy">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                         class="bi bi-book-half" viewBox="0 0 16 16">
                        <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                    </svg>
                    Estadias registradas
                </div>

            </div>
            <?php if (!empty($estadiasTotales)): ?>
            <div class="card-body" style="display: flex">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-header">Todas mis estadias</div>
                        <div class="card-body">

                            <div class="container">

                                <div class="table-responsive container">

                                    <table id="tableUsuarios"
                                           class="table table-striped table-bordered table-hover ">

                                        <thead>
                                        <tr>


                                            <th>Fecha de Inicio</th>
                                            <th>Fecha de Fin</th>
                                            <th>Horas estacionado</th>
                                            <th>Zona</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $i = 0;
                                        foreach ($estadiasTotales as $estadia) : ?>

                                            <tr>

                                                <td><?= $estadia['fecha_inicio']; ?></td>
                                                <td><?= $estadia['fecha_fin']; ?></td>
                                                <td><?= $estadia['duracion_definida'] ? $cantidad_horas[$i] : "INDEFINIDO" ?></td>
                                                <td><?= $estadia['zona_nombre']; ?></td>

                                            </tr>

                                            <?php $i++;
                                        endforeach; ?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="card-body" style="display: flex">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header">Todas mis estadias</div>
                            <div class="card-body">

                                <p>No se han registrado estadias para este dominio</p>


                            </div>
                        </div>
                    </div>
                    <?php endif ?>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header">Datos de pagos pendientes</div>
                            <div class="card-body">

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Entre todas la estadias con pagos pendientes, resta
                                        pagar un
                                        total de:<br>$<?= $monto ?>
                                    </li>
                                    <li class="list-group-item"><a
                                                href="<?= base_url('cliente/verPagarEstadiasPendientes'); ?>"
                                                class="text-carolina">Ver detalle de estadias pendientes<br>(de todos los vehiculos)</a>
                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="caption uppercase text-taffy">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                             class="bi bi-book-half" viewBox="0 0 16 16">
                            <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                        </svg>
                        Mis infracciones
                    </div>

                </div>
                <?php if (!empty($infracciones)): ?>
                    <div class="card-body" style="display: flex">
                        <div class="col-md-9">
                            <div class="card mb-3">
                                <div class="card-header">Infracciones registradas</div>
                                <div class="card-body">

                                    <div class="container">

                                        <div class="table-responsive container">

                                            <table id="tableUsuarios"
                                                   class="table table-striped table-bordered table-hover ">

                                                <thead>
                                                <tr>

                                                    <th>Fecha de la infraccion</th>
                                                    <th>Calle y altura</th>
                                                    <th>Zona</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php foreach ($infracciones as $infraccion) : ?>

                                                    <tr>

                                                        <td><?= $infraccion['dia_hora']; ?></td>
                                                        <td>"<?= $infraccion['calle']; ?>"
                                                            al <?= $infraccion['altura']; ?></td>
                                                        <td><?= $infraccion['zona_nombre']; ?></td>
                                                    </tr>

                                                <?php endforeach; ?>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                <?php else: ?>
                    <div class="card-body" style="display: flex">
                        <div class="col-md-9">
                            <div class="card mb-3">
                                <div class="card-header">Todas mis infracciones</div>
                                <div class="card-body">

                                    <p>No se han registrado infracciones para este dominio</p>


                                </div>
                            </div>
                        </div>

                    </div>
                <?php endif ?>
            </div>
        </div>

    </div>

    <p style="color: rgb(0,155,125)"> <?= session('mensaje'); ?></p>
    <?= $this->endSection() ?>


