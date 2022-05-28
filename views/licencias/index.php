<?php require 'views/include_views/templates/html1.php'; ?>

<div class="section wrapper">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h5>Generador de licencias individuales</h5>
            </div>
        </div>
        <form id="licencia-form">
            <div class="row">
                <div class="input-field col l6 s12">
                    <i class='material-icons prefix'>alternate_email</i>
                    <input id="email" name="email" type="email" class="validate">
                    <label for="email">Email</label>
                    <span class='helper-text' data-error='Dato no válido' data-success='Dato válido'>
                        Ingrese un email válido
                    </span>
                </div>
                <div class="col l6 s12 left">
                    <button id="licencia-form-btn-submit" class="btn waves-effect waves-light" type="submit"
                        name="action">Enviar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="section wrapper">
    <div class="divider"></div>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h5>Generador de licencias multiples</h5>
            </div>
        </div>
        <form id="busqueda_empresario">
            <div class="row">
                <div class='input-field col l6 s12'>
                    <input id='input-busqueda' name='busqueda' type='email' class='validate' required>
                    <label for='input-busqueda'> Email de usuario </label>
                    <span class='helper-text' data-error='Dato no válido' data-success='Dato válido'>
                        ingrese correo de usuario empresario
                    </span>
                </div>
                <div class="col l3 s12">
                    <button id="licencia-form-btn-submit" class="btn-floating btn-large waves-effect waves-light btn"
                        type="submit" name="action">
                        <i class="material-icons right">search</i>
                    </button>
                </div>
            </div>
        </form>

        <div class="row z-depth-3" id="resultados_busqueda_empresario">
            <div class="col s12 right-align">
                <a id='btn-cancelar' class='btn-floating btn-large waves-effect waves-light red'><i
                        class='material-icons '>close</i>Cancelar</a>
            </div>
            <div class="col s12" id="genlicence">
            </div>

        </div>
    </div>
</div>

<?php require 'views/include_views/templates/html2.php'; ?>
<script src="public/js/licencias.js"></script>