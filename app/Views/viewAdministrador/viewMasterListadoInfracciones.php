<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
    Listado de infracciones
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="main">
        <div class="container">

            <div class="table-responsive container">

                <table id="tableUsuarios" class="table table-striped table-bordered table-hover ">

                    <thead>
                    <tr>

                        <th>Patente del vehiculo</th>
                        <th>Propietario en infraccion</th>
                        <th>Calle</th>
                        <th>Zona</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Estado de pago</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($infracciones as $infraccion) : ?>

                        <tr>
                            <td><?= $infraccion['vehiculo_patente']; ?></td>
                            <td><?= $infraccion['usuario_nombre']; ?> <?= $infraccion['usuario_apellido']; ?></td>
                            <td><?= $infraccion['calle']; ?></td>
                            <td><?= $infraccion['zona_nombre']; ?></td>
                            <td><?= $infraccion['dia_hora']; ?></td>
                            <td><?= $infraccion['estadia_monto']; ?> </td>
                            <td><?= $infraccion['estadia_pago_pendiente'] == 0 ? "PAGO" : "PAGO PENDIENTE"; ?> </td>

                        </tr>

                    <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>

    <p style="color: rgb(0,155,125)"> <?= session('mensaje'); ?></p>

<?= $this->endSection() ?>