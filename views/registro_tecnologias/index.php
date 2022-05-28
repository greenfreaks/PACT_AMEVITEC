<?php require "views/include_views/templates/html1.php"?>
    <div class="section wrapper">
        <div class="row">
            <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Agregar tecnología</span>
                        <!-- <p>Agrega una nueva tecnología a nuestro catalogó para que pueda ser encontrada por empresas.</p> -->
                        <p>Agrega una nueva tecnología para analizar su madurez tecnológica y comercial.</p>
                    </div>
                    <div class="card-action right-align">
                    <a href="newtech" class='waves-effect waves-light btn azul-tbr'><i class='material-icons left'>add</i>Agregar</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Encuesta de Satisfacción</span>
                        <!-- <p>Agrega una nueva tecnología a nuestro catalogó para que pueda ser encontrada por empresas.</p> -->
                        <p>Ayudenos a mejorar esta plataforma contestando nuestra encuesta de satisfacción.</p>
                    </div>
                    <div class="card-action right-align">
                    <a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLScz6aycqOXoxJIqQtqxyo9Cn1RnYwhCA62GiRHzEwC-QAfY6g/viewform?usp=sf_link" class='waves-effect waves-light btn rojo-tbr'><i class='material-icons left'>contact_support</i>Contestar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider"></div>
    </div>

    <div class="section wrapper">
        <div class="row" id="row_techs">
        </div>
    </div>
    
    <?php require "views/include_views/templates/html2.php"?>
    <script src="public/js/dashboard.js"></script>

