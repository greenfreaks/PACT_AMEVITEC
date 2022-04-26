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
                <a class="brand-logo center">Resumen</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
            
        </nav>
    </div>
    <?php require 'views/sidenav.php'; ?>  

    <div class="section wrapper">
            <div id="charts" class="row">
                <!-- en esta sección se agregan los gráficos -->
            </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="public/js/init.js"></script>
    <script src="public/js/adminPanel.js"></script>
</body>

</html>
