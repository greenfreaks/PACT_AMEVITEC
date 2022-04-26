<?php include "public/php/conexion.php"?>
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
                <a class="brand-logo center"></a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>
    <?php require 'views/sidenav.php'; ?>

    <div class="section wrapper">
        <div class="container">
            <form method="post" autocomplete="off " id= "form__registroPropiedad">

                <h2>Registro de la propiedad Intelectual</h2>
                <!-- Titular -->
                <div class="input-field col l4 s12 ">
                    <i class="material-icons prefix">person</i>
                    <input id="form__registroPropiedad--titularPropiedad" name="titularPropiedad" type="text"
                        class="validate" required>
                    <label for="form__registroPropiedad--titularPropiedad">Titular de la Propiedad
                        Intelectual...</label>
                </div>

                <!-- Inventores -->
                <div class="input-field col l4 s12 ">
                    <i class="material-icons prefix">people_alt</i>
                    <input id="form__registroPropiedad--inventoresPropiedad" name="inventoresPropiedad" type="text"
                        class="validate" required>
                    <label for="form__registroPropiedad--inventoresPropiedad">Inventores...</label>
                </div>

                <!-- Tipo de Propiedad -->
                <div class="input-field col l4 s12 ">
                    <h6>Tipo de Propiedad intelectual.</h6>
                    <div class="input-field col l6 s12">
                        <select data-last_valid_selection="" data-max=2 id="form__registroPropiedad--tipoPropiedad"
                            name="tipoPropiedad" required>
                           <!--Se llena tipo de propiedad mediante JS -->
                        </select>
                    </div>
                </div>
                <!-- Título -->
                <div class="input-field col l4 s12 ">
                    <i class="material-icons prefix">drive_file_rename_outline</i>
                    <input id="form__registroPropiedad--tituloPropiedad" name="tituloPropiedad" type="text"
                        class="validate" required>
                    <label for="form__registroPropiedad--tituloPropiedad">Título...</label>
                </div>

                <!-- Resúmen -->
                <div class="input-field col l4 s12 ">
                    <h6>Resumen.</h6>
                    <textarea id="form__registroPropiedad--resumenPropiedad" name="resumenPropiedad" type="text"
                        class="validate" required> </textarea>
                </div>

                <!-- Sectores Indistriales llenados desde JavaScript -->
                <!-- <h6><i class="material-icons prefix">factory</i> Sectores Industriales que atiende.</h6>
                <select multiple id="form__registroPropiedad--sectoresPropiedad" name="sectoresPropiedad">

                </select> -->

                <!-- Estatus -->
                <div class="input-field col l4 s12 ">
                    <h6>Estatus.</h6>
                    <div class="input-field col l6 s12">
                        <select data-last_valid_selection="" id="form__registroPropiedad--estatusPropiedad"
                            name="estatusPropiedad" required>
                        </select>
                    </div>
                </div>

                <!-- Región de la Protección (Select llenado desde JS) -->
                <div class="input-field col l4 s12 ">
                    <h6>Región de la Protección.</h6>
                    <div class="input-field col l6 s12">
                        <select data-last_valid_selection="" id="form__registroPropiedad--regionPropiedad"
                            name="regionPropiedad" required>

                            //Regiones LLenadas desde JS

                        </select>
                    </div>
                </div>

                <!-- Numero de la patente -->
                <div class="input-field col l4 s12 ">
                    <i class="material-icons prefix">tag</i>
                    <input id="form__registroPropiedad--numeroPatentePropiedad" name="numeroPatentePropiedad"
                        type="number" class="validate" required>
                    <label for="form__registroPropiedad--numeroPatentePropiedad">No. de patente / solicitud /
                        registro...</label>
                </div>

                <!-- Enlace Web -->
                <div class="input-field col l4 s12 ">
                    <i class="material-icons prefix">link</i>
                    <input id="form__registroPropiedad--linkPropiedad" name="linkPropiedad" type="text"
                        class="validate" required>
                    <label for="form__registroPropiedad--linkPropiedad">Enlace Web a la patente...</label>
                </div> <br>

                <button id="form__registroPropiedad--submit" type="submit" class="btn">Registrar</button>
            </form>
        </div>
    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="public/js/init.js"></script>
    <script src="public/js/registroPropiedadIntelectual.js"></script>
</body>

</html>