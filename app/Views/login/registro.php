<!doctype html>
<html lang="en">
<head>
    <title>Ingreso al sistema</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('asserts/css/login.css'); ?>">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">

</head>
<body style="background-image: url(<?= base_url('asserts/img/fondo_login.jpg'); ?>); background-size: cover">
<div class="main">

    <div class="row">

        <div class="container" style="margin-top: 2%">

            <div class="card mb-3">
                <form method="POST" action="<?= base_url('login/guardar'); ?>">
                    <div class="card-header uppercase">
                        <div class="caption" style="color: #1791ba">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                 class="bi bi-person-plus" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                <path fill-rule="evenodd"
                                      d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                            Registrar nuevo usuario
                        </div>

                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nombre completo</label>
                                <div class="col">
                                    <div class="input-group">
                                        <div class="col-6">

                                            <input type="text" name="nombre" class="form-control" placeholder="Nombre"
                                                   value="<?= old("nombre") ?>">

                                            <p style="color: rgb(232,74,103) "> <?= session('nombre'); ?></p>
                                        </div>

                                        <div class="col-6">
                                            <input type="text" name="apellido" class="form-control"
                                                   placeholder="Apellido" value="<?= old("apellido") ?>">
                                            <p style="color: rgb(232,74,103) "> <?= session('apellido'); ?></p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Email</label>
                                <div class="col">
                                    <div class="input-group col">
                                        <div class="input-group-prepend">
                                            <span style="border-color: #af69ee ;background-color:#af69ee"
                                                  class="input-group-text bg-orchid border-orchid text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                      d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                               value="<?= old("email") ?>">
                                    </div>
                                    <p style="color: rgb(232,74,103)"> <?= session('email'); ?></p>
                                </div>

                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">DNI</label>
                                <div class="col">
                                    <div class="input-group col">
                                        <input type="text" name="dni" class="form-control" placeholder="DNI"
                                               value="<?= old("dni") ?>">


                                    </div>
                                    <p style="color: rgb(232,74,103)"> <?= session('dni'); ?></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Contraseña</label>
                                <div class="col">
                                    <div class="input-group col">
                                        <input type="password" name="password" class="form-control"
                                               placeholder="Contraseña">


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

                                    </div>
                                    <p style="color: rgb(232,74,103)"> <?= session('confirm_password') ? "El campo contraseña es obligatorio" : "" ?></p>
                                    <p style="color: rgb(232,74,103)"> <?= session('confirm_password1') ?></p>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label class="col-md-3 col-form-label">Fecha de nacimiento</label>
                                <div class="col">
                                    <div class="input-group date">


                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-append">
                                            <span style="border-color: #af69ee ;background-color:#af69ee"
                                                  class="input-group-text bg-orchid border-orchid text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg>
                                            </span>
                                            </div>

                                            <input type="text" name="fecha_de_nacimiento" class="datepicker"
                                                   class="form-control calender-black" placeholder="dd/mm/aaaa"
                                                   style="width:90%;" value="<?= old("fecha de nacimiento") ?>">
                                        </div>
                                        <span class="form-text text-muted">Seleccionar fecha</span>
                                    </div>
                                    <p style="color: rgb(232,74,103)"> <?= session('fecha_de_nacimiento') ? "El campo fecha de nacimiento es obligatorio" : "" ?></p>
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


</body>


<script src="<?= base_url("js/siqtheme.js") ?>"></script>


<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>

<script>
    $(function () {
        $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true,
            todayHighlight: true
        });
    });
</script>


</html>