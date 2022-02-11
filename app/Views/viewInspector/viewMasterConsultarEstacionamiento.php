<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
    Consultar por estacionamientos
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="main">
        <div class="container">

            <div class="table-responsive container">

                <table id="tableUsuarios" class="table table-striped table-bordered table-hover ">

                    <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Patente del vehiculo</th>
                        <th>Propietario</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <th>Horas estacionado</th>
                        <th>Zona</th>
                        <th>Opciones</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $i = 0;
                    foreach ($estadias as $estadia) : ?>

                        <tr>
                            <td><?= $estados[$i] == true ? "ACTIVA" : "FINALIZADA"; ?></td>
                            <td><?= $estadia['vehiculo_patente']; ?></td>
                            <td><?= $estadia['nombre_usuario']; ?></td>
                            <td><?= $estadia['fecha_inicio']; ?></td>
                            <td><?= $estadia['fecha_fin']; ?></td>
                            <td><?= $estadia['duracion_definida'] ? $cantidad_horas[$i] : "INDEFINIDO" ?></td>
                            <td><?= $estadia['zona_nombre']; ?></td>
                            <td>
                                <a href="<?= base_url('inspector/verDetalleEstacionamiento/' . $estadia['id']); ?>"
                                   class="btn btn-outline-taffy bt-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                   title="Ver detalle">
                                    <i class="bi bi-search"></i></a>

                            </td>

                        </tr>
                        <?php
                        $i++;
                    endforeach; ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>