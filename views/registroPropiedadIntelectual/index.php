<?php require "views/include_views/templates/html1.php"?>
<div class="section wrapper">
    <div class="container">
        <form method="post" autocomplete="off " id="form__registroPropiedad">

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
                <input id="form__registroPropiedad--tituloPropiedad" name="tituloPropiedad" type="text" class="validate"
                    required>
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
                <h6>Estatus</h6>
                <div class="input-field col l6 s12">
                    <select data-last_valid_selection="" id="form__registroPropiedad--estatusPropiedad"
                        name="estatusPropiedad" required>
                    </select>
                </div>
            </div> <br>

            <!-- Región de la Protección (Select llenado desde JS) -->
            <div class="row">
                <h6><i class="material-icons prefix">public</i> Selecciona Las regiones a las que pertenezca tu Propiedad Intelectual</h6>
                <div id="ckRegion" class='col s12 l6'>
                    <p>
                        <label>
                            <input type='checkbox' name='fk_regionPropiedad' val='1' />
                            <span>EEUU y Canadá</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type='checkbox' name='fk_regionPropiedad' val='2' />
                            <span>México</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type='checkbox' name='fk_regionPropiedad' val='3' />
                            <span>Centro - Sudamérica</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type='checkbox' name='fk_regionPropiedad' val='4' />
                            <span>Europa</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type='checkbox' name='fk_regionPropiedad' val='5' />
                            <span>África</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type='checkbox' name='fk_regionPropiedad' val='6' />
                            <span>Oceanía</span>
                        </label>
                    </p>
                </div>
            </div>

            <!-- Numero de la patente -->
            <div class="input-field col l4 s12 ">
                <i class="material-icons prefix">tag</i>
                <input id="form__registroPropiedad--numeroPatentePropiedad" name="numeroPatentePropiedad" type="text"
                    class="validate" required>
                <label for="form__registroPropiedad--numeroPatentePropiedad">No. de patente / solicitud /
                    registro...</label>
            </div>

            <!-- Enlace Web -->
            <div class="input-field col l4 s12 ">
                <i class="material-icons prefix">link</i>
                <input id="form__registroPropiedad--linkPropiedad" name="linkPropiedad" type="text" class="validate"
                    required>
                <label for="form__registroPropiedad--linkPropiedad">Enlace Web a la patente...</label>
            </div> <br>

            <button id="form__registroPropiedad--submit" type="submit" class="btn">Registrar</button>
        </form>
    </div>
</div>


<?php require "views/include_views/templates/html2.php"?>
<script src="public/js/registroPropiedadIntelectual.js"></script>