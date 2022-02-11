<?= $this->extend("templates/master") ?>
<?= $this->section('titulo') ?>
    Listado de vehiculos estacionados
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="main">
        <div class="container">

            <div class="table-responsive container">

                <table id="tableUsuarios" class="table table-striped table-bordered table-hover ">

                    <thead>
                    <tr>

                        <th>Patente del vehiculo</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Horas estacionado</th>
                        <th>Zona</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $i = 0;
                    foreach ($estadias_activas as $estadia) : ?>

                        <tr>
                            <td><?= $estadia['vehiculo_patente']; ?></td>
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

<?= $this->endSection() ?>