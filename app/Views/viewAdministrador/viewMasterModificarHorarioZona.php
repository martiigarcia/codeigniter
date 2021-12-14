<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
    Modificar horario de zona
<?= $this->endSection() ?>

<?= $this->section('content') ?>


    <div class="col-lg-9">


        <div class="card mb-3">
            <form method="POST" action="<?= base_url('administrador/modificarHorarioZona'); ?>">
                <div class="card-header uppercase">
                    <div class="caption">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                             class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            <path fill-rule="evenodd"
                                  d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Modificar horario de una zona
                    </div>

                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-group row">

                            <div class="form-group col">
                                <label class="col-md-3 col-form-label">Zona</label>
                                <div class="col">
                                    <select class="form-control" id="idZona" name="id_zona"
                                            onchange="cargarHorasZonas()">

                                        <option disabled selected=inicial>Zonas:</option>
                                        <?php foreach ($zonas as $zona) : ?>

                                            <option value=<?= $zona['id']; ?>><?= $zona['nombre']; ?>
                                            </option>

                                        <?php endforeach; ?>
                                    </select>
                                    <p style="color: rgb(232,74,103)"> <?= session('id_zona') ? 'Debe Completar este campo' : ''; ?></p>
                                </div>
                            </div>

                            <div class="form-group col">
                                <label class="col-md-3 col-form-label">Horarios</label>

                                <div class="col">
                                    <select class="form-control" name="historial_zona" id="hZona">
                                        <option disabled selected=inicial>Primero seleccione una zona</option>
                                    </select>
                                    <p style="color: rgb(232,74,103)"> <?= session('historial_zona') ? 'Debe Completar este campo' : ''; ?></p>
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

                        <div <?= (session('hora_inicio') || session('hora_fin')) ? '' : 'class="collapse"'; ?>
                                id="desplegable">


                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Inicio del horario</label>
                                <div class="col">
                                    <input type="time" name="hora_inicio" class="form-control">
                                    <p style="color: rgb(232,74,103)"> <?= session('hora_inicio') ? 'Debe Completar este campo' : ''; ?></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Finalizacion del horario</label>
                                <div class="col">
                                    <input type="time" name="hora_fin" class="form-control">
                                    <p style="color: rgb(232,74,103)"> <?= session('hora_fin') ? 'Debe Completar este campo' : ''; ?></p>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col text-center">
                                    <p style="color: rgb(232,74,103)"> <?= session('mensaje'); ?></p>
                                    <p style="color: rgb(232,74,103)"> <?= session('errorDeHora'); ?></p>
                                    <button type="submit" class="btn btn-flat mb-1 btn-primary">Modificar</button>
                                </div>
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
    <p style="color: rgb(0,155,125)"> <?= session('mensaje'); ?></p>
<?= $this->endSection() ?>