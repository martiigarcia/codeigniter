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
    <!-- <link rel="stylesheet" href="<?= base_url('asserts/DataTables/datatables.min.css') ?>">-->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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


</div>

<script src="<?= base_url("js/siqtheme.js") ?>"></script>

<script src="<?= base_url("asserts/js/registroVehiculos.js") ?>"></script>
<script src="<?= base_url("asserts/js/modificacionDeZonas.js") ?>"></script>
<script src="<?= base_url("asserts/js/emergente.js") ?>"></script>
<script src="<?= base_url("asserts/js/estadoEstadiaVehiculo.js") ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
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
    var baseurl = '<?= base_url()?>'
    var mensaje = '<?= session('mensaje'); ?>'
    var error = '<?= session('error'); ?>'
    var mensajePagar = '<?= session('mensajePagar'); ?>'
    let infoEstadia = '<?= session('estadia'); ?>'
    var errorCarga = '<?= session('errorCarga'); ?>'
</script>

<script>
    $(document).ready(function () {
            if (error !== '') {
                swal.fire({
                    title: "Algo salio mal",
                    text: error,
                    icon: "error",
                })

            } else if (mensaje !== '') {
                swal.fire({
                    title: "¡Felicitaciones!",
                    text: mensaje,
                    icon: "success",
                });
            }

        }
    )
    // if (mensaje !== '') {
    //     swal.fire({
    //         title: "¡Felicitaciones!",
    //         text: mensaje,
    //         icon: "success",
    //     });
    // } else if (error !== '') {
    //     swal.fire({
    //         title: "Algo salio mal",
    //         text: error,
    //         icon: "error",
    //     }).then(result => {
    //         if (result.isConfirmed) {
    //             window.location.href = baseurl;
    //         }
    //     });


</script>

<script>
    $(document).ready(function () {
            if (errorCarga !== '') {
                swal.fire({
                    title: "Algo salio mal",
                    text: errorCarga,
                    icon: "error",
                }).then(result => {
                    if (result.isConfirmed) {

                    }
                });
            }
        }
    )
</script>

<script>
    $(document).ready(function () {

            if (mensajePagar !== '') {
                //estacionar aca
                let id_estadia;
                console.log("a");
                $.post(baseurl + "/cliente/estacionarYObtenerId/" + infoEstadia,
                    function (data) {
                        console.log("b");
                        id_estadia = JSON.parse(data);
                        console.log("INFOR: " + id_estadia);
                        console.log("c");


                        //id_estadia = info;
                        console.log("d");
                        console.log("ID ESTADIA: " + id_estadia);

                        swal.fire({
                            title: "Su estadia se registro correctamente",
                            text: mensajePagar,
                            icon: "info",
                            showConfirmButton: true,
                            confirmButtonText: "Pagar ahora",
                            showCancelButton: true,
                            cancelButtonText: "Dejar pendiente"
                        }).then(result => {
                                if (result.isConfirmed) {

                                    console.log(id_estadia);
                                    window.location.href = "<?= base_url('cliente/pagarEstadiasPendientes'); ?>/" + id_estadia + "/" + 1;

                                } else {
                                    window.location.href = "<?= base_url('cliente/dejarPendiente'); ?>/" + id_estadia;
                                    swal.fire({
                                        title: "Importante",
                                        text: "La estadia quedo en estado de 'pago pendiente'. Para abonarlo vaya a la seccion 'Mis estadias pendientes' y seleccionela para pagar",
                                        icon: "info",
                                    }).then(result => {
                                        window.location.href = baseurl;
                                    });
                                }

                            }
                        );
                    });
            }
        }
    )
</script>


