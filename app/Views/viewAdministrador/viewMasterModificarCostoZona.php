<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
    Modificar costo de zona
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="col-lg-9">
        <h3>Modificar costo de zona</h3>

        <div class="card mb-3">
            <form method="POST" action="<?= base_url('administrador/modificarPrecioZona'); ?>">
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

                        <div <?= session('precio')? '':'class="collapse"';?> id="desplegable">


                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nuevo precio</label>
                                <div class="col">
                                    <input type="number" step="0.01" name="precio" class="form-control">
                                    <p style="color: rgb(232,74,103)"> <?= session('precio') ? 'Debe Completar este campo' : ''; ?></p>
                                </div>
                            </div>
                        </div>

                    </li>


                </ul>
                <div class="card-footer" style="color: rgb(232,74,103)">
                    <div class="row">

                        <div class="col text-center">
                            <p style="color: rgb(232,74,103)"> <?= session('mensaje'); ?></p>
                            <p style="color: rgb(232,74,103)"> <?= session('errorDeHora'); ?></p>
                            <button type="submit" class="btn btn-flat mb-1 btn-primary">Confirmar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection() ?>