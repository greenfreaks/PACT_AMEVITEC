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
            <form id=form__registroPropiedad">

            <h2>Registro de la propiedad Intelectual</h2>
                <!-- Titular -->
                <div class="input-field col l4 s12 ">
                    <i class="material-icons prefix">person</i>
                    <input id="form__registroPropiedad--titular" name="titular" type="text" class="validate" required>
                    <label for="form__registroPropiedad--titular">Titular de la Propiedad Intelectual...</label>
                </div>

                <!-- Inventores -->
                <div class="input-field col l4 s12 ">
                    <i class="material-icons prefix">people_alt</i>
                    <input id="form__registroPropiedad--inventores" name="inventores" type="text" class="validate"
                        required>
                    <label for="form__registroPropiedad--inventores">Inventores...</label>
                </div>

                <!-- Tipo de Propiedad -->
                <div class="input-field col l4 s12 ">
                    <h6>Tipo de Propiedad intelectual.</h6>
                    <div class="input-field col l6 s12">
                        <select required data-last_valid_selection="" data-max=2
                            id="form__registroPropiedad--sectores" name="sectores">
                            <?php include "public/php/tipo_propiedadIntelectual.php"?>
                        </select>
                    </div>
                </div>
                <!-- Título -->
                <div class="input-field col l4 s12 ">
                    <i class="material-icons prefix">drive_file_rename_outline</i>
                    <input id="form__registroPropiedad--titulo" name="titulo" type="text" class="validate" required>
                    <label for="form__registroPropiedad--titulo">Título...</label>
                </div>

                <!-- Resúmen -->
                <div class="input-field col l4 s12 ">
                    <h6>Resumen.</h6>
                    <textarea id="form__registroPropiedad--resumen" name="resumen" type="text" class="validate"
                        required> </textarea>
                </div>

                <!-- Sectores industriales -->
                <div class="input-field col l4 s12 ">
                    <h6>Sectores Industriales que atiende.</h6>
                    <div class="input-field col l6 s12">
                        <select required data-last_valid_selection="" data-max=2 multiple
                            id="form__registroPropiedad--sectores" name="sectores">
                            <?php include "public/php/industria.php"?>
                        </select>
                        <label>Puedes elegir mas de uno</label>
                    </div>
                </div>

                <!-- Estatus -->
                <div class="input-field col l4 s12 ">
                    <h6>Estatus.</h6>
                    <div class="input-field col l6 s12">
                        <select required data-last_valid_selection="" data-max=2
                            id="form__registroPropiedad--estatus" name="estatus">
                            <?php include "public/php/estatus_propiedad.php"?>
                        </select>
                    </div>
                </div>

                <!-- Región de la Protección -->
                <div class="input-field col l4 s12 ">
                    <i class="material-icons prefix">public</i>
                    <input id="form__registroPropiedad--region" name="region" type="text" class="validate"
                        required>
                    <label for="form__registroPropiedad--region">Región de la protección...</label>
                </div>

                <!-- Numero de la patente -->
                <div class="input-field col l4 s12 ">
                    <i class="material-icons prefix">tag</i>
                    <input id="form__registroPropiedad--numeroPatente" name="numeroPatente" type="number" class="validate"
                        required>
                    <label for="form__registroPropiedad--numeroPatente">No. de patente / solicitud / registro...</label>
                </div>

                <!-- Enlace Web -->
                <div class="input-field col l4 s12 ">
                    <i class="material-icons prefix">link</i>
                    <input id="form__registroPropiedad--link" name="link" type="text" class="validate"
                        required>
                    <label for="form__registroPropiedad--link">No. de patente / solicitud / registro...</label>
                </div> <br>

                <input type="submit" name="submitPI" class="btn" value="Registrar">
            </form>
            <div id="holiwis"></div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="public/js/init.js"></script>
    <script src="public/js/registroPropiedadIntelectual.js"></script>
</body>

</html>