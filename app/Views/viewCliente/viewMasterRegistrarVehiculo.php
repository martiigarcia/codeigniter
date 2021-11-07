<?= $this->extend("templates\clientes\masterCliente")?>
<?= $this->section('content') ?>

<div class="main">

            

    <!-- BOF MAIN-BODY -->

    <div class="row">    
        <!-- BOF Horizontal Form -->
        <div class="col-lg-9">

        


            
            <div class="card mb-3">
            <form method="POST" action="<?= base_url('cliente/registrarVehiculo'); ?>">
                    <div class="card-header uppercase">
                        <div class="caption">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.08 3.11H5.77L6.85 7zM19 17H5v-5h14v5z"/><circle cx="7.5" cy="14.5" r="1.5"/><circle cx="16.5" cy="14.5" r="1.5"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 20 20" width="20px" fill="currentColor">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                        Registrar vehiculo
                        </div>
                        
                    </div>
                    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Patente</label>
                                <div class="col">

                                    <input type="text" name="patente" class="form-control" placeholder="Patente" value="<?=old("patente")?>" >
                                    
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label  class="col-md-3 col-form-label">Marca</label>
                                <div class="col">
                                <select class="form-control" id="marcaBox"name="marca" onchange="cargarModelos()" >
                                    <option disabled selected=inicial>Seleccione una Marca:</option>
                                    <?php foreach ($marcas as $marca) : ?>

                                        <option value=<?= $marca['id']; ?>> <?= $marca['nombre']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-3 col-form-label">Modelo</label>
                                <div class="col">
                                    <select class="form-control" name="modelo" id="modeloBox" >
                                        <option disabled selected=inicial>Seleccione un Modelo:</option>

                                    </select>
                                </div>
                            </div>
                            
                            
                        </li>
                        
                        

                        
                    </ul>
                    
                    <div class="card-footer" id="div1">
                    <p style="color: rgb(232,74,103, 1)"> <?= session('mensaje'); ?></p>
                        <div class="row">
                        
                            <div class="col text-center">
                                <button type="submit" class="btn btn-flat mb-1 btn-primary">Confirmar</button>
                                
                                <a href="#" class="btn btn-flat mb-1 btn-secondary"> Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- EOF Horizontal Form -->
    </div>


    <!-- EOF MAIN-BODY -->

</div>

<?= $this->endSection() ?>