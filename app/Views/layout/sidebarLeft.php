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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-people-fill" viewBox="0 0 16 16">
                                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                        <path fill-rule="evenodd"
                                              d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                                        <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                    </svg>
                                    Opciones de usuario
                                </a>
                                <ul class="collapse list-unstyled" id="homeSubmenu">
                                    <li>
                                        <a href="<?= base_url("administrador/addUser") ?>">Registrar nuevo usuario</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url("administrador/listadoUsuarios") ?>">Modificar/Eliminar<br>Restablecer
                                            contraseña<br>Buscar usuario existente</a>
                                    </li>


                                </ul>
                            </li>
                            <li>
                                <a href="<?= base_url("administrador/verListadoVehiculosEstacionados") ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                         height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
                                        <g>
                                            <rect fill="none" height="24" width="24"/>
                                        </g>
                                        <g>
                                            <g/>
                                            <g>
                                                <path d="M20.57,10.66C20.43,10.26,20.05,10,19.6,10h-7.19c-0.46,0-0.83,0.26-0.98,0.66L10,14.77l0.01,5.51 c0,0.38,0.31,0.72,0.69,0.72h0.62C11.7,21,12,20.62,12,20.24V19h8v1.24c0,0.38,0.31,0.76,0.69,0.76h0.61 c0.38,0,0.69-0.34,0.69-0.72L22,18.91v-4.14L20.57,10.66z M12.41,11h7.19l1.03,3h-9.25L12.41,11z M12,17c-0.55,0-1-0.45-1-1 s0.45-1,1-1s1,0.45,1,1S12.55,17,12,17z M20,17c-0.55,0-1-0.45-1-1s0.45-1,1-1s1,0.45,1,1S20.55,17,20,17z"/>
                                                <polygon
                                                        points="14,9 15,9 15,3 7,3 7,8 2,8 2,21 3,21 3,9 8,9 8,4 14,4"/>
                                                <rect height="2" width="2" x="5" y="11"/>
                                                <rect height="2" width="2" x="10" y="5"/>
                                                <rect height="2" width="2" x="5" y="15"/>
                                                <rect height="2" width="2" x="5" y="19"/>
                                            </g>
                                        </g>
                                    </svg>
                                    Listado de vehiculos<br>estacionados</a>
                            </li>

                            <li>
                                <a href="<?= base_url("administrador/verListadoInfracciones") ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                         height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
                                        <g>
                                            <rect fill="none" height="24" width="24"/>
                                            <path d="M17,12c-2.76,0-5,2.24-5,5s2.24,5,5,5c2.76,0,5-2.24,5-5S19.76,12,17,12z M18.65,19.35l-2.15-2.15V14h1v2.79l1.85,1.85 L18.65,19.35z M18,3h-3.18C14.4,1.84,13.3,1,12,1S9.6,1.84,9.18,3H6C4.9,3,4,3.9,4,5v15c0,1.1,0.9,2,2,2h6.11 c-0.59-0.57-1.07-1.25-1.42-2H6V5h2v3h8V5h2v5.08c0.71,0.1,1.38,0.31,2,0.6V5C20,3.9,19.1,3,18,3z M12,5c-0.55,0-1-0.45-1-1 c0-0.55,0.45-1,1-1c0.55,0,1,0.45,1,1C13,4.55,12.55,5,12,5z"/>
                                        </g>
                                    </svg>
                                    Listado de infracciones</a>
                            </li>

                            <li class="active">

                                <a href="#homeSubmenuZonas" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                         width="24px" fill="currentColor">

                                        <path d="M0 0h24v24H0V0z" fill="none"/>
                                        <path d="M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM10 5.47l4 1.4v11.66l-4-1.4V5.47zm-5 .99l3-1.01v11.7l-3 1.16V6.46zm14 11.08l-3 1.01V6.86l3-1.16v11.84z"/>
                                    </svg>
                                    Opciones de zonas
                                </a>
                                <ul class="collapse list-unstyled" id="homeSubmenuZonas">
                                    <li>
                                        <a href="<?= base_url("administrador/verModificarHorarioZona") ?>">Modificar
                                            horario</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url("administrador/verModificarCostoZona") ?>">Modificar
                                            costo</a>
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

        



   