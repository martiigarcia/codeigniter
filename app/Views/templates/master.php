<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <meta name="description" content="Fee Bootstrap Admin Theme with Webpack and Laravel-Mix"/>
    <meta name="keywords"
          content="bootstrap, admin theme, admin dashboard, jquery, webpack, laravel-mix, template, responsive"/>
    <meta name="author" content="siQuang - Simon Nguyen"/>

    <title><?= $this->renderSection("titulo") ?></title>

    <link rel="stylesheet" href="<?= base_url("css/siqtheme.css") ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('asserts/DataTable/DataTables-1.11.3/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asserts/DataTable/datatables.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asserts/DataTables/datatables.min.css') ?>">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">

    <script>
        window.userData = {
            id: <?=session('id');?>

        }
    </script>

</head>

<body class="theme-dark" style="overflow: auto;">
<div class="grid-wrapper sidebar-bg bg1">

    <?= $this->include('layout/header') ?>



    <?php if (session('rol') == 1): ?>
        <?= $this->include('layout/sidebarLeft') ?>
    <?php else: ?>
        <?php if (session('rol') == 2): ?>
            <?= $this->include('layout/sidebarLeftVendedor') ?>
        <?php else: ?>
            <?php if (session('rol') == 3): ?>
                <?= $this->include('layout/sidebarLeftInspector') ?>
            <?php else: ?>
                <?php if (session('rol') == 4): ?>
                    <?= $this->include('layout/sidebarLeftCliente') ?>
                <?php else: ?>

                <?php endif ?>
            <?php endif ?>
        <?php endif ?>
    <?php endif ?>


    <div class="main">
        <?= $this->renderSection("content") ?>
    </div>

    <?= $this->include('layout/sidebarRight', $usuarioActual) ?>
    <?= $this->include('layout/footer') ?>


</div> <!-- END WRAPPER -->

<script src="<?= base_url("js/siqtheme.js") ?>"></script>

<script src="<?= base_url("asserts/js/registroVehiculos.js") ?>"></script>
<script src="<?= base_url("asserts/js/modificacionDeZonas.js") ?>"></script>
<script src="<?= base_url("asserts/js/emergente.js") ?>"></script>
<script src="<?= base_url("asserts/js/estadoEstadiaVehiculo.js") ?>"></script>


<script>
    var baseurl = '<?= base_url()?>'
</script>
<script>
    var mensaje = '<?= session('mensaje'); ?>'
</script>


<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
</svg>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    function mensajeEliminado(usuarioId, usuarioActual) {


        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })


        swalWithBootstrapButtons.fire({
            title: 'Estas seguro que desea eliminar al usuario?',
            'icon': 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then(result => {
            if (result.isConfirmed) {


                if (window.userData.id != usuarioId) {

                    swalWithBootstrapButtons.fire({
                        icon: 'success',
                        text: 'El usuario fue eliminado con éxito.',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true
                    }).then(result => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = "<?=base_url('administrador/eliminar')?>/" + usuarioId;

                        }
                    });
                } else {

                    swalWithBootstrapButtons.fire({
                        icon: 'error',
                        text: 'No se puede eliminar el usuario de la sesion actual.'
                    }).then();


                }

            } else {

                swalWithBootstrapButtons.fire({
                    icon: 'error',
                    text: 'No se eliminó al usuario.'
                }).then();

            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        if (mensaje !== '') {
            swal.fire({
                title: "¡Felicitaciones!",
                text: mensaje,
                icon: "success",
            });
        }
    })


</script>

<script src="<?= base_url('asserts/DataTable/datatables.js') ?>"></script>
<script src="<?= base_url('asserts/DataTable/DataTables-1.11.3/js/dataTables.bootstrap4.js') ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="<?= base_url('asserts/Js/tables.js') ?>"></script>

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

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<script>
    function verificarPago(valor, id_estadia) {
        console.log('entra');
        if (valor == 0) { //dejar pendiente
            window.location.href = "<?= base_url('cliente/desEstacionar'); ?>/" + id_estadia + "/" + valor;

        }
        if (valor == 1) {//pagar ahora
            console.log('entra');

            $.post(baseurl + "/cliente/desEstacionar/" + id_estadia + "/" + valor,

                function (data) {
                    console.log(data);
                    var existePaga = JSON.parse(data);

                    if (existePaga) {

                        swal.fire({
                            title: "¡Felicitaciones!",
                            text: "Los datos se guardaron con exito",
                            icon: "success",
                        }).then(result => {
                            if (result.isConfirmed)
                                window.location.href = baseurl;
                        });


                    } else {

                        swal.fire({
                            title: "Error",
                            text: "Su cuenta no dispone del saldo necesario para realizar el pago en este momento",
                            icon: "error",
                        }).then(result => {
                            if (result.isConfirmed)
                                window.location.href = baseurl;
                        });


                    }

                })
        }
    }

</script>

</body>

</html>