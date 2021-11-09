<?= $this->extend("templates\clientes\masterCliente")?>
<?= $this->section('content') ?>

<div class="main">
               

                <div class="container">
        
                        <div class="table-responsive container">

                            <table id="tableUsuarios" class="table table-striped table-bordered table-hover ">

                                    <thead>
                                        <tr >

                                            <th>Patente del vehiculo</th>
                                            <th>Fecha inicio</th>
                                            <th>Fecha fin</th>
                                            <th>Horas estacionado</th>
                                            <th>Zona</th>
                                            <th>Monto</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php foreach ($estadiasPendientes as $e) : ?>

                                            
                                            <tr>
                                                <td><?= $e['vehiculo_patente']; ?></td>
                                                <td><?= $e['fecha_inicio'];; ?></td>
                                                <td><?= $e['fecha_fin'];; ?></td>
                                                <td><?= $e['cantidad_horas']; ?></td>
                                                <td><?= $e['zona_nombre']; ?></td>
                                                <td><?= $e['monto']; ?></td>
                                                
                                                <td>
                                                
                                                <a href="<?= base_url('cliente/PagarEstadiasPendientes/' . $e['id']); ?>"
                                                    class="btn btn-outline-warning bt-sm      ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                                        <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                                                    </svg></a> 


                                                </td>
                                            </tr>
                                        
                                        <?php endforeach; ?>
                                        
                                    </tbody>

                            </table>
                        </div>
                    </div>
        
    </div>

<?= $this->endSection() ?>