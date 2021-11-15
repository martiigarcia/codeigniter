<?= $this->extend("templates/inspector/masterInspector")?>
<?= $this->section('content') ?>
    
    vista grafica detalle de la estadia
    <br>
    <p>------------------------------------------------------------------------</p>
    <p>------------------------------------------------------------------------</p>
    <br>
    <p>Id de la estadia  seleccionada: <?=$estadia['id']?></p>
    <p>Estado: <?= $estadia['estado']==1? "ACTIVA": "FINALIZADA";?></p>
    <p>Cantidad de horas: <?=$estadia['cantidad_horas']==null?"INDEFINIDO": $estadia['cantidad_horas']?></p>
    <p>Fecha inicio: <?=$estadia['fecha_inicio']?></p>
    <p>Fecha fin: <?=$estadia['fecha_fin']?></p>
    <p>Monto: <?=$estadia['monto']?></p>
    <br>
    <p>------------------------------------------------------------------------</p>
    <br>
    <p>Zona: <?=$estadia['zona_nombre']?></p>
    <br>
    <p>------------------------------------------------------------------------</p>
    <br>
    <p>Cliente: <?=$estadia['nombre_usuario']?>, <?=$estadia['apellido_usuario']?> </p>
    <p>DNI del cliente: <?=$estadia['dni_usuario']?></p>
    <p>Cliente: <?=$estadia['nombre_usuario']?></p>
    <br>
    <p>------------------------------------------------------------------------</p>
    <br>
    <p>Patente del vehiculo: <?=$estadia['vehiculo_patente']?></p>
    <p>Marca y modelo del vehiculo: <?=$estadia['vehiculo_marca_nombre']?> <?=$estadia['vehiculo_modelo_nombre']?></p>
    <br>
    <p>------------------------------------------------------------------------</p>
    <br>

    


<?= $this->endSection() ?>