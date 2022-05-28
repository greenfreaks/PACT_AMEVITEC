<?php require "views/include_views/templates/html1.php"?>

  <div class="section wrapper">
    <div class="row" id="row_techs">
      <div class="col s12">
        <form id="form-newtech">
          <!-- add linear to avoid navigation without validation -->
          <ul id='stepper-newtech' class='stepper horizontal linear' style='min-height: 90vh;'>
            <li class='step active'>
              <div class='step-title waves-effect' data-step-label=''>General.</div>
              <div class='step-content'>
                <!-- Your step content goes here (like inputs or so) -->
                <div class="row">
                  <div class="input-field col l6 s12">
                    <i class='material-icons prefix'>assignment</i>
                    <input id="input-techname" name="techname" type="text" class="validate" required>
                    <label for="input-techname" class="texto-morado">Nombre de la tecnología.</label>
                    <span class='helper-text' data-error='Dato no válido' data-success='Dato válido'>
                      Ingresa un nombre para tu tecnología.
                    </span>
                  </div>
                  <!-- <div class='input-field col l6 s12'>
                      
                      <input id='input-techname' name='techname' type='text' class='validate' required>
                      <label for='techname'>Nombre de la tecnología</label>
                      <span class='helper-text' data-error='Dato no válido' data-success='Dato válido'>
                      </span>
                    </div> -->
                </div>
                <div class="row">
                  <div id="checkboxes" class='col s12 l6'>
                    <p class="texto-morado">¿A quién beneficia directamente tu tecnología? Máx. 2 </p>
                    <p>
                      <label>
                        <input type='checkbox' name='problematica' val='1' />
                        <span>Grupos sociales e individuos.</span>
                      </label>
                    </p>
                    <p>
                      <label>
                        <input type='checkbox' name='problematica' val='2' />
                        <span>Organizaciones económicas, industriales y comerciales.</span>
                      </label>
                    </p>
                    <p>
                      <label>
                        <input type='checkbox' name='problematica' val='3' />
                        <span>Medio ambiente y ecosistemas.</span>
                      </label>
                    </p>
                  </div>
                  <div class='col s12 l6'>
                    <p class="texto-morado">¿Qué tipo de alianza deseas establecer para explotar tu tecnología?</p>
                    <p>
                      <label>
                        <input name='alianza' val='1' type='radio' checked />
                        <span>Encontrar o formar un equipo de trabajo.</span>
                      </label>
                    </p>
                    <p>
                      <label>
                        <input name='alianza' val='2' type='radio' />
                        <span>Socios para emprender.</span>
                      </label>
                    </p>
                    <p>
                      <label>
                        <input name='alianza' val='3' type='radio' />
                        <span>Crear una empresa para mi tecnología.</span>
                      </label>
                    </p>
                    <p>
                      <label>
                        <input name='alianza' val='4' type='radio' />
                        <span>Encontrar una empresa que quiera mi tecnología.</span>
                      </label>
                    </p>
                    <p>
                      <label>
                        <input name='alianza' val='5' type='radio' />
                        <span>Conseguir un inversionista.</span>
                      </label>
                    </p>
                    <p>
                      <label>
                        <input name='alianza' val='6' type='radio' />
                        <span>Conseguir un mentor de negocios.</span>
                      </label>
                    </p>
                  </div>
                  <div class="col s12 right-align">
                    <button id="btn-next-beneficios" class='waves-effect waves-dark btn next-step'>Siguiente.</button>
                  </div>
                </div>
              </div>
            </li>
            <li class='step'>
              <div class='step-title waves-effect' data-step-label=''>Industria.</div>
              <div class='step-content box-shadow'>
                <!-- Your step content goes here (like inputs or so) -->
                <!-- Catalogo scian maximo 3 opciones
                    ¿Cuáles son las industrias que se pueden beneficiar de su tecnología?
                    ¿Cuales son los beneficios que cada una de esas industrias obtendrían al usar su propuesta? (abierta)
                    enviar ID rama y texto beneficio (max 200 char)
                  -->
                <div class="row">
                  <div class="col s12 black-text">
                    <h5 class="center texto-verde bold">¿Cuáles son las industrias que se pueden beneficiar de tu
                      tecnología?</h5>
                    <p>Selecciona el sector industrial en donde piensas explotar tu tecnología o proyecto para lanzar
                      innovaciones al mercado.</p>
                    <p>Selecciona sector, subsector, rama y da clic en el botón verde para agregar. <b
                        class="texto-marino">Puedes seleccionar hasta 3 sectores industriales </b> con su rama.</p>
                  </div>
                  <div class="divider"></div>
                  <br>
                  <div class="input-field col l4 s12 ">
                    <div>
                      <p class="texto-morado">*Sector industrial.</p>
                    </div>
                    <select id="sector_scian" name="sector" class="browser-default">
                      <option value="" disabled selected>Selecciona una opción</option>
                    </select>
                  </div>
                  <div class="input-field col l4 s12 ">
                    <div>
                      <p class="texto-morado">*Subsector industrial.</p>
                    </div>
                    <select id="subsector_scian" name="subsector" class="browser-default">
                      <option value="" disabled selected>Selecciona una opción.</option>
                    </select>
                  </div>
                  <div class="input-field col l3 s12 ">
                    <div>
                      <p class="texto-morado">*Rama.</p>
                    </div>
                    <select id="rama_scian" name="rama" class="browser-default">
                      <option value="" disabled selected>Selecciona una opción.</option>
                    </select>
                  </div>
                  <div class="col l1 s12 center">
                    <a id='btn-seleccionar-rama' class='btn-floating btn-large waves-effect waves-light btn green'><i
                        class='material-icons left'>add</i>Seleccionar.</a>
                  </div>
                  <div id="div-selected_sectores" class="col s12"></div>
                </div>
                <div class="divider"></div>
                <br>
                <div class="row">
                  <div class="col s12 right-align">
                    <button class='waves-effect waves-dark btn-flat previous-step'>Atrás</button>
                    <button id="next-btn-sectores" class='waves-effect waves-dark btn next-step'>Siguiente</button>
                  </div>
                </div>
              </div>
            </li>
            <li class='step'>
              <div class='step-title waves-effect' data-step-label=''>Características.</div>
              <div class='step-content'>
                <!-- Your step content goes here (like inputs or so) -->
                <!-- ¿Qué soluciones aporta su tecnología? predicados -->
                <!-- Mi (tipo_tecnologia) va dirigido a (usuario_tecnologia) y (verbo_solucion) (complemento) -->
                <div class="row">
                  <div class="col s12">
                    <h5 class="center texto-verde bold">¿Qué soluciones aporta tu tecnología?</h5>
                    <!-- <p>Utilizando nuestro generador de predicados caracteriza tu tecnologia. Puedes mencionar hasta 5 caracteristicas de tu tecnología. </p> -->
                    <p>Te ayudaremos a describir la solución que aporta tu tecnología. Usa los campos de selección y <b
                        class="texto-marino">escribe en máx. 300 caracteres </b> la solución o problemática que
                      resuelve.</p>
                    <p>Puedes crear hasta 5 oraciones que describan las aplicaciones benéficas de tu tecnología.</p>
                    <!-- <p>Ejemplo: Mi [tecnología] va dirigido a [empresas] y [reduce] (energia mediante la desactivacion de estaciones base)</p> -->
                    <p>Ejemplo: Mi <u>proceso o método</u> va dirigido a <u>empresas</u> y <u>reduce</u> <u>las
                        emisiones contaminantes que dañan la salud de los habitantes de la Ciudad de México</u>.</p>
                  </div>
                </div>
                <div class="row gris-claro">
                  <div class="col l2 s12">
                    <strong class="texto-morado">Mi(s)</strong>
                    <select id="sel_tecnologia" name="tipo_tecnologia" class="browser-default">
                      <option value="" disabled selected>Tipo de tecnologia.</option>
                    </select>
                  </div>
                  <div class="col l2 s6">
                    <strong class="texto-morado"> va dirigido a</strong>
                    <select id="sel_usuario" name="tipo_usuario" class="browser-default">
                      <option value="" disabled selected>Tipo de usuario.</option>
                    </select>
                  </div>
                  <div class="col l2 s6">
                    <strong class="texto-morado"> y </strong>
                    <select id="sel_verbo" name="verbo" class="browser-default">
                      <option value="" disabled selected>Verbo.</option>
                    </select>
                  </div>
                  <div class='input-field col l3 s12'>
                    <input id='input-complemeto' name='complemeto' maxlength="280" type='text'>
                    <span class='helper-text'>
                      Solución y/o problemática y quién recibe el beneficio.
                    </span>
                  </div>
                  <div class="col l3 s12 center">
                    <br>
                    <a id='btn-agregar-predicado' class='waves-effect waves-light btn green'><i
                        class='material-icons left'>add</i>Agregar</a>
                    <br>
                  </div>
                  <div id="div-predicados" class="col s12"></div>
                </div>
                <div class="divider"></div>
                <br>
                <div class="row">
                  <div class="col s12 right-align">
                    <button class='waves-effect waves-dark btn-flat previous-step'>Atrás</button>
                    <button id="next-btn-predicados" class='waves-effect waves-dark btn next-step'>Siguiente</button>
                  </div>
                </div>
              </div>
            </li>
            <li class='step'>
              <div class='step-title waves-effect' data-step-label=''>Objetivo</div>
              <div class='step-content'>
                <!-- Your step content goes here (like inputs or so) -->
                <!-- ¿Qué objetivos de desarrollo sostenible de la ONU atiende tu proyecto? -->
                <div class="row center">
                  <h5 class="texto-verde bold">¿A qué Objetivos de Desarrollo Sostenible de la ONU contribuye tu
                    proyecto?</h5>
                  <p>Puedes seleccionar los Objetivos de Desarrollo Sostenible más importantes de tu proyecto (máx. 3).
                  </p>
                  <sub><a target="_blank"
                      href="https://www.un.org/sustainabledevelopment/es/2018/08/sabes-cuales-son-los-17-objetivos-de-desarrollo-sostenible">¿Cúales
                      son los Objetivos de Desarrollo Sostenible de la ONU?</a></sub><br>
                </div>
                <div class="row" id="div-objetivos">
                </div>
                <div class="row">
                  <div class="divider"></div>
                  <br>
                  <div class="col s12 right-align">
                    <button class='waves-effect waves-dark btn-flat previous-step'>Atrás</button>
                    <button id="btn-submit-tech" type="submit" class='waves-effect waves-dark btn '>Registrar</button>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </form>
      </div>
    </div>
  </div>

  <?php require "views/include_views/templates/html2.php"?>
  <script src="public/js/newtech.js"></script>