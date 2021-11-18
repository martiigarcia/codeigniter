<?= $this->extend("templates/master")?>

<?= $this->section('titulo') ?>
    Inicio
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <p style="color: rgb(0,155,125)"> <?= session('mensaje'); ?></p>
<?= $this->endSection() ?>