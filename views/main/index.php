<!doctype html>
<html>

<head>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="public/css/style9.css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TB&amp;R - Plataforma de Aceleración Comercial de Tecnologías - Login</title>

</head>

<body>

<div class="section fullheight no-pad-bot valign-wrapper">
    <div class="container">
        <div class="row center">
            <div class="col s12 l6 offset-l3">
                <div class="card">
                    <div class="azul-tbr white-text">
                        <h3>PACT Login</h3>
                        <br>
                    </div>
                    <div class="card-content">
                        
                        <form id="login-form" action="" method="POST">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="login-form-input-user" name="username" type="text" class="validate" required>
                                    <label for="login-form-input-user">Usuario</label>
                                </div>
                            </div>
                            <div class="row center">
                                <div class="input-field col s12">
                                    <input id="login-form-input-password" name="password" type="password" class="validate" required>
                                    <label for="login-form-input-password">Contraseña</label>
                                </div>
                            </div>
                            <div class="row center">
                                <div class="col s12">
                                    <p class="red-text">
                                        <?php
                                            if(isset($errorLogin)){
                                                echo $errorLogin;
                                            }
                                        ?>
                                    </p>
                                    <br>
                                </div>
                                <div class="col s6">
                                    <a href="registro" class="waves-effect waves-light btn azul-tbr"><i class="material-icons right">person_add</i>Registro</a>
                                </div>
                                <div class="col s6">
                                    <button id="login-form-btn-submit" class="btn waves-effect waves-light rojo-tbr" type="submit" name="action">Ingresar
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                            <div class="row center">
                                <div class="col s12">
                                    <a>Contraseña Olvidada</a>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="public/js/init.js"></script>
    <script src="public/js/main.js"></script>
</body>

</html>
