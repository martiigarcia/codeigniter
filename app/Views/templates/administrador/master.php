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

    <title>Master</title>

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
       
    <?= $this->include('layout/sidebarRight') ?>
    <?= $this->include('layout/footer') ?>
        
        

    </div> <!-- END WRAPPER -->

    <script src="<?=base_url("js/siqtheme.js")?>"></script>

</body>

</html>