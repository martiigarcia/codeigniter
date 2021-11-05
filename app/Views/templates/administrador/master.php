<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="Fee Bootstrap Admin Theme with Webpack and Laravel-Mix" />
    <meta name="keywords" content="bootstrap, admin theme, admin dashboard, jquery, webpack, laravel-mix, template, responsive" />
    <meta name="author" content="siQuang - Simon Nguyen" />

    <title>Estacionamiento</title>

    <link rel="stylesheet" href="<?=base_url("css/siqtheme.css")?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('asserts/DataTable/DataTables-1.11.3/css/dataTables.bootstrap4.css')?>">
    <link rel="stylesheet" href="<?= base_url('asserts/DataTable/datatables.css')?>">
    <link rel="stylesheet" href="<?= base_url('asserts/DataTables/datatables.css/datatables.min.css')?>">

    
    

</head>

<body class="theme-dark" style="overflow: auto;">
    <div class="grid-wrapper sidebar-bg bg1">

    <?= $this->include('layout/header') ?>
    <?= $this->include('layout/sidebarLeft') ?>

    <div class="main">
    <?= $this->renderSection("content")?>
    </div>
       
    <?= $this->include('layout/sidebarRight', $usuarioActual) ?>
    <?= $this->include('layout/footer') ?>
        
        

    </div> <!-- END WRAPPER -->

    <script src="<?=base_url("js/siqtheme.js")?>"></script>


    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol></svg>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        function mensajeEliminado(direccion) {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Esta seguro que desea eliminar el usuario?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: ' Si ',
                cancelButtonText: ' No ',
                reverseButtons: true
                
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        'El Usuario fue eliminado',
                        'Your file has been deleted.',
                        'success'
                    );
                    location.href = direccion;
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                    return false;
                }
            })
        }
    </script>

    <script src="<?= base_url('asserts/DataTable/datatables.js')?>">  </script>
    <script src="<?= base_url('asserts/DataTable/DataTables-1.11.3/js/dataTables.bootstrap4.js')?>">  </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?= base_url('asserts/Js/tables.js')?>">  </script>

</body>

</html>