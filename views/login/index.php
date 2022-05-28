<!doctype html>
<html>

<head>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="public/css/style.css" ?24092021>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PACT - Login - Plataforma de Aceleración Comercial de Tecnologías </title>

</head>

<body>
    <?php require"views/include_views/templates/header.php"?>
    <section class="center" style="margin-top: 50px;">
        <img src="public/img/logos/PACT/logo-horizontal.png" style="width: 20%;">
        <h5 class="texto-azul bold">Plataforma de Aceleración Comercial de Tecnologías</h5>
        <h6 class="texto-negro" style="margin-top: 20px;">Te damos la bienvenida a la <b class="texto-rosa">Plataforma
                de Aceleración Comercial de Tecnologías, </b> <br>en esta página podrás registrarte para ser parte de
            nuestra base de académicos y empresarios en busca de alianzas para la innovación <b
                class="texto-marino bold">¡Participa!</b></h6>
    </section>

    <div class="section fullheight valign-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 l6 offset-l3">
                    <div class="card box-shadow">
                        <div class="card-content">
                            <div class="row bg-rosa white-text center round-corners">
                                <span class="card-title texto-blanco negritas">Acceso al PACT</span>
                            </div>
                            <form id="login-form">
                                <div class="row center">
                                    <div class="input-field col s12">
                                        <input id="login-form-input-user" name="user" type="text" class="validate">
                                        <label for="login-form-input-user">Usuario</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="login-form-input-password" name="pass" type="password"
                                            class="validate">
                                        <label for="login-form-input-password">Contraseña</label>
                                    </div>
                                    <div class="col s6">
                                        <a id="btn-registro" href="registro" class="btn round-corners"><i
                                                class="material-icons left">add</i>Registrarse</a>
                                    </div>

                                    <div class="col s6 ">
                                        <button id="login-form-btn-submit" class="btn round-corners" type="submit"
                                            name="action">Ingresar
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-action bold">
                            <a class="negritas" href="recovery">olvidé mi contraseña</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="page-footer custom-footer">
        <div class="container">
            <div class="row custom-row">
                <div class="col l5 s12">
                    <h5 class="texto-gris cta-title-white"><strong>Agencia Mexicana de Vinculación Tecnológica,
                            A.C.</strong></h5>
                </div>
                <div class="col l4 s12">
                    <div class="row valign-wrapper">
                        <div class="col s2 center">
                            <i class="material-icons small">location_on</i>
                        </div>
                        <div class="col s10">
                            <a class="white-text" target="_blank" href="https://goo.gl/maps/Bpacyr5JdN52"> Senda del
                                Amor #7, entre camino Real de Carretas y Senda Eterna Col. Milenio 3, C.P. 76060,
                                Querétaro, Qro.</a>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col s2 center">
                            <i class="material-icons small">phone</i>
                        </div>
                        <div class="col s10">
                            <a class="white-text" href="tel:015521063289">55 21 06 32 89.</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s2 center">
                            <i class="material-icons small">email</i>
                        </div>
                        <div class="col s10">
                            <a class="white-text" href="mailto:contacto@amevitec.org ">contacto@amevitec.org </a>
                        </div>
                    </div>
                </div>
                <!--
                <div class="col l4 s12 ">

                    <p class="justify"><span class="bold">Ubicación: </span><a class="white-text" target="_blank" href="https://goo.gl/maps/Bpacyr5JdN52">Mariano de las casas 15, Col. Mariano de las Casas, Querétaro, Qro</a></p>
                    <p class="justify"><span class="bold">Teléfono: </span><a class="texto-gris" href="tel:017797961482 ">01 (779) 796 1482 </a></p>
                    <p class="justify"><span class="bold">Contacto: </span><a class="texto-gris" href="mailto:contacto@amevitec.org ">contacto@amevitec.org </a></p>
                </div>
-->
                <div class="col l3 s12">
                    <h6 class="white-text bold">Más información</h6>
                    <ul>
                        <!--                        <li><a class="white-text btn-help" href="#!">Ayuda</a></li>-->
                        <li class="texto-gris"><a class="white-text"
                                href="http://www.amevitec.org/sections/privacidad.html">Política de Privacidad</a></li>
                    </ul>
                    <div class="row center">

                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <sub class="right">Made by Mario Sandoval Velázquez using <a class="orange-text text-lighten-3"
                        href="http://materializecss.com" target="_blank">Materialize</a> </sub>
                <p>©AMEVITEC 2022</p>
            </div>
        </div>
    </footer>

    <?php require 'views/include_views/templates/html2.php'; ?>
    <script src="public/js/login.js"></script>