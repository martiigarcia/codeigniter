<div id="sidebar" class="sidebar" style="width: fit-content;">
    <div class="sidebar-content">

        <div class="sidebar-menu">
            <ul>

                <li class="etiqueta">

                    <div class="subcat">
                        <ul class="list-unstyled components">

                            <li class="active">

                                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 25 25"
                                         width="24px" fill="currentColor">
                                        <path d="M0 0h24v24H0V0z" fill="none"/>
                                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.08 3.11H5.77L6.85 7zM19 17H5v-5h14v5z"/>
                                        <circle cx="7.5" cy="14.5" r="1.5"/>
                                        <circle cx="16.5" cy="14.5" r="1.5"/>
                                    </svg>
                                    Vehiculos
                                </a>
                                <ul class="collapse list-unstyled" id="homeSubmenu">
                                    <li>
                                        <a href="<?= base_url('cliente/verRegistroVehiculo'); ?>">Registrar Vehiculo</a>
                                    </li>


                                    <li>

                                        <?php

                                        //si tiene dominios el usuario actual entonces muentras la opiones del usuario:
                                        //consultar vehiculo, estacionar/destacionar

                                        if (!empty($dominio)): ?>


                                            <a type="button"
                                               data-toggle="modal"
                                               data-target="#consultarModalToolPop">Consultar Vehiculo</a>

                                            <form method="POST" action="<?= base_url('cliente/consultarVehiculo'); ?>">
                                                <div class="modal fade modal-dark show" id="consultarModalToolPop"
                                                     tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalToolPopTitle" style="display: none;"
                                                     aria-hidden="true"
                                                     aria-labelledby="exampleModalLabel" aria-modal="true"
                                                     style="display: block;">

                                                    <div class="modal-dialog modal-dialog-centered" role="document">

                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalToolPopTitle">
                                                                    Seleccione la patente del vehiculo a detallar
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">

                                                                <div class="input-group-prepend">


                                                                    <select class="form-control" name="dominio_vehiculo"
                                                                            required>

                                                                        <option disabled selected=inicial>Vehiculos bajo
                                                                            dominio:
                                                                        </option>

                                                                        <?php foreach ($dominio as $d) : ?>

                                                                            <option value=<?= $d['id']; ?>>
                                                                                <?= $d['vehiculo_patente']; ?>
                                                                                --> <?= $d['vehiculo_marca_nombre']; ?>
                                                                                , <?= $d['vehiculo_modelo_nombre']; ?>
                                                                            </option>

                                                                        <?php endforeach; ?>

                                                                    </select>


                                                                    <button type="submit"
                                                                            class="btn btn-outline-lemon"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            title="Buscar vehiculo">

                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                             width="16"
                                                                             height="16" fill="currentColor"
                                                                             class="bi bi-search" viewBox="0 0 16 16">
                                                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                                        </svg>
                                                                    </button>


                                                                </div>

                                                            </div>


                                                            <div class="modal-footer" style="display: initial">
                                                                <p style="color: rgb(255,0,0)"> <?= session('errorVehiculo'); ?></p>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </form>


                                            <?php

                                            // si tiene estadias activas y con horario indefinido, entonces muentra desestacionar
                                            // caso contrario (no tiene estadias activas y/o indefinidas, entonces muestra para estacionar

                                            if (!empty($estadia)): ?>

                                                <a type="button"
                                                   onclick="return desEstacionamineto(<?= $estadia->id ?>)">Finalizar
                                                    estadia</a>

                                            <?php else: ?>

                                                <a type="button" onclick="return estacionamineto()">Estacionar</a>

                                            <?php endif ?>
                                        <?php else: ?>
                                        <?php endif ?>

                                    </li>

                                </ul>

                            <li>
                                <?php if (!empty($estadiasPendientes)): ?>
                                    <a href="<?= base_url('cliente/verPagarEstadiasPendientes'); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             height="24" viewBox="0 0 24 24" width="24" fill="currentColor">
                                            <g>
                                                <rect fill="none" height="24" width="24"/>
                                                <path d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z M6,20V4h7v4h5v12H6z M11,19h2v-1h1 c0.55,0,1-0.45,1-1v-3c0-0.55-0.45-1-1-1h-3v-1h4v-2h-2V9h-2v1h-1c-0.55,0-1,0.45-1,1v3c0,0.55,0.45,1,1,1h3v1H9v2h2V19z"/>
                                            </g>
                                        </svg>
                                        Mis estadias pendientes</a>
                                <?php else: ?>
                                <?php endif ?>
                            </li>

                            <li>

                                <?php if (empty($tarjetas)): ?>
                                    <a type="button"
                                       onclick="return definirTarjeta(1)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                             fill="currentColor" class="bi bi-credit-card-2-back"
                                             viewBox="0 0 20 20">
                                            <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z"/>
                                            <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z"/>
                                        </svg>
                                        Cargar saldo a la cuenta</a>

                                <?php else: ?>

                                    <a type="button"
                                       data-toggle="modal"
                                       data-target="#cargarSaldoModalToolPop">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             fill="currentColor" class="bi bi-credit-card-2-back"
                                             viewBox="0 0 24 24">
                                            <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z"/>
                                            <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z"/>
                                        </svg>
                                        Cargar saldo a la cuenta</a>

                                    <div class="modal fade modal-dark show" id="cargarSaldoModalToolPop"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalToolPopTitle" style="display: none;"
                                         aria-hidden="true"
                                         aria-labelledby="exampleModalLabel" aria-modal="true"
                                         style="display: block;">

                                        <div class="modal-dialog modal-dialog-centered" role="document">

                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalToolPopTitle">
                                                        ¿Desea cargar saldo desde una tarjeta suya ya registrada?
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="form-group row">

                                                        <div class="col">
                                                            <div class="input-group col">

                                                                <button type="submit"
                                                                        class="btn btn-outline-info"
                                                                        style="color: white;"
                                                                        onclick="return definirTarjeta(0)"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="Usar tarjeta">Usar tarjeta existente

                                                                </button>
                                                            </div>

                                                        </div>
                                                        <div class="input-group col">
                                                            <button type="submit"
                                                                    class="btn btn-outline-info"
                                                                    style="color: white;"
                                                                    onclick="return definirTarjeta(1)"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Registrar tarjeta">Cargar saldo con nueva
                                                                tarjeta

                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer" style="display: initial">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endif ?>
                            </li>

                            <li>
                                <a type="button"
                                   data-toggle="modal"
                                   data-target="#consultarMontoDeCuentaModalToolPop">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                         class="bi bi-cash-coin" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                                    </svg>

                                    Consultar monto de mi cuenta</a>

                                <form method="POST" action="<?= base_url('cliente/consultarVehiculo'); ?>">
                                    <div class="modal fade modal-dark show" id="consultarMontoDeCuentaModalToolPop"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalToolPopTitle" style="display: none;"
                                         aria-hidden="true"
                                         aria-labelledby="exampleModalLabel" aria-modal="true"
                                         style="display: block;">

                                        <div class="modal-dialog modal-dialog-centered" role="document">

                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                         fill="#F987C5"
                                                         class="bi bi-piggy-bank" viewBox="0 0 20 20">
                                                        <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0zm1.138-1.496A6.613 6.613 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.602 7.602 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962z"/>
                                                        <path fill-rule="evenodd"
                                                              d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069c0-.145-.007-.29-.02-.431.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a.95.95 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.735.735 0 0 0-.375.562c-.024.243.082.48.32.654a2.112 2.112 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595zM2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.558 6.558 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.649 4.649 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393zm12.621-.857a.565.565 0 0 1-.098.21.704.704 0 0 1-.044-.025c-.146-.09-.157-.175-.152-.223a.236.236 0 0 1 .117-.173c.049-.027.08-.021.113.012a.202.202 0 0 1 .064.199z"/>
                                                    </svg>
                                                    <h5 class="modal-title" id="exampleModalToolPopTitle">
                                                        Mi saldo
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">

                                                    <h6 class="modal-title" style="text-align: center"
                                                        id="exampleModalToolPopTitle">
                                                        El monto total de dinero que dispone mi cuenta es de:
                                                    </h6>
                                                    <h5 class="modal-title" style="text-align: center; color: #EFFD5F;"
                                                        id="exampleModalToolPopTitle">
                                                        <b>$<?= $montoTotalDeCuenta ?></b>
                                                    </h5>


                                                </div>


                                                <div class="modal-footer" style="display: initial">
                                                    <p style="color: rgb(255,0,0)"> <?= session('errorVehiculo'); ?></p>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </form>


                            </li>
                            </li>

                        </ul>
                    </div>
                </li>


            </ul>
            </li>
        </div>

    </div>
</div>
