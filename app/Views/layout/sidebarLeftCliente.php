<!-- BOF ASIDE-LEFT -->

<div id="sidebar" class="sidebar" style="width: fit-content;">
    <div class="sidebar-content">
        <!-- sidebar-menu  -->
        <div class="sidebar-menu">
            <ul>


                <li class="etiqueta">

                    <div class="subcat">
                        <ul class="list-unstyled components">

                            <li class="active">

                                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
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

                                        <?php if (!empty($dominio)): ?>


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
                                                                    Ingrese la patente del vehiculo a consultar
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">

                                                                <div class="input-group-prepend">

                                                                    <input type="text" name="patente"
                                                                           class="form-control"
                                                                           placeholder="Patente">


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
                                                                <h6>Ingrese la patente en los siguientes formatos
                                                                    posibles:<br>→ AAA-000<br>→ AA-000-AA<br>→ A-000-AAA<br>(Sin
                                                                    espacios ni guiones)</h6>
                                                                <p style="color: rgb(232,74,103)"> <?= session('patente'); ?></p>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

                                            <?php if (!empty($estadia)): ?>

                                                <a href="<?= base_url('cliente/verDesEstacionar'); ?>">DesEstacionar</a>

                                            <?php else: ?>

                                                <a href="<?= base_url('cliente/verEstacionar'); ?>">Estacionar</a>


                                            <?php endif ?>
                                        <?php else: ?>
                                        <?php endif ?>

                                    </li>

                                    <li>
                                        <a href="<?= base_url('cliente/verPagarEstadiasPendientes'); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                                 height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
                                                <g>
                                                    <rect fill="none" height="24" width="24"/>
                                                    <path d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z M6,20V4h7v4h5v12H6z M11,19h2v-1h1 c0.55,0,1-0.45,1-1v-3c0-0.55-0.45-1-1-1h-3v-1h4v-2h-2V9h-2v1h-1c-0.55,0-1,0.45-1,1v3c0,0.55,0.45,1,1,1h3v1H9v2h2V19z"/>
                                                </g>
                                            </svg>
                                            Pagar mis estadias<br>pendientes</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </li>


            </ul>
            </li>
        </div>
        <!-- sidebar-menu  -->
    </div>
</div>
<!-- EOF ASIDE-LEFT -->