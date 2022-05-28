<?php require "views/include_views/templates/html1.php"?>
    <div class="section wrapper texto-negro">
        <div class="content_container">
            <h3>Input</h3>
            <section class="priopiedad__filters">
                <p>Tipo de Propiedad</p>
                <select class="table-filter" data-col="3">
                    <option value="">Select one</option>
                    <option value="1">Test service</option>
                    <option value="2">Test2 service</option>
                    <option value="3">Modelo de utilidad</option>
                    <option value="3">Circuito integrado</option>
                </select>
            </section>
            <section class="table_container">
                <table id="testTable" class="table sticky">
                    <thead>
                        <tr class="tr">
                            <th scope="col" class="center" style="min-width: 250px;">Nombre de la tecnología</th>
                            <th scope="col" class="center" style="min-width: 250px;">Titular</th>
                            <th scope="col" class="center" style="min-width: 250px;">Inventores</th>
                            <th scope="col" class="center" style="min-width: 250px;">Tipo de Propiedad Intelectual</th>
                            <th scope="col" class="center" style="min-width: 250px;">Título</th>
                            <th scope="col" class="center" style="min-width: 250px;">Resumen</th>
                            <th scope="col" class="center" style="min-width: 250px;">Estatus</th>
                            <th scope="col" class="center" style="min-width: 250px;">Nivel TRL de la tecnología</th>
                            <th scope="col" class="center" style="min-width: 250px;">Región de la protección</th>
                            <th scope="col" class="center">No. de patente/ Solicitud/ Registro</th>
                            <th scope="col" class="center" style="min-width: 250px;">Enlace Web a la patente</th>
                        </tr>
                    </thead>
                    <tbody id="report">

                        <!-- <tr>
                            <td>9</td>
                            <td> 17/07/2018</td>
                            <td> Test project</td>
                            <td> Test service</td>
                            <td> Mario</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td> 18/07/2018</td>
                            <td> Test project</td>
                            <td> Test2 service</td>
                            <td> Juan</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td> 17/07/2018</td>
                            <td> Test2</td>
                            <td> Test2 service</td>
                            <td> Pedro</td>
                        </tr>
                        <tr style="">
                            <td>3</td>
                            <td> 19/07/2018</td>
                            <td> Test2</td>
                            <td> Test service</td>
                            <td> Lalo</td>
                        </tr> -->

                    </tbody>
                </table>
                <div id="niveltrl"></div>
            </section>
        </div>
    </div>


    <?php require "views/include_views/templates/html2.php"?>
    <script src="public/js/buscadorPI.js"></script>