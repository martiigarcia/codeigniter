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
                                                    
                                                    <?php foreach ($dominio_vehiculos as $vehiculo) : ?>

                                                            <tr>
                                                                <td><?= $vehiculo['vehiculo_patente'];?></td>
                                                                <td><?= $vehiculo['vehiculo_marca_nombre'];?>, <?= $vehiculo['vehiculo_modelo_nombre'];?></td>
                                                                <td><?= $vehiculo['vehiculo_usuario_nombre'];?> <?= $vehiculo['vehiculo_usuario_apellido'];?>. <?= $vehiculo['vehiculo_usuario_dni'];?></td>
                                                                
                                                                <td>
                                                                    <a href="<?= base_url('vendedor/verVenderEstadia/' . $vehiculo['id']); ?>" class="btn btn-outline-taffy bt-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccionar">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
                                                                            <path d="M0 0h24v24H0V0z" fill="none"/>
                                                                            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8-8-8z"/>
                                                                        </svg>
                                                                    </a>

                                                                </td>
                                                                
                                                            </tr>
                                                    <?php endforeach; ?>
                                                    
                                                </tbody>

                                        </table>
                                    </div>
                                </div>
                    
    </div>

<?= $this->endSection() ?>