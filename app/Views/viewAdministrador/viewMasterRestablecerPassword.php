<?= $this->extend("templates/master")?>

<?= $this->section('titulo') ?>
    Restablecer contraseña
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="main">

        <div class="row">

            <div class="col-lg-9">

                <div class="card mb-3">
                    <form method="POST" action="<?= base_url('administrador/restablecerPassword'); ?>">
                        <div class="card-header uppercase">
                            <div class="caption">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                     class="bi bi-person-plus" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    <path fill-rule="evenodd"
                                          d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                Registrar nuevo usuario
                            </div>

                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Contraseña</label>
                                    <div class="col">
                                        <div class="input-group col">

                                            <input type="text" name="id" class="form-control" placeholder="Contraseña"
                                                   value="<?= $usuario['id']; ?>" hidden="">

                                            <input type="password" name="password" class="form-control"
                                                   placeholder="Contraseña">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-danger"><span class="text-light">Obligatorio</span></span>
                                            </div>
                                        </div>
                                        <p style="color: rgb(232,74,103)"> <?= session('password'); ?></p>
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