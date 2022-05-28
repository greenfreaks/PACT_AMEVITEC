<?php require "views/include_views/templates/html1.php"?>
     <div class="section wrapper">
         <div class="content_container">
             <div id="talentos">
                 <div class="content_container">
                     <p>Busca palabra clave.</p>
                     <input type="text" id="myInput" placeholder="Ingresa palabra clave...">
                     <section class="table_container">
                         <table id="myTable" class="table sticky bold">
                             <thead>
                                 <tr class="tr">
                                     <th>ID de la tecnología</th>
                                     <th style="min-width: 300px;" class="center">Nombre de la tecnología</th>
                                     <th style="min-width: 350px;" class="center">Soluciones que aporta esta tecnología</th>
                                     <th style="min-width: 350px;" class="center">Industrias que se pueden beneficiar de esta tecnología</th>
                                     <th style="min-width: 300px;"> Objetivos sostenibles ONU</th>
                                 </tr>
                             </thead>
                             <tbody>
                             </tbody>

                         </table>
                     </section>
                 </div>
             </div>
         </div>
         <?php require "views/include_views/templates/html2.php"?>
         <script src="public/js/buscadorTecnologias.js"></script>