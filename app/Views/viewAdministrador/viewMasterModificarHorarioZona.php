<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
    Modificar horario de zona
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <h2>Seleccione la zona</h2>

    <div class="col-lg-9">

        <div class="card mb-3">
            <form method="POST" action="<?= base_url('administrador/modificarHorarioZona'); ?>">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-group row">

                            <div class="col">
                                <div class="form-group">
                                    <label class="col-md-3 col-form-label">Zona</label>

                                    <select class="form-control" id="idZona" name="id_zona" onchange="cargarZonas()">

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
                            Modificar Horario
                        </button>

                        <div class="collapse" id="desplegable">


                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Inicio del Horario</label>
                                <div class="col">
                                    <input type="time" name="hora_inicio" class="form-control">
                                    <p style="color: rgb(232,74,103)"> <?= session('hora_inicio') ? 'Debe Completar este campo' : ''; ?></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Finalizacion del horas</label>
                                <div class="col">
                                    <input type="time" name="hora_fin" class="form-control">
                                    <p style="color: rgb(232,74,103)"> <?= session('hora_fin') ? 'Debe Completar este campo' : ''; ?></p>
                                </div>
                            </div>
                        </div>

                    </li>


                </ul>
                <div class="card-footer" style="color: rgb(232,74,103)">
                    <div class="row">

                        <div class="col text-center">
                            <p style="color: rgb(232,74,103)"> <?= session('mensaje'); ?></p>
                            <p style="color: rgb(232,74,103)"> <?= session('errorDeHora') ; ?></p>
                            <button type="submit" class="btn btn-flat mb-1 btn-primary">Confirmar</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <p style="color: rgb(0,155,125)"> <?= session('mensaje'); ?></p>
<?= $this->endSection() ?>