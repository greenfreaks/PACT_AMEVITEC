<!doctype html>
<html>

<head>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://unpkg.com/materialize-stepper@3.0.1/dist/css/mstepper.min.css">
    <link rel="stylesheet" href="public/css/style.css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMEVITEC - Plataforma de Aceleración Comercial de Tecnologías - Registro</title>

</head>

<body>
    <?php require "views/header.php"?>
    
    <div class="section" id="rol_selector">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h2 class="center">Registro plataforma PACT</h2>
                    <h5 class="center">Para comenzar, selecciona uno de los siguientes roles:</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l6">
                    <div class="card">
                        <div class="card-content white-text">
                            <span class="card-title texto-azul bold">ESTOY EN LA ACADEMIA</span>
                            <!-- <p>¿Eres estudiante, docente o investigador y buscas dónde aplicar tus conocimientos o tecnologías?</p> -->
                            <p style="color: #000;">Dirigido a instituciones académicas, investigadores y</p> 
                            <p style="color: #000;">estudiantes de posgrado que buscan aplicar sus</p> 
                            <p style="color: #000;">conocimientos o llevar al mercado sus tecnologías.</p>
                            <br>
                            <a id="btn-registro_academico" class="waves-effect waves-light btn center"><i class="material-icons left">school</i>Seleccionar</a>
                        </div>
                    </div>
                </div>
                <div class="col s12 l6">
                    <div class="card">
                        <div class="card-content white-text">
                            <span class="card-title texto-azul negritas">ESTOY EN LA INDUSTRIA</span>
                            <!-- <p>¿Eres empresario o emprendedor y quieres ofrecer o buscar talentos y tecnologías?</p> -->
                            <p style ="color: #000">Dirigido a empresas y emprendedores que buscan</p>
                            <p style="color: #000;">tecnologías, talentos y servicios especializados para la</p>
                            <p style="color: #000;">innovación.</p>
                            <br>
                            <a id="btn-registro_empresario" class="waves-effect waves-light btn center"><i class="material-icons left">account_balance</i>Seleccionar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section" id="registro_plataforma-academico">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h5>Registro de usuario en Academia</h5>
                    <form id="registro_academia-form">
                        <!-- agregar linear a la clase del ul para evitar que se brinquen pasos cta-bg white-text -->
                        <ul id="stepper-academia" class="stepper horizontal" style="min-height:700px">
                            <li class="step active">
                                <div data-step-label="~1min" class="step-title waves-effect">Datos Generales</div>
                                <div class="step-content">
                                    <!-- Your step content goes here (like inputs or so) -->
                                    <p class="white-text negritas"></p>
                                    <div style=" border-radius: 30px;" class="row white">

                                        <!-- Nombre -->
                                        <div class="input-field col l4 s12 ">
                                            <i class="material-icons prefix">account_circle</i>
                                            <input id="registro_academico-form-input-nombre" name="nombre" type="text" class="validate" required>
                                            <label for="registro_academico-form-input-nombre">Nombre(s)*</label>
                                        </div>
                                        <div class="input-field col l4 s12">
                                            <input id="registro_academico-form-input-apeidoP" name="apeidoP" type="text" class="validate" required>
                                            <label for="registro_academico-form-input-apeidoP">Apellido Paterno*</label>
                                        </div>
                                        <div class="input-field col l4 s12">
                                            <input id="registro_academico-form-input-apeidoM" name="apeidoM" type="text" class="validate" required>
                                            <label for="registro_academico-form-input-apeidoM">Apellido Materno*</label>
                                        </div>

                                        <!-- Correo electronico -->
                                        <div class="input-field col l4 s12">
                                            <i class="material-icons prefix">alternate_email</i>
                                            <input id="registro_academico-form-input-email" name="email" type="email" class="validate" required>
                                            <label for="registro_academico-form-input-email">Correo electrónico*</label>
                                            <span class="helper-text" data-error="Dato no válido" data-success="Email válido">No olvide el @</span>
                                        </div>

                                        <!-- Numero de Contacto -->
                                        <div class="input-field col l4 s12">
                                            <i class="material-icons prefix">phone</i>
                                            <input id="registro_academico-form-input-telefono" name="telefono" type="tel" pattern="[0-9]{10}" class="validate">
                                            <label for="registro_academico-form-input-telefono">Teléfono de contacto</label>
                                            <span class="helper-text" data-error="Número a 10 dígitos" data-success="Dato válido">Opcional</span>
                                        </div>

                                        <!-- Fecha de Nacimiento -->
                                        <div class="input-field col l4 s12">
                                            <i class="material-icons prefix">date_range</i>
                                            <input id="registro_academico-form-input-fecha_nacimiento" name="fecha_nacimiento" type="date" class="validate">
                                            <label for="registro_academico-form-input-fecha_nacimiento">Fecha de nacimiento </label>
                                            <span class="helper-text" data-error="Dato no válido" data-success="Dato válido">Puedes usar el teclado</span>
                                        </div>

                                        <!-- Ubicación -->
                                        <div class="input-field col l6 s12 ">
                                            <div>
                                                <label>Estado* </label>
                                            </div>
                                            <select class="browser-default" id="registro_academico-form-input-estado" name="estado" required>
                                                <option value="" disabled selected>Seleccione un estado</option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                                <option value="3">Option 3</option>
                                            </select>

                                        </div>

                                        <div class="input-field col l6 s12 ">
                                            <div>
                                                <label>Municipio* </label>
                                            </div>
                                            <select class="browser-default" id="registro_academico-form-input-municipio" name="municipio" required>
                                                <option value="" disabled selected>Seleccione un municipio</option>
                                            </select>
                                        </div>

                                        <div class="input-field col l6 s12">
                                            <i class="material-icons prefix">lock</i>
                                            <input pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Mín. 8 caracteres, usa mayúsculas, minúsculas números/caracteres especiales" id="registro_academico-form-input-pass" name="pass" type="text" class="validate" required>
                                            <label for="registro_academico-form-input-pass">Contraseña</label>
                                            <span class="helper-text" data-error="Dato no válido" data-success="Dato válido">Mín. 8 caracteres, usa mayúsculas, minúsculas números/caracteres especiales</span>
                                        </div>

                                        <div class="input-field col l6 s12">
                                            <i class="material-icons prefix">lock</i>
                                            <input id="registro_academico-form-input-pass2" name="pass2" type="text" required>
                                            <label for="registro_academico-form-input-pass2">Repita contraseña</label>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col s12 right-align">
                                            <button class="waves-effect waves-dark btn next-step">Siguiente</button>
                                        </div>
                                    </div>

                                    <div class="step-actions">
                                        <!-- Here goes your actions buttons -->
                                        <!--                                        <button class="waves-effect waves-dark btn next-step azul-tbr">Siguiente</button>-->
                                    </div>
                                </div>
                            </li>
                            <li class="step">
                                <div data-step-label="~3min" class="step-title waves-effect">Formación</div>
                                <div class="step-content">

                                    <div class="row">
                                        <!-- <p class="white-text negritas">Los siguientes datos nos ayudaran a conocer tu grado académico, así como tu área de especialización usando los catálogos de la OCD</p> -->
                                        <p class="white-text negritas">Estos datos nos ayudarán a conocer tu formación académica y campo del conocimiento.</p>
                                    </div>


                                    <div style=" border-radius: 30px;" class="row  white">
                                        <!-- Your step content goes here (like inputs or so) -->

                                        <div class="input-field col l6 s12 ">
                                            <div>
                                                <label>Último Grado académico obtenido *</label>
                                            </div>
                                            <select required class="browser-default" id="registro_academico-form-input-grado_academico" name="grado_academico" required>
                                                <option value="" disabled selected>Selecciona Grado Académico</option>
                                                <option value="1">Carrera técnica</option>
                                                <option value="2">Licenciatura o ingeniería</option>
                                                <option value="3">Maestría</option>
                                                <option value="3">Doctorado</option>
                                            </select>
                                        </div>

                                        <div class="input-field col l6 s12">
                                            <i class="material-icons prefix">school</i>
                                            <input id="registro_academico-form-input-titulo" name="titulo" type="text" class="validate">
                                            <label for="registro_academico-form-input-titulo">Título obtenido</label>
                                        </div>

                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">account_balance</i>
                                            <input id="registro_academico-form-input-escuela" name="escuela" type="text" class="validate" required>
                                            <label for="registro_academico-form-input-escuela">Universidad o Centro de Investigación donde cursó sus estudios*</label>
                                        </div>

                                        <div class="row">
                                            <div class="col s12">
                                                <p class="negritas center">¿En qué campo del conocimiento estudiaste?</p>
                                            </div>

                                            <div id="div-campo_de_conocimiento" class="input-field col l4 s12">
                                                <div>
                                                    <label>Selecciona un Campo del conocimiento</label>
                                                </div>
                                                <select class="browser-default" id="campo_de_conocimiento" name="campo_de_conocimiento" required>
                                                    <option value="" disabled selected>Campo del Conocimiento</option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3">Option 3</option>
                                                </select>
                                            </div>

                                            <div id="div-disciplina" class="input-field col l4 s12">
                                                <div>
                                                    <label>Seleccione una Disciplina</label>
                                                </div>
                                                <select required class="browser-default" id="disciplina" name="disciplina">
                                                </select>
                                            </div>

                                            <div id="div-subdisciplina" class="input-field col l4 s12">
                                                <div>
                                                    <label>Selecciona una Subdisciplina</label>
                                                </div>
                                                <select required class="browser-default" id="subdisciplina" name="subdisciplina">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="input-field col l4 s12">
                                            <div>
                                                <label>¿Actualmente se encuentra estudiando?*</label>
                                            </div>
                                            <select class="browser-default" id="registro_academico-form-input-actualmente_estudiando" name="actualmente_estudiando" required>
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1">No estudio</option>
                                                <option value="2">Carrera técnica</option>
                                                <option value="3">Licenciatura o ingeniería</option>
                                                <option value="4">Maestría</option>
                                                <option value="5">Doctorado</option>
                                            </select>
                                        </div>

                                        <div class="input-field col l4 s12">
                                            <input id="registro_academico-form-input-fecha_egreso" name="fecha_egreso" type="date" class="validate">
                                            <label for="registro_academico-form-input-fecha_egreso">Fecha tentativa de egreso</label>
                                            <span class="helper-text" data-error="Dato no válido" data-success="Dato válido">Puedes usar el teclado</span>
                                        </div>

                                        <div class="input-field col l4 s12 ">
                                            <div>
                                                <label>¿Cuenta con algún estímulo o beca?*</label>
                                            </div>
                                            <select class="browser-default" id="registro_academico-form-input-estimulo" name="estimulo" required>
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1">Sin estímulos</option>
                                                <option value="2">Beca CONACYT</option>
                                                <option value="3">Cátedra CONACYT</option>
                                                <option value="4">Sistema Nacional de Investigadores</option>
                                                <option value="5">Otra beca o estímulo</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <p class="white-text negritas">* Datos obligatorios</p>
                                        <div class="col s12 right-align">
                                            <button class="waves-effect waves-dark btn next-step">Siguiente</button>
                                        </div>
                                    </div>

                                    <div class="step-actions">
                                        <!-- Here goes your actions buttons -->
                                        <!-- <button class="waves-effect waves-dark btn next-step azul-tbr">Siguiente</button> -->
                                    </div>
                                </div>
                            </li>

                            <li class="step">
                                <div data-step-label="~2min" class="step-title waves-effect">Experiencia</div>
                                <div class="step-content">
                                    <!-- Your step content goes here (like inputs or so) -->
                                    <div class="row white-text">
                                        <p class="negritas">Ahora por favor cuéntamos de tu experiencia y tus objetivos de desarrollo profesional.</p>
                                    </div>
                                    <div style=" border-radius: 30px;" class="row  white">

                                        <div class="input-field col l6 s12 ">
                                            <div>
                                                <label>Organización a la que pertenece actualmente*</label>
                                            </div>
                                            <select required class="browser-default" id="registro_academico-form-input-organizacion_actual" name="organizacion_actual">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1">Soy independiente</option>
                                                <option value="2">Institución de Educación Superior</option>
                                                <option value="3">Centro Público de Investigación</option>
                                                <option value="4">Empresa</option>
                                                <option value="5">Organización Civil</option>
                                                <option value="6">Dependencia de gobierno</option>
                                            </select>
                                        </div>

                                        <div class="input-field col l6 s12 ">
                                            <div>
                                                <label>Función en la actual organización*</label>
                                            </div>
                                            <select required class="browser-default" id="registro_academico-form-input-funcion" name="funcion">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1">Becario</option>
                                                <option value="2">Socio o director</option>
                                                <option value="3">Empleado</option>
                                                <option value="4">Estudiante</option>
                                                <option value="5">Egresado</option>
                                                <option value="6">Docente</option>
                                                <option value="7">Investigador</option>
                                                <option value="8">Asesor o consultor</option>
                                            </select>
                                        </div>

                                        <div class="input-field col l6 s12">
                                            <select data-last_valid_selection="" data-max=2 id="registro_academico-form-input-actividad" name="actividad[]" multiple required>
                                                <option value="" disabled>Selecciona actividad</option>
                                                <option value="1">Investigación</option>
                                                <option value="2">Desarrollo de tecnología</option>
                                                <option value="3">Procesos de producción</option>
                                                <option value="4">Procesos de comercialización</option>
                                                <option value="5">Procesos creativos o de innovación</option>
                                            </select>
                                            <label>¿En qué actividad consideras que tienes tu mayor experiencia? *<sup>1</sup></label>
                                        </div>

                                        <div class="input-field col l6 s12">
                                            <select data-last_valid_selection="" data-max=2 multiple id="registro_academico-form-input-donde" name="donde[]" required>
                                                <option value="" disabled>Selecciona una opción</option>
                                                <option value="1">Independiente</option>
                                                <option value="2">Institución de Educación Superior</option>
                                                <option value="3">Centro Público de Investigación</option>
                                                <option value="4">Empresa</option>
                                                <option value="5">Organización Civil</option>
                                                <option value="6">Dependencia de gobierno</option>
                                            </select>
                                            <label>¿En dónde has adquirido esa experiencia? *<sup>1</sup></label>
                                        </div>

                                        <div class="input-field col l6 s12">
                                            <select required data-last_valid_selection="" data-max=2 multiple id="registro_academico-form-input-desarrollo_talentos" name="desarrollo_talentos[]">
                                                <option value="" disabled>Selecciona</option>
                                                <option value="1">Desarrollar nuevos productos y servicios</option>
                                                <option value="2">Manufactura y producción</option>
                                                <option value="3">Logística y distribución</option>
                                                <option value="4">Comunicación y comercialización</option>
                                                <option value="5">Interacción social y cultural</option>
                                            </select>
                                            <label>¿En qué actividad te gustaría desarrollar tus talentos? *<sup>1</sup></label>
                                        </div>

                                        <div class="input-field col l6 s12">
                                            <select required data-last_valid_selection="" data-max=2 multiple id="registro_academico-form-input-desarrollo_profecional" name="desarrollo_profecional[]">
                                                <option value="" disabled>Selecciona</option>
                                                <option value="1">Mi propio emprendimiento</option>
                                                <option value="2">Una startup ya existente</option>
                                                <option value="3">Una empresa pequeña o mediana </option>
                                                <option value="4">Una empresa grande o corporativo</option>
                                                <option value="5">Una asociación civil</option>
                                                <option value="6">Dependencias de gobierno</option>
                                                <option value="7">Universidad o centro de investigación</option>
                                            </select>
                                            <label>¿En qué tipo de organización te gustaría desarrollarte profesionalmente? *<sup>1</sup></label>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <p class="white-text negritas">* Datos obligatorios <br> <sup>1</sup> Elegir máximo 2 opciones </p>
                                        <div class="col s12 right-align">
                                            <button class="waves-effect waves-dark btn next-step">Siguiente</button>
                                        </div>
                                    </div>
                                    <div class="step-actions">

                                    </div>
                                </div>
                            </li>

                            <li class="step">
                                <div data-step-label="~1min" class="step-title waves-effect">Habilidades</div>
                                <div class="step-content">
                                    <!-- Your step content goes here (like inputs or so) -->
                                    <div class="row white-text">
                                        <p class="negritas">Finalmente, cuéntanos qué habilidades o competencias destacables consideras que has desarrollado hasta ahora.</p>
                                    </div>
                                    <div style=" border-radius: 30px;" class="row  white">

                                        <div class="col l4 s12">
                                            <p>¿Qué tipo de habilidades has desarrollado en tu trayectoria? Elegir máx. 3</p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="1" name="habilidades_experiencia[]" class="habilidades_experiencia" />
                                                    <span>Generar y aplicar nuevos conocimientos</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="2" name="habilidades_experiencia[]" class="habilidades_experiencia" />
                                                    <span>Desarrollar métodos y procesos</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="3" name="habilidades_experiencia[]" class="habilidades_experiencia" />
                                                    <span>Desarrollar dispositivos y maquinaria</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="4" name="habilidades_experiencia[]" class="habilidades_experiencia" />
                                                    <span>Desarrollar materiales y componentes</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="5" name="habilidades_experiencia[]" class="habilidades_experiencia" />
                                                    <span>Realizar estudios técnicos o tecnológicos</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="6" name="habilidades_experiencia[]" class="habilidades_experiencia" />
                                                    <span>Realizar estudios financieros o comerciales</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="7" name="habilidades_experiencia[]" class="habilidades_experiencia" />
                                                    <span>Realizar estudios sociales o humanísiticos</span>
                                                </label>
                                            </p>
                                        </div>
                                        <div class="col l4 s12">
                                            <p>¿Cuáles son sus Habilidades mejor desarrolladas? Elegir máx. 3</p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="1" name="habilidades[]" class="habilidades" />
                                                    <span>Liderazgo y trabajo en equipo</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="2" name="habilidades[]" class="habilidades" />
                                                    <span>Creatividad en resolución de problemas</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="3" name="habilidades[]" class="habilidades" />
                                                    <span>Visión de negocios y emprendimiento</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="4" name="habilidades[]" class="habilidades" />
                                                    <span>Trabajo en red entre academia e industria</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="5" name="habilidades[]" class="habilidades" />
                                                    <span>Planeación y logística de eventos académicos y/o empresariales</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="6" name="habilidades[]" class="habilidades" />
                                                    <span>Comunicación oral y escrita de contenidos técnicos o financieros</span>

                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="7" name="habilidades[]" class="habilidades" />
                                                    <span>Pensamiento metódico y sistemático</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="8" name="habilidades[]" class="habilidades" />
                                                    <span>Capacidad de trabajo transdisciplinario</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="9" name="habilidades[]" class="habilidades" />
                                                    <span>Excelente expresión oral y escrita</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="10" name="habilidades[]" class="habilidades" />
                                                    <span>Experiencia en proyectos sociales, culturales o ambientales</span>
                                                </label>
                                            </p>
                                        </div>
                                        <div class="col l4 s12">
                                            <p>¿Cuáles son sus Competencias? Elegir máx. 3</p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="1" name="competencias[]" class="competencias" />
                                                    <span>Redacción de documentos técnicos y administrativos</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="2" name="competencias[]" class="competencias" />
                                                    <span>Inglés avanzado (Nivel técnico y/o negocios)</span>

                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="3" name="competencias[]" class="competencias" />
                                                    <span>Diseño experimental para I+D</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="4" name="competencias[]" class="competencias" />
                                                    <span>Manejo de pruebas estadísticas</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="5" name="competencias[]" class="competencias" />
                                                    <span>Administración de proyectos</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="6" name="competencias[]" class="competencias" />
                                                    <span>Corridas financieras e indicadores de rentabilidad</span>

                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="7" name="competencias[]" class="competencias" />
                                                    <span>Estudios de clientes y mercados</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="8" name="competencias[]" class="competencias" />
                                                    <span>Diseño y mapeo de procesos</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="9" name="competencias[]" class="competencias" />
                                                    <span>Estrategias de marketing y ventas</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="checkbox" value="10" name="competencias[]" class="competencias" />
                                                    <span>Experiencia en propiedad intelectual y transferencia de tecnología</span>
                                                </label>
                                            </p>
                                        </div>

                                        <div class="col s12 right-align">
                                            <button id="registro_academico-form-btn-submit" class="btn waves-effect waves-light" type="submit" name="action">Enviar
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                        

                                    </div>
                                    <div class="step-actions">

                                        <!-- Here goes your actions buttons -->
                                        <!--                                        <button class="waves-effect waves-dark btn next-step">Finish</button>-->
                                        
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="section" id="registro_plataforma-empresario">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h5>Registro de usuario en Industria</h5>
                    <form id="registro_empresario-form">
                        <!-- agregar linear a la clase del ul para evitar que se brinquen pasos cta-bg white-text -->
                        <ul id="stepper-empresas" class="stepper horizontal" style="min-height:650px">
                            <li class="step active">
                                <div data-step-label="~1min" class="step-title waves-effect">Datos Generales</div>
                                <div class="step-content">
                                    <!-- Your step content goes here (like inputs or so) -->
                                    <p class="white-text negritas"></p>
                                    <div style=" border-radius: 30px;" class="row white black-text">

                                        <!-- Nombre -->
                                        <div class="input-field col l4 s12 ">
                                            <i class="material-icons prefix">account_circle</i>
                                            <input id="registro_empresario-form-input-nombre" name="nombre" type="text" class="validate" required>
                                            <label for="registro_empresario-form-input-nombre">Nombre(s)*</label>
                                        </div>
                                        <div class="input-field col l4 s12">
                                            <input id="registro_empresario-form-input-apeidoP" name="apeidoP" type="text" class="validate" required>
                                            <label for="registro_empresario-form-input-apeidoP">Apellido Paterno*</label>
                                        </div>
                                        <div class="input-field col l4 s12">
                                            <input id="registro_empresario-form-input-apeidoM" name="apeidoM" type="text" class="validate" required>
                                            <label for="registro_empresario-form-input-apeidoM">Apellido Materno*</label>
                                        </div>

                                        <!-- Correo electronico -->
                                        <div class="input-field col l4 s12">
                                            <i class="material-icons prefix">alternate_email</i>
                                            <input id="registro_empresario-form-input-email" name="email" type="email" class="validate" required>
                                            <label for="registro_empresario-form-input-email">Correo electrónico*</label>
                                            <span class="helper-text" data-error="Dato no válido" data-success="Email válido">No olvide el @</span>
                                        </div>

                                        <!-- Numero de Contacto -->
                                        <div class="input-field col l4 s12">
                                            <i class="material-icons prefix">phone</i>
                                            <input id="registro_empresario-form-input-telefono" name="telefono" type="tel" pattern="[0-9]{10}" class="validate">
                                            <label for="registro_empresario-form-input-telefono">Teléfono de contacto</label>
                                            <span class="helper-text" data-error="Número a 10 digitos" data-success="Dato válido">Opcional</span>
                                        </div>

                                        <!-- Fecha de Nacimiento -->
                                        <div class="input-field col l4 s12">
                                            <i class="material-icons prefix">date_range</i>
                                            <input id="registro_empresario-form-input-fecha_nacimiento" name="fecha_nacimiento" type="date" class="validate">
                                            <label for="registro_empresario-form-input-fecha_nacimiento">Fecha de nacimiento </label>
                                            <span class="helper-text" data-error="Dato no válido" data-success="Dato válido">Puedes usar el teclado</span>
                                        </div>

                                        <!-- Ubicación -->
                                        <div class="input-field col l6 s12 ">
                                            <div>
                                                <label>Estado*</label>
                                            </div>
                                            <select class="browser-default" id="registro_empresario-form-input-estado" name="estado" required>
                                                <option value="" disabled selected>Seleccione un estado</option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                                <option value="3">Option 3</option>
                                            </select>

                                        </div>

                                        <div class="input-field col l6 s12 ">
                                            <div>
                                                <label>Municipio* </label>
                                            </div>
                                            <select class="browser-default" id="registro_empresario-form-input-municipio" name="municipio" required>
                                                <option value="" disabled selected>Seleccione un municipio</option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                                <option value="3">Option 3</option>
                                            </select>
                                        </div>

                                        <div class="input-field col l6 s12">
                                            <i class="material-icons prefix">lock</i>
                                            <input pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Mín. 8 caracteres, usa mayúsculas, minúsculas números/caracteres especiales" id="registro_empresario-form-input-pass" name="pass" type="text" class="validate" required>
                                            <label for="registro_empresario-form-input-pass">Contraseña</label>
                                            <span class="helper-text" data-error="Mín. 8 caracteres, usa mayúsculas, minúsculas números/caracteres especiales" data-success="Dato válido">Mín. 8 caracteres, usa mayúsculas, minúsculas números/caracteres especiales</span>
                                        </div>

                                        <div class="input-field col l6 s12">
                                            <i class="material-icons prefix">lock</i>
                                            <input id="registro_empresario-form-input-pass2" name="pass2" type="text" required>
                                            <label for="registro_empresario-form-input-pass2">Repita contraseña</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col s12 right-align">

                                        </div>
                                    </div>

                                    <div class="step-actions">
                                        <!-- Here goes your actions buttons -->
                                        <!--                                        <button class="waves-effect waves-dark btn next-step azul-tbr">Siguiente</button>-->
                                        <button class="waves-effect waves-dark btn next-step">Siguiente</button>
                                    </div>
                                </div>
                            </li>

                            <li class="step">
                                <div data-step-label="~2min" class="step-title waves-effect">Empresa</div>
                                <div class="step-content">
                                    <!-- Your step content goes here (like inputs or so) -->
                                    <div class="row white-text">
                                        <p class="negritas"></p>
                                    </div>
                                    <div style=" border-radius: 30px;" class="row  white black-text">

                                        <div class="input-field col l6 s12 ">
                                            <i class="material-icons prefix">domain</i>
                                            <input id="registro_empresario-form-input-nombre_empresa" name="nombre_empresa" type="text" class="validate" required>
                                            <label for="registro_empresario-form-input-nombre_empresa">*Nombre de la empresa</label>
                                        </div>

                                        <div class="input-field col l6 s12">
                                            <i class="material-icons prefix">http</i>
                                            <input id="registro_empresario-form-input-pagina_web" name="pagina_web" type="text" class="validate">
                                            <label for="registro_empresario-form-input-pagina_web">Página web</label>
                                        </div>


                                        <div class="input-field col l4 s12 ">
                                            <div>
                                                <label>*Puesto en la empresa</label>
                                            </div>
                                            <select id="registro_empresario-form-input-puesto" name="puesto" class="browser-default" required>
                                                <option value="" disabled selected>Seleccione Puesto</option>
                                                <option value="1">Dirección</option>
                                                <option value="2">Gerencia</option>
                                                <option value="3">Jefatura</option>
                                                <option value="4">Coordinación</option>
                                                <option value="5">Otro</option>
                                            </select>
                                        </div>

                                        <div class="input-field col l4 s12 ">
                                            <div>
                                                <label>*Tamaño de la empresa</label><sup><a href="#modal-mensaje">?</a></sup>
                                            </div>
                                            <select id="registro_empresario-form-input-tamano" name="tamano" class="browser-default" required>
                                                <option value="" disabled selected>Seleccione tamaño</option>
                                                <option value="1">Startup</option>
                                                <option value="2">Micro</option>
                                                <option value="3">Pequeña</option>
                                                <option value="4">Mediana</option>
                                                <option value="5">Grande</option>
                                            </select>
                                        </div>

                                        <div class="input-field col l4 s12 ">
                                            <div>
                                                <label>*Presencia del mercado</label>
                                            </div>
                                            <select id="registro_empresario-form-input-mercado" name="mercado" class="browser-default" required>
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1">Solo nacional</option>
                                                <option value="2">Nacional e internacional</option>
                                            </select>
                                        </div>

                                        <div class="col s12 center black-text">
                                            <h4>Sector Industrial</h4>
                                        </div>

                                        <div class="input-field col l4 s12 ">
                                            <div>
                                                <label>*Sector industrial</label>
                                            </div>
                                            <select id="sector_scian" name="sector" class="browser-default" required>
                                                <option value="" disabled selected>Seleccione una opción</option>
                                            </select>
                                        </div>

                                        <div class="input-field col l4 s12 ">
                                            <div>
                                                <label>*Subsector industrial</label>
                                            </div>
                                            <select id="subsector_scian" name="subsector" class="browser-default" required>
                                                <option value="" disabled selected>Seleccione una opción</option>
                                            </select>
                                        </div>

                                        <div class="input-field col l4 s12 ">
                                            <div>
                                                <label>*Rama</label>
                                            </div>
                                            <select id="rama_scian" name="rama" class="browser-default" required>
                                                <option value="" disabled selected>Seleccione una opción</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <p class="white-text negritas">* Datos obligatorios</p>
                                        <div class="col s12 right-align">
                                            <!--                                            <button class="waves-effect waves-dark btn next-step cta azul-tbr">Siguiente</button>-->

                                        </div>
                                    </div>
                                    <div class="step-actions">
                                        <button id="registro_empresario-form-btn-submit" class="btn waves-effect waves-light" type="submit" name="action">Enviar
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="section" id="registro_completado">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h2 class="center">Registro Completado</h2>
                    <h4 class="negritas">A continuación, ingresa al PACT para realizar alguna de las siguientes acciones:</h4>
                </div>
            </div>
            <div class="row" id="recomendaciones_academico">
                <div class="col s12">
                    <ul class="collection">
                        <li class="collection-item">Registrar y consultar instituciones educativas y de investigación, así como sus capacidades en ciencia, ingeniería y humanidades.</li>
                        <li class="collection-item">Evaluar y consultar tecnologías y su nivel de madurez.</li>
                        <li class="collection-item">Conocer las necesidades de I+D+i de la industria.</li>
                        <li class="collection-item">Consultar la oferta de Propiedad Intelectual del inventario.</li>
                        <li class="collection-item">Registrar y buscar talentos para la I+D+i.</li>
                    </ul>
                </div>
            </div>
            <div class="row" id="recomendaciones_empresario">
                <div class="col s12">
                    <ul class="collection">
                        <li class="collection-item">Registrar y consultar instituciones educativas y de investigación, así como sus capacidades en ciencia, ingeniería y humanidades.</li>
                        <li class="collection-item">Evaluar y consultar tecnologías y su nivel de madurez.</li>
                        <li class="collection-item">Conocer las necesidades de I+D+i de la industria.</li>
                        <li class="collection-item">Consultar la oferta de Propiedad Intelectual del inventario.</li>
                        <li class="collection-item">Registrar y buscar talentos para la I+D+i.</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col s12 right-align">
                    <a href="login" class="waves-effect waves-light btn"><i class="material-icons right">input</i>Acceder</a>
                </div>
            </div>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    <script src="https://unpkg.com/materialize-stepper@3.0.1/dist/js/mstepper.min.js"></script>
    <script src="public/js/init.js"></script>
    <script src="public/js/registro.js"></script>


</body>

</html>
