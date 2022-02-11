<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
Cargar saldo a mi cuenta
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="main">

    <div class="row">

        <div class="col-lg-9">

            <div class="card mb-3">


                <div class="card-header uppercase">
                    <div class="caption">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                             viewBox="0 0 24 24" width="24px" fill="currentColor">
                            <g>
                                <path d="M0,0h24v24H0V0z" fill="none"/>
                            </g>
                            <g>
                                <path d="M20,4H4C2.89,4,2.01,4.89,2.01,6L2,18c0,1.11,0.89,2,2,2h5v-2H4v-6h18V6C22,4.89,21.11,4,20,4z M20,8H4V6h16V8z M14.93,19.17l-2.83-2.83l-1.41,1.41L14.93,22L22,14.93l-1.41-1.41L14.93,19.17z"/>
                            </g>
                        </svg>
                        Cargar saldo a mi cuenta
                    </div>

                </div>

                <ul class="list-group list-group-flush">

                    <li class="list-group-item">

                        <input type="text" name="valor" class="form-control" id="valor"
                               hidden="" value="<?= $valor ?>">

                        <?php if ($valor == 1): ?>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Numero de tarjeta</label>
                                <div class="col">
                                    <div class="input-group col">
                                        <input type="text" name="tarjeta" class="form-control" id="numero_tarjeta"
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
                                               id="fecha_vencimiento"
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
                                        <input type="password" name="code" class="form-control" id="codigo_seguridad"
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
                                        <select class="form-control" name="tarjeta" id="id_tarjeta">
                                            <option disabled selected=inicial value="">Seleccione una tarjeta segun el
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
                                    <input type="number" step="0.01" name="monto" class="form-control" id="monto"
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
                            <p style="color: #E84A67"> ATENCION! Cuando ingrese saldo a la cuenta, automaticamente se
                                pagaran las estadias que ya esten registradas con pagos pedientes</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer" id="div1">

                    <div class="row">

                        <div class="col text-center">
                            <button type="submit" onclick="return confirmarPasswordTarjetas()"
                                    class="btn btn-flat mb-1 btn-primary">Confirmar
                            </button>

                            <a href="<?= base_url() ?>"
                               class="btn btn-flat mb-1 btn-secondary"> Cancelar</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>


