<?= $this->extend("templates/vendedor/masterVendedor")?>
<?= $this->section('content') ?>

    <div class="main">
                        

                            <div class="container">
                    
                                    <div class="table-responsive container">

                                        <table id="tableUsuarios" class="table table-striped table-bordered table-hover ">

                                                <thead>
                                                    <tr >
                                                        
                                                        <th>Patente del vehiculo</th>
                                                        <th>Marca y modelo</th>
                                                        <th>Propietario (Nombre completo y DNI)</th>
                                                       
                                                        <th>Opciones</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <?php foreach ($vehiculos as $vehiculo) : ?>

                                                            <tr>
                                                                <td><?= $vehiculo['vehiculo_patente'];?></td>
                                                                <td><?= $vehiculo['vehiculo_marca_nombre'];?>, <?= $vehiculo['vehiculo_modelo_nombre'];?></td>
                                                                <td><?= $vehiculo['vehiculo_usuario_nombre'];?> <?= $vehiculo['vehiculo_usuario_apellido'];?>. <?= $vehiculo['vehiculo_usuario_dni'];?></td>
                                                                
                                                                <td>
                                                                    <a href="#"
                                                                    class="btn btn-outline-warning bt-sm      ">
                                                                    <i class="bi bi-search"></i></a>

                                                                </td>
                                                                
                                                            </tr>
                                                    <?php endforeach; ?>
                                                    
                                                </tbody>

                                        </table>
                                    </div>
                                </div>
                    
    </div>

<?= $this->endSection() ?>