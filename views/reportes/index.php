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
                <a class="brand-logo center">Reportes</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
            
        </nav>
    </div>
    <?php require 'views/sidenav.php'; ?>  

    <div class="section wrapper">
        <div class="container">
            <form id="reporte-form">
                <ul class='collapsible' id=''>
                    <li>
                        <div class='collapsible-header negritas'>
                            General
                        </div>
                        <div class='collapsible-body white'>
                            <div class="row">
                                <div class="col l4 s12">
                                    <p class="negritas">
                                        Nivel TRL:
                                    </p>
                                    <!-- TODO Formulario -->
                                    <div class='input-field col s6'>
                                        <input id='trl-min' name='trl-min' type='number' class='validate' value="1" min="1" max="9">
                                        <label for='trl-min'> min </label>
                                    </div>
                                    <div class='input-field col s6'>
                                        <input id='trl-max' name='trl-max' type='number' class='validate' value="9" min="1" max="8">
                                        <label for='trl-max'> max </label>
                                    </div>
                                </div>
                                <div class="col l6 s12">
                                    <p class="negritas">Última fecha de evaluación</p>
                                    <div class='input-field col l6 s12'>
                                        <input id='fecha-desde' name='fecha-desde' type="text" class='validate datepicker' required>
                                        <label for='fecha-desde'> Desde: </label>
                                    </div>
                                    <div class='input-field col l6 s12'>
                                        <input id='fecha-hasta' name='fecha-hasta' type="text" class='validate datepicker' required>
                                        <label for='fecha-hasta'> Hasta: </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header negritas">
                            Tipo de organización
                        </div>
                        <div class="white collapsible-body">
                            <div class="row">
                                <div class="col l6 s12">
                                    <p>Procedencia</p>
                                    <p>
                                        <label>
                                            <input type="checkbox" class="filled-in" checked value="1"/>
                                            <span>Academia</span>
                                        </label>
                                        <label>
                                            <input type="checkbox" class="filled-in" checked value="2"/>
                                            <span>Industria</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="col l6 s12">
                                    <p>Tipo de apoyo</p>
                                    <p>
                                        <label>
                                            <input type="checkbox" class="filled-in" checked value="1"/>
                                            <span>Academia</span>
                                        </label>
                                        <label>
                                            <input type="checkbox" class="filled-in" checked value="2"/>
                                            <span>Industria</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="col s12">
                                    <div class='input-field col s12'>
                                        <input id='organizacion' name='organizacion' type='text' class='validate' minlength='3'>
                                        <label for='organizacion'> Organización </label>
                                        <span class='helper-text' data-error='Dato no válido' data-success='Dato válido'>
                                            Universidad, empresa o centro de investigación
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header negritas">Ubicación</div>
                        <div class="collapsible-body white">
                            <div class="row">
                                <div class="col l6 s12">
                                    <div class='input-field col s12'>
                                        <select multiple id="estado" name='estado'>
                                            <option value='0' selected>Todas</option>
                                            <option value='1'>Option 1</option>
                                        </select>
                                        <label>Entidad Federativa</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- li>div.collapsible-header.negritas+div.collapsible-body.white>div. -->
                </ul>
                    
                
                <div class="row">
                    <div class="col l6 s12">
                        <p class="negritas">Objetivo ONU</p>
                        <div class='input-field col s12'>
                            <!-- add multiple after select for multiple select -->
                            <select multiple name='objetivos_onu'>
                                <option value='' disabled selected>Todos</option>
                                <option value='1'>Option 1</option>
                            </select>
                            <label>Materialize Select</label>
                        </div>
                    </div>
                    <div class="col l6 s12">
                        <p class="negritas">Sector Industrial</p>
                    </div>
                    <div class="col l6 s12">
                        <p class="negritas">Area del Conocimiento</p>
                    </div>
                </div>
            </form>
        </div>   
    </div> 

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="public/js/init.js"></script>
    <script src="public/js/reportes.js"></script>
</body>

</html>
