<?= $this->extend("templates/administrador/masterAdmin")?>
<?= $this->section('content') ?>

<div class="main">

            

    <!-- BOF MAIN-BODY -->

    <div class="row">    
        <!-- BOF Horizontal Form -->
        <div class="col-lg-9">

        


            
            <div class="card mb-3">
            <form method="POST" action="<?= base_url('administrador/guardar'); ?>">
                    <div class="card-header uppercase">
                        <div class="caption">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg> Registrar nuevo usuario
                        </div>
                        
                    </div>
                    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nombre completo</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?=old("nombre")?>">
                                        <input type="text" name="apellido" class="form-control" placeholder="Apellido" value="<?=old("apellido")?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Email</label>
                                <div class="input-group col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-orchid border-orchid text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?=old("email")?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">DNI</label>
                                <div class="input-group col">
                                    <input type="text" name="dni" class="form-control" placeholder="DNI" value="<?=old("dni")?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-danger"><span class="text-light">Obligatorio</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Contraseña</label>
                                <div class="input-group col">
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña" value="<?=old("contraseña")?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-danger"><span class="text-light">Obligatorio</span></span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col">
                                    <span class="form-control-plaintext">Informacion de contraseña</span>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label class="col-md-3 col-form-label">Fecha de nacimiento</label>
                                <div class="col">
                                <div class="input-group date">
                                    <!--
                                    <input type="date" name="fecha_de_nacimiento" placeholder="Fecha de nacimiento" class="form-control calender-black">
                                    -->

                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-orchid border-orchid text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg> 
                                            </span>
                                        </div>
                                        
                                        <input type="text" name="fecha_de_nacimiento" class="datepicker" class="form-control calender-black" placeholder="dd/mm/aaaa" style="width:90%;" value="<?=old("fecha de nacimiento")?>">
                                    </div>
                                    <span class="form-text text-muted">Seleccionar fecha</span>

                                    </div>
                                    </div>
                            
                            </div>
                            
                        </li>
                        
                        
                        <li class="list-group-item">
                        <div class="form-group row">
                                <label class="col-md-3 col-form-label">Rol</label>
                                <div class="col">
                                    <div class="form-group">
                                        
                                    <label>Seleccione un rol de la lista</label>
                                    <select class="form-control" name="id_rol" id="eleccionRol" value="<?=old("rol")?>">
                                    <option disabled selected=inicial>Roles:</option>
                                        <?php foreach ($roles as $rol) : ?>

                                        <option value=<?= $rol['id']; ?>> <?= $rol['nombre']; ?>: <?= $rol['descripcion']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            
                        </li>
                        
                    </ul>
                    
                    <div class="card-footer" id="div1">
                    <p style="color: rgb(232,74,103, 1)"> <?= session('mensaje'); ?></p>
                        <div class="row">
                        
                            <div class="col text-center">
                                <button type="submit" class="btn btn-flat mb-1 btn-primary">Confirmar</button>
                                
                                <a href="<?=base_url("administrador/listadoUsuarios")?>" class="btn btn-flat mb-1 btn-secondary"> Cancelar</a>
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