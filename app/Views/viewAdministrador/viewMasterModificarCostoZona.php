<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
    Modificar costo de zona
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="col-lg-9">

        <div class="card mb-3">
            <form method="POST" action="<?= base_url('administrador/modificarPrecioZona'); ?>">
                <div class="card-header uppercase">
                    <div class="caption">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                             fill="currentColor">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                        </svg>
                        Modificar costo de una zona
                    </div>

                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-group row">

                            <div class="col">
                                <div class="form-group">
                                    <label class="col-md-3 col-form-label">Zona</label>

                                    <select class="form-control" id="idZona" name="id_zona"
                                            onchange="cargarHoraYPrecioZonas()">

                                        <option disabled selected=inicial>Zonas:</option>
                                        <?php foreach ($zonas as $zona) : ?>

                                            <option value=<?= $zona['id']; ?>><?= $zona['nombre']; ?>
                                            </option>

                                        <?php endforeach; ?>
                                    </select>
                                    <p style="color: rgb(232,74,103)"> <?= session('id_zona') ? 'Debe Completar este campo' : ''; ?></p>
                                </div>

                                <label class="col-md-3 col-form-label">Horarios</label>
                                <div class="form-group row">
                                    <div class="col">
                                        <select class="form-control" name="historial_zona" id="hZona">
                                            <option disabled selected=inicial>Primero seleccione una Zona</option>
                                        </select>
                                        <p style="color: rgb(232,74,103)"> <?= session('historial_zona') ? 'Debe Completar este campo' : ''; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </li>

                    <li class="list-group-item">
                        <p style="color: rgb(232,74,103)"> <?= session('errorDeCantidadDeHoras'); ?></p>
                        <button class="btn btn-flat mb-1 btn-primary" type="button" data-toggle="collapse"
                                data-target="#desplegable" aria-expanded="false" aria-controls="desplegable">
                            Modificar Precio
                        </button>

                        <div <?= session('precio') ? '' : 'class="collapse"'; ?> id="desplegable">


                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nuevo precio</label>
                                <div class="col">
                                    <input type="number" step="0.01" name="precio" class="form-control">
                                    <p style="color: rgb(232,74,103)"> <?= session('precio') ? 'Debe Completar este campo' : ''; ?></p>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col text-center">
                                    <p style="color: rgb(232,74,103)"> <?= session('mensaje'); ?></p>
                                    <p style="color: rgb(232,74,103)"> <?= session('errorDeHora'); ?></p>
                                    <button type="submit" class="btn btn-flat mb-1 btn-primary">Modificar</button>
                                </div>
                            </div>

                    </li>


                </ul>
                <div class="card-footer" style="color: rgb(232,74,103)">

                </div>
        </div>
        </form>
    </div>
    </div>
<?= $this->endSection() ?>