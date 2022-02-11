<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
    Listado de ventas
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
                        <th>Propietario</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ventas as $venta) : ?>

                        <tr>
                            <td><?= $venta['patente']; ?></td>
                            <td><?= $venta['fecha_inicio']; ?></td>
                            <td><?= $venta['fecha_fin']; ?></td>
                            <td><?= $venta['nombre']; ?>-<?= $venta['apellido']; ?></td>


                        </tr>
                    <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>