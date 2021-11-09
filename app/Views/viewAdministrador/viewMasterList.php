<?= $this->extend("templates/administrador/masterAdmin")?>
<?= $this->section('content') ?>

    <div class="main">
                
                <div class="container">
        
                        <div class="table-responsive container">

                            <table id="tableUsuarios" class="table table-striped table-bordered table-hover ">

                                    <thead>
                                        <tr >

                                            <th>DNI</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Fecha de nacimiento</th>
                                            <th>Email</th>
                                            <th>Rol</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($usuarioInfo as $usuario) : ?>

                                            <tr>
                                                <td><?= $usuario['DNI']; ?></td>
                                                <td><?= $usuario['nombre']; ?></td>
                                                <td><?= $usuario['apellido']; ?></td>
                                                <td><?= $usuario['fecha_de_nacimiento']; ?></td>
                                                <td><?= $usuario['email']; ?></td>
                                                <td><?= $usuario['rol_nombre']; ?> </td>
                                                <td>
                                                    <a href="<?= base_url('home/editar/' . $usuario['id']); ?>"
                                                    class="btn btn-outline-warning bt-sm      ">
                                                        <i class="bi bi-pencil-square"></i></a>

                                                    <a style="margin-left:10px"
                                                    onclick="return mensajeEliminado('<?= base_url('home/eliminar/' . $usuario['id']); ?>')"
                                                    class="btn btn-outline-danger bt-sm  ">
                                                        <i class="bi bi-trash"></i>
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