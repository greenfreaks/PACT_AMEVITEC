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
                <a class="brand-logo center">Detalles</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>
    <?php require 'views/sidenav.php'; ?> 

    <div class="section wrapper texto-negro">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h5 id="techname" class="texto-marino">Nombre de la  Tecnología:</h5>
                </div>
                <div class="col s12">
                    <ul class="collapsible popout" id="div_techdata" class="texto-morado">
                        <!--Contenido dinamico desde JS: detalles de la tecnologia-->
                    </ul>
                </div>
            </div>

            <div class="propiedadBtn" id="propiedadBtn">

            </div>
        </div>   
    </div>



    <!-- Modal Structure -->
    <div id="modalLicencia" class="modal">
        <div class="modal-content">
            <form id="desbloqueo-form">
                <h4 class="texto-marino">Reporte PDF</h4>
                <p>Ingresa tu código de licencia para descargar su reporte de resultados. </p>
                <div class="row valign-wrapper">
                    <div class="input-field col l6 s12">
                        <input id="desbloqueo-form-input-licencia" name="licencia" type="text" class="validate" required>
                        <label for="desbloqueo-form-input-licencia">Licencia.</label>
                    </div>
                    <div class="col l3 s12 center">
                        <button id="desbloqueo-form-btn-submit" class="btn waves-effect waves-light green" type="submit" name="action">Enviar
                            <i class="material-icons right">lock_open</i>
                        </button>
                    </div>
                    <br class="show-on-small-only">
                    <div class="col l3 s12 center">
                        <a target="_blank" href="https://www.mercadopago.com.mx/checkout/v1/redirect?pref_id=401564067-5a6a3466-025f-4fd1-b15c-26908fc7fe08" class='waves-effect waves-light btn'>
                            <i class='material-icons left'>shopping_cart</i>
                            Comprar licencia.
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
        </div>
    </div>

    <div class="wrapper section">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h5 class="texto-marino">Evaluaciones de Madurez (TRL)</h5>
                </div>
                <div class="col s12" id="evaluaciones">
                    <!--Contenido dinamico desde JS: detalles de la tecnologia-->
                    
                </div>
            </div>
        </div>
    </div> 
    

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="public/js/init.js"></script>
    <script src="public/js/technology.js"></script>
</body>

</html>
