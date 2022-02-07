<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
    Modificar usuario
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="main">

        <div class="row">
            <div class="col-lg-9">

                <div class="card mb-3">
                    <form method="POST" action="<?= base_url('administrador/guardarModificaciones'); ?>">
                        <div class="card-header uppercase">
                            <div class="caption">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                                Modificar usuario
                            </div>

                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nombre completo</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="col-6">
                                                <input type="text" name="id" value="<?= $usuario['id']; ?>" hidden=""
                                                       class="form-control">
                                                <input type="text" name="nombre" class="form-control"
                                                       placeholder="Nombre"
                                                       value="<?= $usuario['nombre']; ?> ">
                                                <p style="color: rgb(232,74,103) "> <?= session('nombre'); ?></p>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" name="apellido" class="form-control"
                                                       placeholder="Apellido" value="<?= $usuario['apellido']; ?>">
                                                <p style="color: rgb(232,74,103) "> <?= session('apellido'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Email</label>
                                    <div class="col">
                                        <div class="input-group col">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text bg-orchid border-orchid text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                      d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                                                </svg>
                                            </span>
                                            </div>
                                            <input type="email" name="email" class="form-control" placeholder="Email"
                                                   value="<?= $usuario['email']; ?>">
                                        </div>

                                        <p style="color: rgb(232,74,103)"> <?= session('email'); ?></p>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">DNI</label>
                                    <div class="col">
                                        <div class="input-group col">
                                            <input type="text" name="dni" class="form-control" placeholder="DNI"
                                                   value="<?= $usuario['dni']; ?>">


                                        </div>
                                        <p style="color: rgb(232,74,103)"> <?= session('dni'); ?></p>
                                    </div>
                                </div>


                                <div class="form-group row mt-3">
                                    <label class="col-md-3 col-form-label">Fecha de nacimiento</label>
                                    <div class="col">
                                        <div class="input-group date">
                                            <div class="input-group col">

                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-append">
                                                <span class="input-group-text bg-orchid border-orchid text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                     fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                                </svg> 
                                                </span>
                                                    </div>

                                                    <input type="text" name="fecha_de_nacimiento" class="datepicker"
                                                           class="form-control calender-black" placeholder="dd/mm/aaaa"
                                                           style="width:90%;"
                                                           value="<?= $usuario['fecha_de_nacimiento']; ?>">
                                                </div>
                                                <span class="form-text text-muted">Fecha de nacimiento establecida: <?= $usuario['fecha_de_nacimiento']; ?></span>

                                            </div>
                                        </div>
                                        <p style="color: rgb(232,74,103)"> <?= session('fecha_de_nacimiento') ? "El campo fecha de nacimiento es obligatorio" : "" ?></p>
                                    </div>

                                </div>

                            </li>


                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Rol</label>
                                    <div class="col">
                                        <div class="form-group col">

                                                <label>Seleccione un rol de la lista</label>

                                                <select class="form-control" name="id_rol"
                                                        value="<?= $usuario['rol_id']; ?>">

                                                    <option disabled selected=inicial>Roles:</option>
                                                    <?php foreach ($roles as $rol) : ?>

                                                        <option value=<?= $rol['id']; ?>> <?= $rol['nombre']; ?>
                                                            : <?= $rol['descripcion']; ?></option>
                                                    <?php endforeach; ?>

                                                </select>

                                                <p>Nombre del rol actual del usuario: <?= $usuario['rol_nombre'] ?></p>
                                                <p>Descripcion del rol actual del
                                                    usuario: <?= $usuario['rol_descripcion'] ?></p>

                                        </div>
                                        <p style="color: rgb(232,74,103)"> <?= session('id_rol') ? "El campo rol es obligatorio" : "" ?></p>
                                    </div>
                                </div>

                            </li>

                        </ul>

                        <div class="card-footer" id="div1">

                            <div class="row">

                                <div class="col text-center">
                                    <button type="submit" class="btn btn-flat mb-1 btn-primary">Confirmar</button>

                                    <a href="<?= base_url("administrador/listadoUsuarios") ?>"
                                       class="btn btn-flat mb-1 btn-secondary">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

<?= $this->endSection() ?>