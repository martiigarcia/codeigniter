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
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                             viewBox="0 0 24 24" width="24px" fill="currentColor">
                            <g>
                                <rect fill="none" height="24" width="24"/>
                            </g>
                            <g>
                                <g>
                                    <polygon points="10,8 10,14 14.7,16.9 15.5,15.7 11.5,13.3 11.5,8"/>
                                    <path d="M17.92,12c0.05,0.33,0.08,0.66,0.08,1c0,3.9-3.1,7-7,7s-7-3.1-7-7c0-3.9,3.1-7,7-7c0.7,0,1.37,0.1,2,0.29V4.23 C12.36,4.08,11.69,4,11,4c-5,0-9,4-9,9s4,9,9,9s9-4,9-9c0-0.34-0.02-0.67-0.06-1H17.92z"/>
                                    <polygon points="20,5 20,2 18,2 18,5 15,5 15,7 18,7 18,10 20,10 20,7 23,7 23,5"/>
                                </g>
                            </g>
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