<?= $this->extend("templates/master") ?>

<?= $this->section('titulo') ?>
    Listado de infracciones
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    INSERTAR LISTADO DE INFRACCIONES

    <p style="color: rgb(0,155,125)"> <?= session('mensaje'); ?></p>

<?= $this->endSection() ?>