 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="description"
         content="Somos la Agencia Mexicana de Vinculación Tecnológica, una asociación civil sin fines de lucro dedicada a promover, gestionar y capacitar la vinculación entre empresas y universidades.">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>PACT</title>
     <!--Import Google Icon Font-->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

     <!-- Compiled and minified JavaScript -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

     <!-- Compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

     <!--Import jQuery before materialize.js-->
     <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

     <link rel="stylesheet" href="public/css/style.css">


     <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">-->

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

     <!-- DATA TABLES CSS -->
     <link rel="stylesheet" type="text/css" href="public/libraries/DataTables/datatables.min.css" />

     <title>
     </title>
 </head>

 <body>
     <div class="navbar-fixed">
         <nav>
             <div class="nav-wrapper container">
                 <a class="brand-logo center">Tecnologías</a>
                 <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
             </div>
         </nav>
     </div>

     <?php require 'views/sidenav.php'; ?>
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

         <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
         <script src="public/js/buscadorTecnologias.js"></script>

         <!-- DATA TABLES JS -->
         <!-- <script>
             $(document).ready(function () {
                 $("#myInput").on("keyup", function () {
                     var value = $(this).val().toLowerCase();
                     $("#myTable tr").filter(function () {
                         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                     });
                 });
             });
         </script> -->




 </body>

 </html>