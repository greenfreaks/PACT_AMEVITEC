userManagement<!doctype html>
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

    <a  class='btn-floating btn-large waves-effect waves-light btn'><i class='material-icons left'>map</i>Button</a>
    <div class="navbar-fixed"> 
        <nav>
            <div class="nav-wrapper container">
                <a class="brand-logo center">Usuarios</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
            
        </nav>
    </div>
    <?php require 'views/sidenav.php'; ?> 

    <div class="section wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h5>Manejo de usuarios</h5>
                </div>
            </div>
            <form id="search-form">
                <div class="row">
                    <div class="input-field col l6 s12">
                        <i class='material-icons prefix'>search</i>
                        <input id="search_term" name="search_term" type="text" class="validate" required>
                        <label for="search_term">Busqueda de Usuario</label>
                        <span class='helper-text' data-error='Dato no válido' data-success='Dato válido'>
                        Nombre, apellidos o id de usuario
                        </span>
                    </div>
                    <div class="col l6 s12 left">
                        <button id="search-form-btn-submit" class="btn waves-effect waves-light" type="submit">Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>   
    </div> 

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="public/js/init.js"></script>
    <script src="public/js/userManagement.js"></script>
</body>

</html>
