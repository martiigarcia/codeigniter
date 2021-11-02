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
    <link rel="stylesheet" href="<?=base_url("fonts/vendor/font-awesome/fontawesome-webfont.svg")?>">
    <link rel="stylesheet" href="<?=base_url("fonts/vendor/themify-icons-scss/themify.svg")?>">

</head>

<body class="theme-dark">
    <div class="grid-wrapper sidebar-bg bg1">

        <!-- Theme switcher -->
        <div id="theme-tab">
            <div class="theme-tab-item switch-theme bg-white" data-theme="theme-default" data-toggle="tooltip" title="Light"></div>
            <div class="theme-tab-item switch-theme bg-dark" data-theme="theme-dark" data-toggle="tooltip" title="Dark"></div>
        </div>

        <!-- BOF HEADER -->
        <div class="header">
            <div class="header-bar">
                <div class="brand">
                    <a href="#" class="logo"><span class="text-carolina">G&G</span>Software</a>
                    <a href="#" class="logo-sm text-carolina" style="display: none;">siQ</a>
                </div>
                <div class="btn-toggle">
                    <!-- <a href="#" class="toggle-sidebar-btn"><i class="ti-arrow-circle-left"></i></a> -->
                    <a href="#" class="slide-sidebar-btn" style="display: none;"><i class="ti-menu"></i></a>
                </div>
                <div class="navigation d-flex">

                    <!-- BOF Header Search -->
                    <form class="navbar-search" role="search" method="post" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg></div>
                            </div>
                            
                            <input type="text" placeholder="Buscar" class="form-control" name="top-search"
                                id="top-search">
                        </div>
                    </form>
                    <!-- EOF Header Search -->

                    <!-- BOF Header Nav -->
                    <div class="navbar-menu d-flex">
                        <div class="menu-item">
                            <a href="#" class="btn" data-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                            </svg>
                                <span class="badge badge-pill badge-danger">3</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-alert">
                                <li class="dropdown-header text-center"><a href="#"><i class="ti-comment-alt"></i> View
                                        All Alerts <i class="ti-angle-right"></i></a></li>
                                <li><a href="#"><i class="fa fa-user"></i> New user registered <span>Just now</span></a>
                                </li>
                                <li><a href="#"><i class="fa fa-calendar-plus-o"></i> New event created <span>5 min
                                            ago</span></a></li>
                                <li><a href="#"><i class="fa fa-area-chart"></i> Report ready to download <span>1 day
                                            ago</span></a></li>
                                <li><a href="#"><i class="fa fa-bank"></i> all payment reminder <span>1 day
                                            ago</span></a></li>
                                <li><a href="#"><i class="fa fa-clock-o"></i> Staff meeting <span>3 days ago</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-item">
                            <a href="#" class="btn" data-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                            </svg>
                                <span class="badge badge-pill badge-success">7</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-message">
                                <li class="dropdown-header text-center"><a href="#"><i class="ti-comments"></i> View All
                                        Messages <i class="ti-angle-right"></i></a></li>
                                <li>
                                   
                                    <div class="message-row">
                                        <small>24h ago</small>
                                        <a href="#"><span class="message-user">Pear Appleton</span><br>
                                            Staff meeting on Tuesday at 4PM, remember to set date</a>
                                    </div>
                                </li>
                                <li>
                                   
                                    <div class="message-row">
                                        <small>2h ago</small>
                                        <a href="#"><span class="message-user">siQuang Humbleman</span><br>
                                            RE: Remember to generate PNL for October</a>
                                    </div>
                                </li>
                                <li>
                                   
                                    <div class="message-row">
                                        <small>3d ago</small>
                                        <a href="#"><span class="message-user">Lemony Tang</span><br>
                                            Appointment with lawyer, better call Saul!</a>
                                    </div>
                                </li>
                                <li>
                                   
                                    <div class="message-row">
                                        <small>4d ago</small>
                                        <a href="#"><span class="message-user">siQuang Humbleman</span><br>
                                            Theme designed by siQuang for siQthemes</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-item">
                            <a href="#" class="btn right-sidebar-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg></a>
                        </div>
                    </div>
                    <!-- EOF Header Nav -->

                </div>
            </div>
        </div>
        <!-- EOF HEADER -->

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
                                        
                                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                            <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                                                            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                            </svg>Opciones de usuario
                                        </a>
                                        <ul class="collapse list-unstyled" id="homeSubmenu">
                                            <li>
                                                <a href="<?=base_url("home/addUser")?>">Registrar nuevo usuario</a>
                                            </li>
                                            <li>
                                                <a href="<?=base_url("home/listadoUsuarios")?>">Modificar usuario existente</a>
                                            </li>
                                            <li>
                                                <a href="<?=base_url("home/listadoUsuarios")?>">Eliminar usuario existente</a>
                                            </li>
                                            <li>
                                                <a href="<?=base_url("home/listadoUsuarios")?>">Buscar usuario</a>
                                            </li>
                                            <li>
                                                <a href="#">Restablecer contraseña<br>de usuario existente</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
                                        <g>
                                            <rect fill="none" height="24" width="24"/>
                                        </g>
                                        <g>
                                            <g/>
                                            <g>
                                                <path d="M20.57,10.66C20.43,10.26,20.05,10,19.6,10h-7.19c-0.46,0-0.83,0.26-0.98,0.66L10,14.77l0.01,5.51 c0,0.38,0.31,0.72,0.69,0.72h0.62C11.7,21,12,20.62,12,20.24V19h8v1.24c0,0.38,0.31,0.76,0.69,0.76h0.61 c0.38,0,0.69-0.34,0.69-0.72L22,18.91v-4.14L20.57,10.66z M12.41,11h7.19l1.03,3h-9.25L12.41,11z M12,17c-0.55,0-1-0.45-1-1 s0.45-1,1-1s1,0.45,1,1S12.55,17,12,17z M20,17c-0.55,0-1-0.45-1-1s0.45-1,1-1s1,0.45,1,1S20.55,17,20,17z"/>
                                                <polygon points="14,9 15,9 15,3 7,3 7,8 2,8 2,21 3,21 3,9 8,9 8,4 14,4"/>
                                                <rect height="2" width="2" x="5" y="11"/><rect height="2" width="2" x="10" y="5"/><rect height="2" width="2" x="5" y="15"/><rect height="2" width="2" x="5" y="19"/></g></g></svg>
                                        Listado de vehiculos<br>estacionados</a>
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

        <div class="main">
            <?= $this->renderSection("content")?>
        </div>

        <!-- BOF FOOTER -->
        <div class="footer">
            <p class="text-center">Copyright © 2021 G&G <a href="#">Software</a>. All rights reserved.</p>
        </div>
        
        <!-- Preloader -->
        <div id="preloader"></div>
        <!-- EOF FOOTER -->

        <!-- BOF ASIDE-RIGHT -->
        <div id="sidebar-right">
            <div class="sidebar-right-container">

                <!-- BOF TABS -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#tab-1" data-toggle="tab" class="nav-link active">Informacion</a>
                    </li>
                    <li>
                        <a href="#tab-2" data-toggle="tab" class="nav-link">Configuracion</a>
                    </li>
                    <li>
                        <a href="#tab-3" data-toggle="tab" class="nav-link">Help</a>
                    </li>
                </ul>
                <!-- EOF TABS -->

                <!-- BOF TAB PANES -->
                <div class="tab-content">
                    <!-- BOF TAB-PANE #1 -->
                    <div id="tab-1" class="tab-pane show active">
                        <div class="pane-header">
                            <h3><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg></a> Mi perfil</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg> <span class="profile-user">Insertar rol del usuario</span>
                            <span class="float-right"><a href="#" class="text-carolina">Log-Out</a></span>
                        </div>
                        <div class="pane-body">
                            <div class="card bg-transparent mb-3">
                                <ul class="list-group list-group-flush">
                                    
                                    <li class="list-group-item">
                                        <h5 class="mb-3">Mi informacion</h5>
                                        <form class="form-update-profile">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Nombre:</label>
                                                <div class="col">
                                                    <input type="text" name="nombre" class="form-control-plaintext"
                                                        value="siQuang">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Apellido:</label>
                                                <div class="col">
                                                    <input type="text" name="apellido" class="form-control-plaintext"
                                                        value="Humbleman">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">DNI:</label>
                                                <div class="col">
                                                    <input type="text" name="dni" class="form-control-plaintext"
                                                        value="Humbleman">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Email:</label>
                                                <div class="col">
                                                    <input type="text" name="email" class="form-control-plaintext"
                                                        value="siquang@example.com">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Fecha de nacimiento:</label>
                                                <div class="col">
                                                    <input type="text" name="fecha_nacimiento" class="form-control-plaintext"
                                                        value="siquang">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Password:</label>
                                                <div class="col">
                                                    <input type="password" name="password" class="form-control-plaintext"
                                                        value="123456789">
                                                </div>
                                            </div>
                                            <div class="col offset-md-4 pl-2">
                                                <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                                            </div>
                                        </form>
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <h5>Upcoming Events</h5>
                                        <p class="card-text">for Monday - February 25, 2019</p>
                                        <div class="profile-calendar">
                                            <table class="table table-bordered table-hover table-sm">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Schedule</th>
                                                        <th scope="col">Events</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>All-day</td>
                                                        <td><i class="fa fa-circle text-info"></i> Project concept</td>
                                                    </tr>
                                                    <tr>
                                                        <td>10:00 am</td>
                                                        <td><i class="fa fa-circle text-info"></i> Staff meeting</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2:50 pm</td>
                                                        <td><i class="fa fa-circle text-warning"></i> Send out report
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4:30 pm</td>
                                                        <td><i class="fa fa-circle text-danger"></i> Appointment with
                                                            Tang</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- EOF TAB-PANE #1 -->

                    <!-- BOF TAB-PANE #2 -->
                    <div id="tab-2" class="tab-pane">
                        <div class="pane-header">
                            <h3><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                    </svg> Configuracion</h3>
                            
                            <span class="float-right"><a href="#" class="text-carolina">Log-Out</a></span>
                        </div>
                        <div class="pane-body">
                            <div class="card bg-transparent mb-3">
                                <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                        <h5 class="mb-3">Tema</h5>
                                        <div class="btn-group mb-2">
                                            <button type="button" class="btn switch-theme btn-light" data-theme="theme-default">Light</button>
                                            <button type="button" class="btn switch-theme btn-dark" data-theme="theme-dark">Dark</button>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <h5 class="text-carolina"><i class="ti-user"></i> User Settings</h5>
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                        deserunt mollit anim id est laborum.
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" checked data-toggle="toggle" data-size="sm">
                                        Notifications
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" checked data-toggle="toggle" data-size="sm"> Dashboard
                                        Graphs
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" checked data-toggle="toggle" data-size="sm" data-on="Yes"
                                            data-off="No"> Get Daily Feed
                                    </li>
                                    <li class="list-group-item">
                                        <h5 class="text-carolina"><i class="ti-world"></i> Global Settings</h5>
                                        Global settings are only accessible by a super administrator or admin group.
                                        These settings control the application globally.
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" data-toggle="toggle" data-size="sm" data-on="Yes" data-off="No">
                                        Show Subscription
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" data-toggle="toggle" data-size="sm"> SMTP Server
                                        <div class="row mt-3">
                                            <div class="input-group input-group-sm col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">SMTP</span>
                                                </div>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" checked data-toggle="toggle" data-size="sm" data-on="Yes"
                                            data-off="No"> Send Out Daily Report
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" data-toggle="toggle" data-size="sm" data-on="Yes" data-off="No">
                                        Send Daily Cron Report
                                    </li>
                                    <li class="list-group-item">
                                        <input type="checkbox" data-toggle="toggle" data-size="sm" data-on="Yes" data-off="No">
                                        Backup Database Daily
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- EOF TAB-PANE #2 -->

                    <!-- BOF TAB-PANE #3 -->
                    <div id="tab-3" class="tab-pane">
                        <div class="pane-header">
                            <h3><i class="ti-agenda"></i> Help</h3>
                            Frequently Asked Questions
                            <span class="float-right"><a href="#" class="text-carolina">Log-Out</a></span>
                        </div>
                        <div class="pane-body">
                            <div class="accordion" id="faq-example">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#faq1">
                                                Frequently Asked Question #1
                                            </button>
                                        </h2>
                                    </div>
                                    
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#faq2">
                                                Frequently Asked Question #2
                                            </button>
                                        </h2>
                                    </div>
                                    
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#faq3">
                                                Frequently Asked Question #3
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faq3" class="collapse" data-parent="#faq-example">
                                    
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#faq4">
                                                Frequently Asked Question #4
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faq4" class="collapse" data-parent="#faq-example">
                                        
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#faq5">
                                                Frequently Asked Question #5
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faq5" class="collapse" data-parent="#faq-example">
                                        
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#faq6">
                                                Frequently Asked Question #6
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faq6" class="collapse" data-parent="#faq-example">
                                        
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#faq7">
                                                Frequently Asked Question #7
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="faq7" class="collapse" data-parent="#faq-example">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- EOF TAB-PANE #3 -->
                </div>
                <!-- EOF TAB PANES -->

            </div>
        </div>
        <!-- EOF ASIDE-RIGHT -->

        <div id="overlay"></div>

    </div> <!-- END WRAPPER -->

    <script src="<?=base_url("js/siqtheme.js")?>"></script>

</body>

</html>