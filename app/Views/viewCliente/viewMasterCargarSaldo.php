<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
Cargar saldo a mi cuenta
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="main">

    <div class="row">

        <div class="col-lg-9">

            <div class="card mb-3">
                <form method="POST" action="<?= base_url('cliente/cargarSaldo'); ?>">
                    <div class="card-header uppercase">
                        <div class="caption">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                 class="bi bi-person-plus" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                <path fill-rule="evenodd"
                                      d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                            Cargar saldo a mi cuenta
                        </div>

                    </div>

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">

                            <input type="text" name="valor" class="form-control"
                                   hidden="" value="<?= $valor ?>">

                            <?php if ($valor == 1): ?>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Numero de tarjeta</label>
                                    <div class="col">
                                        <div class="input-group col">
                                            <input type="text" name="tarjeta" class="form-control"
                                                   placeholder="Numero de tarjeta"
                                                   value="<?= old("tarjeta") ?>">
                                        </div>
                                        <p style="color: rgb(232,74,103)"> <?= session('tarjeta'); ?></p>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Fecha de vencimiento</label>
                                    <div class="col">
                                        <div class="input-group col">
                                            <input type="text" name="fecha_vencimiento" class="datepicker"
                                                   class="form-control calender-black" placeholder="dd/mm/aaaa"
                                                   style="width:90%;" value="<?= old("fecha_vencimiento") ?>">
                                        </div>
                                        <p style="color: rgb(232,74,103)"> <?= session('fecha_vencimiento'); ?></p>
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Codigo de seguridad</label>
                                    <div class="col">
                                        <div class="input-group col">
                                            <input type="password" name="code" class="form-control"
                                                   placeholder="Codigo de seguridad"
                                                   value="<?= old("code") ?>">
                                        </div>
                                        <p style="color: rgb(232,74,103)"> <?= session('code'); ?></p>
                                    </div>
                                </div>
                            <?php else: ?>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Tarjeta</label>
                                    <div class="col">
                                        <div class="input-group col">
                                            <select class="form-control" name="tarjeta">
                                                <option disabled selected=inicial>Seleccione una tarjeta segun el
                                                    numero:
                                                </option>
                                                <?php foreach ($tarjetas as $tarjeta) : ?>

                                                    <option value=<?= $tarjeta['id']; ?>> <?= $tarjeta['numero']; ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <p style="color: rgb(232,74,103)"> <?= session('tarjeta'); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Saldo a ingresar en la cuenta</label>
                                <div class="col">
                                    <div class="input-group col">
                                        <input type="number" step="0.01" name="monto" class="form-control"
                                               placeholder="Monto" value="<?= old("monto") ?>">
                                    </div>
                                    <p style="color: rgb(232,74,103)"> <?= session('monto') ? "El valor del monto es obligatorio" : "" ?></p>
                                </div>
                            </div>


                        </li>

                    </ul>

                    <div class="card-footer" id="div1">

                        <div class="row">

                            <div class="col text-center">
                                <button type="submit" class="btn btn-flat mb-1 btn-primary">Confirmar</button>

                                <a href="<?= base_url() ?>"
                                   class="btn btn-flat mb-1 btn-secondary"> Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

<p style="color: rgb(0,155,125)"> <?= session('mensaje'); ?></p>
<?= $this->endSection() ?>


