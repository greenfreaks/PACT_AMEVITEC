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
    <title>PACT Plataforma de Aceleración Comercial de Tecnologías </title>

</head>

<body>


    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper container">
                <a class="brand-logo center">Mis tecnologías y patentes</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>
    <?php require 'views/sidenav.php'; ?>
    

    <div class="section wrapper">
        <div class="row">
            <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Agregar tecnología</span>
                        <!-- <p>Agrega una nueva tecnología a nuestro catalogó para que pueda ser encontrada por empresas.</p> -->
                        <p>Agrega una nueva tecnología para analizar su madurez tecnológica y comercial.</p>
                    </div>
                    <div class="card-action right-align">
                    <a href="newtech" class='waves-effect waves-light btn azul-tbr'><i class='material-icons left'>add</i>Agregar</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Encuesta de Satisfacción</span>
                        <!-- <p>Agrega una nueva tecnología a nuestro catalogó para que pueda ser encontrada por empresas.</p> -->
                        <p>Ayudenos a mejorar esta plataforma contestando nuestra encuesta de satisfacción.</p>
                    </div>
                    <div class="card-action right-align">
                    <a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLScz6aycqOXoxJIqQtqxyo9Cn1RnYwhCA62GiRHzEwC-QAfY6g/viewform?usp=sf_link" class='waves-effect waves-light btn rojo-tbr'><i class='material-icons left'>contact_support</i>Contestar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider"></div>
    </div>

    <div class="section wrapper">
        <div class="row" id="row_techs">
        </div>
    </div>
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="public/js/init.js"></script>
    <script src="public/js/dashboard.js"></script>
</body>

</html>
