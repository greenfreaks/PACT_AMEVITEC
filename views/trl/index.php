<?php require "views/include_views/templates/html1.php"?>
<div class="section wrapper">
    <div class="">
        <div class="row">
            <div class="col s12">
                <form id="trl-form">
                    <!-- add linear to avoid navigation without validation -->
                    <ul id="preguntas_trl" class='stepper linear horizontal' style='min-height: 500px;'>
                        <li class='step active'>
                            <div class='step-title waves-effect' data-step-label=''>
                                Instrucciones:
                            </div>
                            <div class='step-content'>
                                <p><span>Esta calculadora <b class="texto-marino">determinará el nivel de madurez
                                            tecnológica y comercial (TRL) </b> de tu tecnología, con base en métodos de
                                        madurez sistematizados a nivel internacional. </span><span>Puedes moverte a
                                        través de cada una de las secciones usando los botones "atrás" y "siguiente" en
                                        la parte inferior.</span></p>
                                <ul class="collection">
                                    <li class="collection-item">
                                        <span class="negritas texto-morado">Da clic múltiples veces sobre una casilla
                                            para cambiar tu estado.</span>
                                    </li>
                                    <li class="collection-item">
                                        <span class="negritas"><i
                                                class='material-icons left'>check_box_outline_blank</i>Deja la casilla
                                            sin marcar si tu tecnología no cumple con la afirmación o bien si no estás
                                            seguro de que la cumpla.</span>
                                    </li>
                                    <li class="collection-item">
                                        <span class="negritas"><i class='material-icons left'>done</i>Marca la casilla
                                        </span> sólo cuando tu tecnología cumple con la afirmación con total certeza y
                                        evidencia.
                                    </li>
                                    <li class="collection-item">
                                        <span class="negritas"><i class='material-icons left'>remove</i>Marca como
                                            indeterminado sólo si estás seguro de que la afirmación no aplica para tu
                                            tecnología.</span>
                                    </li>
                                    <li class="collection-item">En caso de que un término sea desconocido, te sugerimos
                                        ver el <span class="negritas texto-marino">glosario</span> de cada categoría.
                                    </li>
                                </ul>
                                <!-- Your step content goes here (like inputs or so) -->
                                <div class='step-actions'>
                                    <!-- Here goes your actions buttons -->
                                    <button class='waves-effect waves-dark btn next-step'>Siguiente</button>
                                </div>
                            </div>
                        </li>
                        <li class='step'>
                            <div class='step-title waves-effect' data-step-label=''>
                                Finalizar evaluación.
                            </div>
                            <div class='step-content'>
                                <!-- Your step content goes here (like inputs or so) -->
                                <h5 class="center texto-verde">¡Casi terminamos!</h5>
                                <p>Estás a punto de finalizar tu evaluación, da clic en <b
                                        class="texto-marino">"FINALIZAR"</b> sólo si estás seguro de haber respondido
                                    con la mayor veracidad.</p>
                                <p>Después de finalizar esta evaluación, podrás visualizar el nivel de madurez de tu
                                    tecnología. </p>
                                <p>Cada tecnología solo puede evaluarse una vez cada 5 días.</p>
                                <p>Si estás listo para continuar, da clic en el botón <b
                                        class="texto-marino">"FINALIZAR".</b></p>
                                <div class='step-actions center'>
                                    <!-- Here goes your actions buttons -->
                                    <button id="btn-submit" class='waves-effect waves-dark btn '
                                        type="submit">Finalizar</button>
                                    <button class='waves-effect waves-dark btn-flat previous-step'>Atrás</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>


<?php require "views/include_views/templates/html2.php"?>
<script src="public/js/trl.js"></script>