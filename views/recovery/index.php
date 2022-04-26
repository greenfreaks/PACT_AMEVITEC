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
    <title>PACT - Login - Plataforma de Aceleración Comercial de Tecnologías </title>

</head>

<body>

    <div class="section fullheight valign-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 l6 offset-l3">
                    <div class="card">
                        <div class="card-content">
                            <div class="row azul-tbr white-text center">
                                <span class="card-title">Recuperación de Contraseña</span>
                            </div>
                            <form id="password-form">
                                <div id="row_email" class="row center">
                                    <div class="input-field col s12">
                                        <input id="password-form-input-user" name="user" type="email" class="validate">
                                        <label for="password-form-input-user">Ingrese su correo electronico</label>
                                    </div>
                                    <div class="col s12">
                                        <button id="btn-email" class="btn waves-effect waves-light azul-tbr">Enviar Código
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                                <div id="row_codigo" class="row center">
                                    <div class="col s12">
                                        <p>Se le ha enviado un codigo de verificacion a su correo electronico. Ingreselo para continuar</p>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="password-form-input-code" name="code" type="number" class="validate">
                                        <label for="password-form-input-code">Codigo</label>
                                    </div>
                                    <div class="col s12">
                                        <button id="btn-codigo" class="btn waves-effect waves-light azul-tbr">Verificar Código
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                                <div id="row_pass" class="row center">
                                    <div class="col s12">
                                        <p>Ingrese y confirme una nueva contraseña</p>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="password-form-input-pass" name="pass" type="password" class="validate">
                                        <label for="password-form-input-pass">Nueva contraseña</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="password-form-input-pass2" name="pass2" type="password" class="validate">
                                        <label for="password-form-input-pass2">Confirme contraseña</label>
                                    </div>
                                    <div class="col l6 s12">
                                        <button id="btn-submit" class="btn waves-effect waves-light azul-tbr">Cambiar contraseña
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                                <div id="row_success" class="row">
                                    <h4>Contraseña Actualizada</h4>
                                    <a href="login" class="btn waves-effect waves-light azul-tbr">Ingresar
                                            <i class="material-icons right">send</i>
                                        </a>
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
    <script src="public/js/password_recovery.js"></script>
</body>

</html>
