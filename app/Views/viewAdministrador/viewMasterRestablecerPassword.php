<?= $this->extend("templates/master") ?>

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
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                     viewBox="0 0 24 24" width="24px" fill="currentColor">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none"/>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M2,17h20v2H2V17z M3.15,12.95L4,11.47l0.85,1.48l1.3-0.75L5.3,10.72H7v-1.5H5.3l0.85-1.47L4.85,7L4,8.47L3.15,7l-1.3,0.75 L2.7,9.22H1v1.5h1.7L1.85,12.2L3.15,12.95z M9.85,12.2l1.3,0.75L12,11.47l0.85,1.48l1.3-0.75l-0.85-1.48H15v-1.5h-1.7l0.85-1.47 L12.85,7L12,8.47L11.15,7l-1.3,0.75l0.85,1.47H9v1.5h1.7L9.85,12.2z M23,9.22h-1.7l0.85-1.47L20.85,7L20,8.47L19.15,7l-1.3,0.75 l0.85,1.47H17v1.5h1.7l-0.85,1.48l1.3,0.75L20,11.47l0.85,1.48l1.3-0.75l-0.85-1.48H23V9.22z"/>
                                        </g>
                                    </g>
                                </svg>
                                Restablecer contraseña
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
                                                <span class="input-group-text bg-danger"><span class="text-light">Obligatorio</span>
                                            </div>

                                        </div>
                                        <p style="color: rgb(232,74,103)"> <?= session('password') ? "El campo contraseña es obligatorio" : "" ?></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Confirmar Contraseña</label>
                                    <div class="col">
                                        <div class="input-group col">
                                            <input type="password" name="confirm_password" class="form-control"
                                                   placeholder="Confirmar Contraseña">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-danger"><span class="text-light">Obligatorio</span>
                                            </div>

                                        </div>
                                        <p style="color: rgb(232,74,103)"> <?= session('confirm_password') ? "El campo contraseña es obligatorio" : "" ?></p>
                                        <p style="color: rgb(232,74,103)"> <?= session('confirm_password1') ?></p>
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