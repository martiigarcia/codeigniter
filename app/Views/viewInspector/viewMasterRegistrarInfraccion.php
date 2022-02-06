<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
    Inicio
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="main">

        <div class="row">

            <div class="col-lg-9">

                <div class="card mb-3">
                    <form method="POST" action="<?= base_url('inspector/registrarInfraccion/'); ?>">
                        <div class="card-header uppercase">
                            <div class="caption">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                     viewBox="0 0 24 24" width="24px" fill="currentColor">
                                    <g>
                                        <rect fill="none" height="24" width="24"/>
                                    </g>
                                    <g>
                                        <g/>
                                        <g>
                                            <path d="M17,19.22H5V7h7V5H5C3.9,5,3,5.9,3,7v12c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2v-7h-2V19.22z"/>
                                            <path d="M19,2h-2v3h-3c0.01,0.01,0,2,0,2h3v2.99c0.01,0.01,2,0,2,0V7h3V5h-3V2z"/>
                                            <rect height="2" width="8" x="7" y="9"/>
                                            <polygon points="7,12 7,14 15,14 15,12 12,12"/>
                                            <rect height="2" width="8" x="7" y="15"/>
                                        </g>
                                    </g>
                                </svg>
                                Registrar infraccion
                            </div>

                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group row">

                                    <div class="col-md-10">
                                        <label class="col-md-10 col-form-label">Direccion donde se
                                            encontraba estacionado el
                                            vehiculo en infraccion</label>
                                        <div class="input-group">
                                            <div class="col-6">

                                                <input type="text" name="vehiculo" value="<?= $vehiculo; ?>" hidden=""
                                                       class="form-control">

                                                <input type="text" name="calle" class="form-control"
                                                       placeholder="Nombre de la calle"
                                                       value="<?= old("calle") ?>">
                                                <p style="color: rgb(232,74,103)"> <?= session('calle'); ?></p>
                                            </div>
                                            <div class="col-6">

                                                <input type="number" name="altura" class="form-control"
                                                       placeholder="Altura"
                                                       value="<?= old("altura") ?>">
                                                <p style="color: rgb(232,74,103)"> <?= session('altura'); ?></p>
                                            </div>
                                        </div>


                                    </div>
                                </div>


                            </li>

                            <li class="list-group-item">
                                <div class="form-group row">
                                    <div class="col-md-10">

                                        <label class="col-md-10 col-form-label">Seleccione la zona en la que se
                                            encontraba el vehiculo en infraccion</label>

                                        <div class="input-group">
                                            <div class="col">
                                                <select class="form-control" id="idZona" name="id_zona"
                                                        onchange="cargarHorasZonasParaMultas()">

                                                    <option disabled selected=inicial>Zonas:</option>
                                                    <?php foreach ($zonas as $zona) : ?>

                                                        <option value=<?= $zona['id']; ?>><?= $zona['nombre']; ?>
                                                        </option>

                                                    <?php endforeach; ?>
                                                </select>
                                                <p style="color: rgb(232,74,103)"> <?= session('id_zona') ? 'Debe completar este campo' : ''; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <label class="col-md-12 col-form-label">Seleccione el horario de la zona en el
                                            que se encontraba estacionado el vehiculo en infraccion</label>
                                        <div class="input-group">
                                            <div class="col">
                                                <select class="form-control" name="historial_zona" id="hZona">
                                                    <option disabled selected=inicial>Primero seleccione una Zona
                                                    </option>
                                                </select>
                                                <p style="color: rgb(232,74,103)"> <?= session('historial_zona') ? 'Debe completar este campo' : ''; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </li>


                        </ul>

                        <div class="card-footer" style="color: rgb(232,74,103)">
                            <div class="row">

                                <div class="col text-center">
                                    <p style="color: rgb(232,74,103)"> <?= session('mensaje'); ?></p>
                                    <button type="submit" class="btn btn-flat mb-1 btn-primary">Registrar infraccion
                                    </button>

                                    <a href="<?= base_url('/home') ?>" class="btn btn-flat mb-1 btn-secondary">
                                        Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>