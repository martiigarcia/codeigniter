<div id="sidebar-right">
    <div class="sidebar-right-container">

        <ul class="nav nav-tabs" style="display: flex; justify-content: right;">
            <li class="nav-item" style="width: -webkit-fill-available; border-bottom:solid 1px grey; border-top: solid 1px grey">
                <a  class="nav-link active">Informacion</a>
            </li>
        </ul>

        <div class="tab-content">

            <div  class="tab-pane show active">
                <div class="pane-header">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                             class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd"
                                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        </a> Mi perfil
                    </h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                    </svg>
                    <span class="profile-user"><?= $usuarioActual['rol_nombre']; ?></span>
                    <span class="float-right"><a href="<?= base_url('login/salir'); ?>" class="text-carolina">Salir</a></span>
                </div>
                <div class="pane-body">
                    <div class="card bg-transparent mb-3">
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">
                                <?php if ($usuarioActual['rol_id'] == 4): ?>
                                    <span class="float-right"><a href="<?= base_url('home/verPerfil'); ?>"
                                                                 class="text-carolina">Ver perfil</a></span>
                                <?php else: ?><?php endif ?>

                                <h5 class="mb-3">Mi informacion</h5>
                                <form class="form-update-profile" method="POST"
                                      action="<?= base_url('home/actualizarPerfil'); ?>">
                                    <div class="form-group row">

                                        <input type="text" name="id" value="<?= $usuarioActual['id']; ?>" hidden=""
                                               class="form-control">

                                        <label class="col-form-label col-md-4">Nombre:</label>
                                        <div class="col">
                                            <input type="text" name="nombre" class="form-control-plaintext"
                                                   value="<?= $usuarioActual['nombre']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Apellido:</label>
                                        <div class="col">
                                            <input type="text" name="apellido" class="form-control-plaintext"
                                                   value="<?= $usuarioActual['apellido']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">DNI:</label>
                                        <div class="col">
                                            <input type="text" name="dni" class="form-control-plaintext"
                                                   value="<?= $usuarioActual['dni']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Email:</label>
                                        <div class="col">
                                            <input type="email" name="email" class="form-control-plaintext"
                                                   value="<?= $usuarioActual['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Fecha de nacimiento:</label>
                                        <div class="col">
                                            <input type="text" name="fecha_de_nacimiento" class="datepicker"
                                                   value="<?= $usuarioActual['fecha_de_nacimiento']; ?>">
                                        </div>
                                    </div>

                                    <div class="col offset-md-4 pl-2">
                                        <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                                    </div>
                                </form>

                            </li>

                            <li class="list-group-item">
                                <h5 class="mb-3">Configuracion</h5>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-4">Tema</label>
                                    <div class="btn-group col">

                                        <button type="button" class="btn switch-theme btn-light"
                                                id="botonTemaClaro" data-theme="theme-default">
                                            Claro
                                        </button>
                                        <button type="button" class="btn switch-theme btn-dark"
                                                id="botonTemaOscuro" data-theme="theme-dark">
                                            Oscuro
                                        </button>
                                    </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


<div id="overlay"></div>

 