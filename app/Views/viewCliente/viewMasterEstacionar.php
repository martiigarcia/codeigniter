<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
    Estacionar
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="main">

        <div class="row">

            <div class="col-lg-9">

                <div class="card mb-3">
                    <form method="POST" action="<?= base_url('cliente/estacionar'); ?>">
                        <div class="card-header uppercase">
                            <div class="caption">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                     fill="currentColor">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.08 3.11H5.77L6.85 7zM19 17H5v-5h14v5z"/>
                                    <circle cx="7.5" cy="14.5" r="1.5"/>
                                    <circle cx="16.5" cy="14.5" r="1.5"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 20 20" width="20px"
                                     fill="currentColor">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                </svg>
                                Estacionar
                            </div>

                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group row">

                                    <label class="col-md-3 col-form-label">Vehiculo</label>
                                    <div class="col">
                                        <div class="form-group">

                                            <label>Seleccione un vehiculo</label>
                                            <select class="form-control" name="dominio_vehiculo">

                                                <option disabled selected=inicial>Vehiculos bajo dominio:</option>
                                                <?php if (!empty($dominio)): ?>
                                                    <?php foreach ($dominio as $d) : ?>

                                                        <option value=<?= $d['id']; ?>>
                                                            <?= $d['vehiculo_patente']; ?>
                                                            --> <?= $d['vehiculo_marca_nombre']; ?>
                                                            , <?= $d['vehiculo_modelo_nombre']; ?>
                                                        </option>

                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    Todos sus vehiculos estan estacionados
                                                <?php endif ?>
                                            </select>
                                            <p style="color: rgb(232,74,103)"> <?= session('dominio_vehiculo') ? 'Debe Completar este campo' : '' ?></p>
                                        </div>

                                        <div class="form-group">

                                            <label>Seleccione una zona</label>
                                            <select class="form-control" name="id_zona">

                                                <option disabled selected=inicial>Zonas:</option>
                                                <?php foreach ($zonas as $zona) : ?>

                                                    <option value=<?= $zona['id']; ?>><?= $zona['nombre']; ?>
                                                        , <?= $zona['descripcion']; ?>
                                                    </option>

                                                <?php endforeach; ?>
                                            </select>
                                            <p style="color: rgb(232,74,103)"> <?= session('id_zona') ? 'Debe Completar este campo' : ''; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <a type="button" class="btn btn-primary"
                                               href="<?= base_url('cliente/verRegistroVehiculo') ?>">Registrar nuevo
                                                vehiculo
                                            </a>

                                        </div>
                                    </div>
                                </div>

                            </li>

                            <li class="list-group-item">
                                <p style="color: rgb(232,74,103)"> <?= session('errorDeCantidadDeHoras'); ?></p>
                                <button class="btn btn-flat mb-1 btn-primary" type="button" data-toggle="collapse"
                                        data-target="#desplegable" aria-expanded="false" aria-controls="desplegable">
                                    Estadia definida
                                </button>

                                <div class="collapse" id="desplegable">
                                     


                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Cantidad de horas</label>
                                        <div class="col">
                                            <input type="time" name="cantidad_horas" class="form-control">

                                        </div>
                                    </div>
                                </div>

                            </li>


                        </ul>

                        <div class="card-footer" id="div1">

                            <p style="color: rgb(232,74,103)"> <?= session('errorHoraDeInicio'); ?></p>

                            <div class="row">

                                <div class="col text-center">

                                    <form method="POST"  action="<?= base_url('cliente/estacionar'); ?>">
                                        <div class="form-group" id="definirPago">
                                            <button type="button" data-color="dark"
                                                    class="btn btn-dark exampleColorModal"
                                                    data-toggle="modal"
                                                    id="botonModal"
                                                    data-target="#comenzarEstadiaModalToolPop">
                                                Comenzar estadia
                                            </button>


                                            <div class="modal fade modal-dark show" id="comenzarEstadiaModalToolPop"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalToolPopTitle" style="display: none;"
                                                 aria-hidden="true"
                                                 aria-labelledby="exampleModalLabel" aria-modal="true"
                                                 style="display: block;">

                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalToolPopTitle">
                                                                ¿Desea pagar su estacionamiento en este momento?
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <label class="col col-form-label">Su estadia esta por
                                                                comenzar!</label>

                                                        </div>
                                                        <div class="modal-footer" style="display: initial">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                    data-dismiss="modal">Dejar pendiente
                                                            </button>
                                                            <a type="submit" class="btn btn-outline-primary">Pagar ahora
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-flat mb-1 btn-primary">Comenzar estadia
                                        </button>

                                        <a href="<?= base_url() ?>" class="btn btn-flat mb-1 btn-secondary">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


<?= $this->endSection() ?>