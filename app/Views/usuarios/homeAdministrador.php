
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <style>
        .navigation-clean-button {
            background: #fff;
            padding-top: .75rem;
            padding-bottom: .75rem;
            color: #333;
            border-radius: 0;
            box-shadow: none;
            border: none;
            margin-bottom: 0;
        }
        
        @media (min-width:768px) {
            .navigation-clean-button {
            padding-top: 1rem;
            padding-bottom: 1rem;
            }
        }
        
        .navigation-clean-button .navbar-brand {
            font-weight: bold;
            color: inherit;
        }
        
        .navigation-clean-button .navbar-brand:hover {
            color: #222;
        }
        
        .navigation-clean-button .navbar-toggler {
            border-color: #ddd;
        }
        
        .navigation-clean-button .navbar-toggler:hover, .navigation-clean-button .navbar-toggler:focus {
            background: none;
        }
        
        .navigation-clean-button .navbar-toggler {
            color: #888;
        }
        
        .navigation-clean-button .navbar-nav a.active, .navigation-clean-button .navbar-nav > .show > a {
            background: none;
            box-shadow: none;
        }
        
        .navigation-clean-button.navbar-light .navbar-nav a.active, .navigation-clean-button.navbar-light .navbar-nav a.active:focus, .navigation-clean-button.navbar-light .navbar-nav a.active:hover {
            color: #8f8f8f;
            box-shadow: none;
            background: none;
            pointer-events: none;
        }
        
        .navigation-clean-button.navbar .navbar-nav .nav-link {
            padding-left: 18px;
            padding-right: 18px;
        }
        
        .navigation-clean-button.navbar-light .navbar-nav .nav-link {
            color: #465765;
        }
        
        .navigation-clean-button.navbar-light .navbar-nav .nav-link:focus, .navigation-clean-button.navbar-light .navbar-nav .nav-link:hover {
            color: #37434d !important;
            background-color: transparent;
        }
        
        .navigation-clean-button .navbar-nav > li > .dropdown-menu {
            margin-top: -5px;
            box-shadow: 0 4px 8px rgba(0,0,0,.1);
            background-color: #fff;
            border-radius: 2px;
        }
        
        .navigation-clean-button .dropdown-menu .dropdown-item:focus, .navigation-clean-button .dropdown-menu .dropdown-item {
            line-height: 2;
            font-size: 14px;
            color: #37434d;
        }
        
        .navigation-clean-button .dropdown-menu .dropdown-item:focus, .navigation-clean-button .dropdown-menu .dropdown-item:hover {
            background: #eee;
            color: inherit;
        }
        
        .navigation-clean-button .actions .login {
            margin-right: 1rem;
            text-decoration: none;
            color: #465765;
        }
        
        .navigation-clean-button .navbar-text .action-button, .navigation-clean-button .navbar-text .action-button:active, .navigation-clean-button .navbar-text .action-button:hover {
            background: #56c6c6;
            border-radius: 20px;
            font-size: inherit;
            color: #fff;
            box-shadow: none;
            border: none;
            text-shadow: none;
            padding: .5rem 1rem;
            transition: background-color 0.25s;
            font-size: inherit;
        }
        
        .navigation-clean-button .navbar-text .action-button:hover {
            background: #66d7d7;
        }
        
        .row{
            font-size: 1.25rem;
        }
        
        .vr{
            border:         none;
            border-left:    1px solid hsla(200, 10%, 50%,100);
            height:         500px;
            width:          1px;       
        }
        .form-control{
            width: 80%;
            padding-right: 20%;
        }


        
    </style>

    
</head>

<body style="background: #add8e6;">

    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background: #80aebd;">
        <div class="container"><a class="navbar-brand" style="color: rgb(51, 51, 51);">Home</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                </ul><span class="navbar-text actions"> <a class="login" style="color: rgb(51,51,51);">Funciones de administrador</a><a class="btn btn-light action-button" role="button" href="#" style="background: #c7dbd2;color: rgb(0,0,0);">Salir</a></span>
            </div>
        </div>
    </nav>

    <div class="div" style="padding-top: 2%;">
        <div class="row">
            <div class="col" style="padding-left: 15%;">
            <form method="POST" action="<?= base_url('administrador/redireccionar'); ?>">
                <select name="opcion" id="opcionUsuarios" style="background: var(--bs-green); color: white" class="form-control">
                <option value="0" id="opcion" disabled selected=inicial style="background:darkgrey; color:black"> --Opciones de usuarios-- ↓↓
                </option>
                <option value="1" id="opcion" style="background: white; color:black"> Registrar un nuevo usuario</option>
                <option value="2" id="opcion" style="background: white; color:black"> Modificar un usuario existente</option>
                
                    <option value="3" id="opcion" style="background: white; color:black"> Buscar/Eliminar un usuario</option>
                    <option value="4" id="opcion" style="background: white; color:black"> Restablecer contraseña de usuario</option>
                
                </select>
                <br>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="padding-right: 20%;">
                        <button class="btn btn-success" type="submit"> Ir 
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                            </svg>
                            
                        </button>
                </div>
            
    </div>
            
            <br>
            <div class="vr" style="padding-left: 10%;"></div>
            <br>

            
            

            <div class="col">
                <button class="btn btn-primary" type="button" style="background: var(--bs-green);">
                     Listado de vehiculos estacionados
                </button></div>
            </div>

        </div>
    </div>

</body>

<script>
    

</script>

</html>
