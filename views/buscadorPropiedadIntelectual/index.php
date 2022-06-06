<?php require "views/include_views/templates/html1.php"?>
    <div class="section wrapper texto-negro">
        <div class="content_container">
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

                    </tbody>
                </table>
            </section>
        </div>
    </div>


    <?php require "views/include_views/templates/html2.php"?>
    <script src="public/js/buscadorPI.js"></script>