<script>
    function mensajeEliminado(usuarioId) {


        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })


        swalWithBootstrapButtons.fire({
            title: '¿Esta seguro que desea eliminar al usuario?',
            'icon': 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then(result => {
            if (result.isConfirmed) {


                if (window.userData.id != usuarioId) {

                    window.location.href = "<?=base_url('administrador/eliminar')?>/" + usuarioId;

                    //swalWithBootstrapButtons.fire({
                    //    icon: 'success',
                    //    text: 'Procesando la operacion . . . ',
                    //    showConfirmButton: false,
                    //    timer: 1500,
                    //    timerProgressBar: true
                    //}).then(result => {
                    //    if (result.dismiss === Swal.DismissReason.timer) {
                    //        window.location.href = "<?//=base_url('administrador/eliminar')?>///" + usuarioId;
                    //
                    //    }
                    //});
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
    function estacionamineto() {

        $.post(baseurl + "/cliente/obtenerDominiosDeUsuario/",
            function (data) {
                var info = JSON.parse(data);
                if (info) {
                    swal.fire({
                        title: "Error!",
                        text: "No existen vehiculos registrados con su usuario disponibles para estacionar",
                        icon: "error",
                    });
                } else {
                    window.location.href = "<?= base_url('cliente/verEstacionar'); ?>"
                }
            });
    }
</script>

<script>
    function desEstacionamineto(id_estadia) {

        swal.fire({
            title: "Finalizar estadia",
            text: "¿Desea finalizar su estadia en este momento?",
            icon: "question",
            showConfirmButton: true,
            confirmButtonText: "Finalizar",
            showCancelButton: true,
            cancelButtonText: "Calcelar"
        }).then(result => {
            if (result.isConfirmed) {

                $.post(baseurl + "/cliente/finalizarEstadia/" + id_estadia,
                    function (data) {

                        swal.fire({
                            title: "Pagar",
                            text: "Su estadia acaba de finalizar existosamente ¿Desea abonar el costo de la estadia en este momento?",
                            icon: "question",
                            showConfirmButton: true,
                            confirmButtonText: "Pagar ahora",
                            showCancelButton: true,
                            cancelButtonText: "Dejar pendiente"
                        }).then(result => {

                                if (result.isConfirmed) {

                                    $.post(baseurl + "/cliente/pagarAhora/" + id_estadia,
                                        function (data2) {

                                            var existePaga = JSON.parse(data2);

                                            if (existePaga) {

                                                swal.fire({
                                                    title: "¡Felicitaciones!",
                                                    text: "Los datos se guardaron con exito",
                                                    icon: "success",
                                                    timer: 1500,
                                                    timerProgressBar: true
                                                }).then(result => {
                                                    if (result.dismiss === Swal.DismissReason.timer) {
                                                        window.location.href = baseurl;
                                                    }
                                                    if (result.isConfirmed) {
                                                        window.location.href = baseurl;
                                                    }
                                                });

                                            } else {


                                                swal.fire({
                                                    title: "Error",
                                                    text: "Su cuenta no dispone del saldo necesario para realizar el pago en este momento. La estadia quedo en estado de 'pago pendiente'. Para abonarlo vaya a la seccion 'Mis estadias pendientes' y seleccionela para pagar",
                                                    icon: "error",
                                                }).then(result => {
                                                    window.location.href = baseurl;
                                                });
                                            }
                                        });
                                } else {
                                    window.location.href = "<?= base_url('cliente/dejarPendiente'); ?>/" + id_estadia;

                                    swal.fire({
                                        title: "Importante",
                                        text: "La estadia quedo en estado de 'pago pendiente'. Para abonarlo vaya a la seccion 'Mis estadias pendientes' y seleccionela para pagar",
                                        icon: "info",
                                    }).then(result => {
                                        window.location.href = baseurl;
                                    });
                                }
                            }
                        );
                    });
            } else {
                window.location.href = baseurl;
            }

        });
    }
</script>

<script>
    function definirTarjeta(valor) {
        window.location.href = "<?= base_url('cliente/verCargarSaldo'); ?>/" + valor;
    }
</script>

<script>
    function confirmarPasswordTarjetas() {

        (async () => {

            const {value: password} = await swal.fire({
                title: 'Confirmar contraseña',
                input: 'password',
                inputLabel: 'Ingrese la contraseña de su cuenta para continuar',
                inputPlaceholder: 'Contraseña',
                inputAttributes: {
                    maxlength: 10,
                    autocapitalize: 'off',
                    autocorrect: 'off'
                }
            })

            if (password) {
                $.post(baseurl + "/cliente/confirmarPassword/" + password,
                    function (data) {
                        var info = JSON.parse(data);

                        if (info) {//si es verdadero es porque las contraseñas coinciden

                            var valor = document.getElementById("valor").value;
                            var monto = document.getElementById("monto").value;
                            var id_tarjeta = null, numero_tarjeta = null, codigo_seguridad = null, fecha = null;

                            if (valor === "0") {

                                id_tarjeta = document.getElementById("id_tarjeta").value;

                            } else {

                                numero_tarjeta = document.getElementById("numero_tarjeta").value;
                                codigo_seguridad = document.getElementById("codigo_seguridad").value;
                                fecha = document.getElementById("fecha_vencimiento").value;

                            }

                            $.post("<?= base_url('cliente/cargarSaldo'); ?>",
                                {
                                    valor: valor,
                                    monto: monto,
                                    id_tarjeta: id_tarjeta,
                                    numero_tarjeta: numero_tarjeta,
                                    codigo_seguridad: codigo_seguridad,
                                    fecha: fecha
                                }, function (data2) {
                                    console.log(data2);
                                    var info2 = JSON.parse(data2);
                                    if (info2 === true) {
                                        swal.fire({
                                            title: "¡Felicitaciones!",
                                            text: "La transaccion se completo exitosamente",
                                            icon: "success",
                                        }).then(result => {
                                            window.location.href = baseurl;
                                        });
                                    } else {
                                        swal.fire({
                                            title: "Error",
                                            text: "Debe completar los campos correctamente",
                                            icon: "error",
                                        }).then(result => {

                                        });
                                    }
                                });


                        } else {
                            swal.fire({
                                title: "Error",
                                text: "La contraseña ingresada no coincide con la contraseña de su cuenta",
                                icon: "error",
                            }).then(result => {

                            });
                        }
                    });
            } else {
                swal.fire({
                    title: "Error",
                    text: "La contraseña no puede ser vacia",
                    icon: "error",
                }).then(result => {

                });
            }

        })()
    }
</script>

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
    function abonarVenta() {

        swal.fire({
            title: "Abonar estadia",
            text: "Indique si el cliente abona la estadia en este momento o si la deja pendiente",
            icon: "warning",
            showConfirmButton: true,
            confirmButtonText: "Abonar",
            showCancelButton: true,
            cancelButtonText: "Dejar pendiente"
        }).then(result => {

            dominio = document.getElementById("dominio_vehiculo").value;
            idZona = document.getElementById("id_zona").value === "" ? null : document.getElementById("id_zona").value;
            horas = document.getElementById("cantidad_horas").value;

            console.log(dominio);
            console.log(idZona);
            console.log(horas);

            if (result.isConfirmed) {


                $.post("<?= base_url('vendedor/estacionar'); ?>/" + true,
                    {
                        dominio_vehiculo: dominio,
                        id_zona: idZona,
                        cantidad_horas: horas,

                    }, function (data) {
                        var info = JSON.parse(data);
                       /* console.log("info: " + info);
                        var array = [];
                        $.each(info, function (i, item) {
                            array [i] = item;
                            console.log("ARRAY: " +array[i]);
                        });*/

                        if (info === true) {
                            swal.fire({
                                title: "¡Felicitaciones!",
                                text: "El vehiculo se estaciono correctamente",
                                icon: "success",
                            }).then(result => {
                                window.location.href = baseurl;
                            });
                        } else {
                            swal.fire({
                                title: "Error",
                                text: "La zona y la cantidad de horas son requeridas",
                                icon: "error",
                            }).then(result => {

                            });
                        }

                    }
                );

            } else {

                $.post("<?= base_url('vendedor/estacionar'); ?>/" + false,
                    {
                        dominio_vehiculo: dominio,
                        id_zona: idZona,
                        cantidad_horas: horas,

                    }, function (data) {
                        var info = JSON.parse(data);

                        if (info === true) {
                            swal.fire({
                                title: "¡Felicitaciones!",
                                text: "El vehiculo se estaciono correctamente",
                                icon: "success",
                            }).then(result => {
                                window.location.href = baseurl;
                            });
                        } else {
                            swal.fire({
                                title: "Error",
                                text: "La zona y la cantidad de horas son requeridas",
                                icon: "error",
                            }).then(result => {

                            });
                        }

                    }
                );

               // window.location.href = "<?= base_url('vendedor/estacionar'); ?>/" + false;
            }
        });
    }

</script>
</body>

</html>