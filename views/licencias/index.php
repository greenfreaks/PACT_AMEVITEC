<!doctype html>
<html>

<head>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="public/css/style.css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PACT - Plataforma de Aceleración Comercial de Tecnologías </title>

</head>

<body>


    <div class="navbar-fixed"> 
        <nav>
            <div class="nav-wrapper container">
                <a class="brand-logo center">Licencias</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
            
        </nav>
    </div>
    <?php require 'views/sidenav.php'; ?>  

    <div class="section wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h5>Generador de licencias individuales</h5>
                </div>
            </div>
            <form id="licencia-form">
                <div class="row">
                    <div class="input-field col l6 s12">
                        <i class='material-icons prefix'>alternate_email</i>
                        <input id="email" name="email" type="email" class="validate">
                        <label for="email">Email</label>
                        <span class='helper-text' data-error='Dato no válido' data-success='Dato válido'>
                            Ingrese un email válido
                        </span>
                    </div>
                    <div class="col l6 s12 left">
                        <button id="licencia-form-btn-submit" class="btn waves-effect waves-light" type="submit" name="action">Enviar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>   
    </div> 

    <div class="section wrapper">
        <div class="divider"></div>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h5>Generador de licencias multiples</h5>
                </div>
            </div>
            <form id="busqueda_empresario">
                <div class="row">
                    <div class='input-field col l6 s12'>
                        <input id='input-busqueda' name='busqueda' type='email' class='validate' required>
                        <label for='input-busqueda'> Email de usuario </label>
                        <span class='helper-text' data-error='Dato no válido' data-success='Dato válido'>
                            ingrese correo de usuario empresario
                        </span>
                    </div>
                    <div class="col l3 s12">
                        <button id="licencia-form-btn-submit" class="btn-floating btn-large waves-effect waves-light btn" type="submit" name="action">
                            <i class="material-icons right">search</i>
                        </button>
                    </div>
                </div>
            </form>

            <div class="row z-depth-3" id="resultados_busqueda_empresario">
                <div class="col s12 right-align">
                    <a id='btn-cancelar' class='btn-floating btn-large waves-effect waves-light red'><i class='material-icons '>close</i>Cancelar</a>
                </div>
                <div class="col s12" id="genlicence">
                </div>
                
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="public/js/init.js"></script>
    <script src="public/js/licencias.js"></script>
</body>

</html>
