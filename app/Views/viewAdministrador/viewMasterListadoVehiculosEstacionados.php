<?= $this->extend("templates\administrador\masterAdmin")?>
<?= $this->section('content') ?>

    <div class="main">
                

                    <div class="container">
            
                            <div class="table-responsive container">

                                <table id="tableUsuarios" class="table table-striped table-bordered table-hover ">

                                        <thead>
                                            <tr >

                                                <th>Patente del vehiculo</th>
                                                <th>Fecha</th>
                                                <th>Horas estacionado</th>
                                                <th>Zona</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php foreach ($estadias_activas as $estadia) : ?>

                                                    <tr>
                                                        <td><?= $estadia['vehiculo_patente']; ?></td>
                                                        <td><?= $estadia['fecha_inicio']; ?></td>
                                                        <td>insertar horas hasta el momento de listado</td>
                                                        <td><?= $estadia['zona_nombre']; ?></td>
                                                        
                                                    </tr>
                                            <?php endforeach; ?>
                                            
                                        </tbody>

                                </table>
                            </div>
                        </div>
            
    </div>

<?= $this->endSection() ?>