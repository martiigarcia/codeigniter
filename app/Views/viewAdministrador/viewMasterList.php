<?= $this->extend("templates/master")?>

<?= $this->section('titulo') ?>
    Listado de usuarios
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="main">

        <div class="container">

            <div class="table-responsive container">

                <table id="tableUsuarios" class="table table-striped table-bordered table-hover ">

                    <thead>
                    <tr>

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
                            <td><?= $usuario['dni']; ?></td>
                            <td><?= $usuario['nombre']; ?></td>
                            <td><?= $usuario['apellido']; ?></td>
                            <td><?= $usuario['fecha_de_nacimiento']; ?></td>
                            <td><?= $usuario['email']; ?></td>
                            <td><?= $usuario['rol_nombre']; ?> </td>
                            <td>
                                <a class="btn btn-outline-warning bt-sm"
                                   href="<?= base_url('administrador/editar/' . $usuario['id']); ?>"
                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar informacion">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                         class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd"
                                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>


                                <a class="btn btn-outline-imperial bt-sm"
                                   onclick="return mensajeEliminado(<?= $usuario['id'] ?>)" data-bs-toggle="tooltip"
                                   data-bs-placement="top" title="Eliminar usuario">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                         class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd"
                                              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>


                                <a class="btn btn-outline-info bt-sm"
                                   href="<?= base_url('administrador/verRestablecerPassword/' . $usuario['id']); ?>"
                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Restablecer contraseña">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" fill="currentColor"
                                         class="bi bi-key" viewBox="0 0 16 16">
                                        <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
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