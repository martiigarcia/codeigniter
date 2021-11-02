<!doctype html>
<html lang="en">
<head>
    <title>Login 08</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('asserts/css/login.css'); ?>">
</head>
<body>
<section class="ftco-section">

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-user-o"></span>
                    </div>
                    <h3 class="text-center mb-4">¿Ya se encuentra registrado?</h3>
                    <form method="POST" class="needs-validation <?=(session('mensajeLogin'))? ' was-validated':''?>
                            " novalidate action="<?= base_url('login/ingresar'); ?> ">

                            <div class="form-group">
                                <input type="text" name="email" class="form-control rounded-left <?=(session('mensajeLogin'))? 'is-invalid':''?>"
                                       placeholder="Usuario" required
                                       value="<?= old("email") ?>">
                            </div>

                        <div class="form-group d-flex">
                            <input name="password" type="password" class="form-control rounded-left <?=(session('mensajeLogin'))? 'is-invalid':''?>"
                                   placeholder="Contraseña" required>
                        </div>
                          <p style="color: rgb(215,48,56)"> <?= session('mensajeLogin'); ?></p>

                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary">Recordarme
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="#">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js+bootstrap.min.js+main.js.pagespeed.jc.wRxug4_Avg.js"></script>
<script>eval(mod_pagespeed_mGxpOPO3_V);</script>
<script>eval(mod_pagespeed_hRdA8ZBafG);</script>
<script>eval(mod_pagespeed_jDGrFP5nZp);</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js"
        data-cf-beacon='{"rayId":"6a474f11d3a9d2b8","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.10.0","si":100}'></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js"
        data-cf-beacon='{"rayId":"6a474f119a8ed2b8","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.10.0","si":100}'></script>
</body>
</html>