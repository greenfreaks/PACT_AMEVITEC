<!doctype html>
<html>

<head>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TB&amp;R - Technology Bussines and Research</title>

</head>

<body>
    <?php require 'views/include_views/templates/header.php'; ?>

    <div class="parallax-container">
        <div class="section no-pad-bot">
            <div class="container">
                <h1 class="header center teal-text text-lighten-2"><br><span class="red-text">ERROR 404</span></h1>
                <div class="row center">
                    <h5 class="header col s12">La pagina que estas intentanto acceder no existe</h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="img/bg/bg-cta.png" alt="fondo azul con olas hexagonales"></div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col s12 center">
                    <h5>Para encontrar una solucion a este error te sugerimos las siguientes opciones:</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l6">
                    <div class="card">
                        <div class="card-content center">
                            <i class="material-icons medium">contact_phone</i>
                            <h5><strong>Home</strong></h5>
                            <p class="justify">Regresa a nuestra <a class=" negritas" href="index.html">pagina de
                                    inicio</a> y sigue los menus y links para encontrar la pagina que intentas acceder.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col s12 l6">
                    <div class="card">
                        <div class="card-content  center">
                            <i class="material-icons medium ">help</i>
                            <h5 class="center"><strong>Contactanos</strong></h5>

                            <p class="justify">Contacta con nosotros, haciendo clic en el botón pulsante en la esquina
                                inferior derecha. </p>
                            <!--                            <p class="justify">Consulta las <a class="negritas" href="faq.html">preguntas frecuentes</a> o contacta con nosotros, haciendo clic en el botón pulsante en la esquina inferior derecha. </p>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    <!--    <script src="js/materialize.js"></script>-->
    <script src="public/js/init.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137988434-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-137988434-1');
    </script>

</body>

</html>