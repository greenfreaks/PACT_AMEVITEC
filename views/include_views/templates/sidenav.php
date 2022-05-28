<ul id="slide-out" class="sidenav sidenav-fixed">
    <li>
        <div class="user-view">
            <?php if ($_SESSION['userType'] == 2) :?>
            <div class="background">
                <img class="responsive-img" src="public/img/bg/bg-cta.png">
            </div>
            <a><span class="white-text name">Académico</span></a>
            <?php endif?>
            <!-- =======0 -->
            <?php if ($_SESSION['userType'] == 1) :?>
            <div class="background">
                <img class="responsive-img" src="public/img/bg/businessGray.jpg">
            </div>
            <a><span class="name">Empresario</span></a>
            <?php endif?>
            <!-- =======0 -->
            <?php if ( $_SESSION['userType'] == 3) :?>
            <div class="background">
                <img class="responsive-img" src="public/img/bg/businessGray.jpg">
            </div>
            <a><span class="white-text name">Administrador</span></a>
            <?php endif?>


            <a><span class="white-text email"><?php echo $_SESSION['username'];?></span></a>
        </div>
    </li>
    <style>
        .collapsible .searcher {
            margin-top: 20px;
        }

        .collapsible .collapsible-header i {
            margin-right: 33px;
        }

        .collapsible li .menu {
            padding-left: 30px;
            line-height: 20px;
        }

        .collapsible li .menu a:hover {
            color: #2E3192;
        }

        .collapsible li .body i {
            margin-right: 10px;
        }

        .collapsible li .menu i {
            margin-top: 10px;
        }

        .collapsible li .menu a {
            width: 100%;
            margin-left: 20px;
            font-size: 0.9em;
        }
    </style>
    <?php if ($_SESSION['userType'] == 2 || $_SESSION['userType'] == 1) :?>
    <li>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header menu"><i class="material-icons">biotech</i>Capacidades de IES y Centros
                    de I+D</div>
                <div class="collapsible-body menu body"><a href="../sections/instituciones_labs_form"><i
                            class="material-icons">school</i>Registro Institucional y de Capacidades</a></div>
                <div class="collapsible-body menu body"><a href="index"><i class="material-icons">biotech</i>Inventario
                        de Laboratorios y Tecnologías</a></div>
                <div class="collapsible-body menu body"><a href="directorio_ies"><i
                            class="material-icons">biotech</i>Catálogo de IES y Centros de I+D</a></div>
            </li>
        </ul>
    </li> <br>
    <li><a href="registro_tecnologias" style="line-height: 20px;"><i
                class="material-icons">center_focus_strong</i>Registro de tecnologías</a></li> <br>
    <li><a href="necesidades_industria" style="line-height: 20px;"><i class="material-icons">apartment</i>Necesidades de
            I+D+i de la industria</a></li> <br>
    <li><a href="buscadorPropiedadIntelectual" style="line-height: 20px;"><i
                class="material-icons">admin_panel_settings</i>Oferta de Propiedad Intelectual</a></li> <br>
    <li>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header menu searcher"><i class="material-icons">search</i>Buscador</div>
                <div class="collapsible-body menu"><a href="buscadorTecnologias"><i class="material-icons">memory</i>Tecnologías</a></div>
                <div class="collapsible-body menu"><a href="buscador_talentos"><i class="material-icons">school</i>Talentos</a></div>
            </li>
        </ul>
    </li>

    <!--        <li><a href="#!"><i class="material-icons">cloud</i>Mis datos</a></li>-->
    <?php endif?>

    <?php if ($_SESSION['userType'] == 1) :?>
    <!-- <li><a href="index"><i class="material-icons">widgets</i>Mis Necesidades</a></li> -->
    <!--        <li><a href="#!"><i class="material-icons">cloud</i>Mis datos</a></li> -->
    <?php endif?>

    <?php if ($_SESSION['userType'] == 3) :?>
    <li>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header menu"><i class="material-icons">biotech</i>Capacidades de IES y Centros
                    de I+D</div>
                <div class="collapsible-body menu body"><a href="../sections/instituciones_labs_form"><i
                            class="material-icons">school</i>Registro Institucional y de Capacidades</a></div>
                <div class="collapsible-body menu body"><a href="index"><i class="material-icons">biotech</i>Inventario
                        de Laboratorios y Proyectos</a></div>
                <div class="collapsible-body menu body"><a href="directorio_ies"><i
                            class="material-icons">biotech</i>Catálogo de IES y Centros de I+D</a></div>
            </li>
        </ul>
    </li> <br>
    <li><a href="adminpanel"><i class="material-icons">assessment</i>Resumen</a></li>
    <li><a href="reportes"><i class="material-icons">assignment</i>Generar Reporte</a></li>
    <li><a href="user_list"><i class="material-icons">admin_panel_settings</i>Usuarios del PACT</a></li> <br>
    <li><a href="licencias"><i class="material-icons">widgets</i>Licencias</a></li>

    <?php endif?>

    <!-- <li><a href="ayuda"><i class="material-icons">help_outline</i>Ayuda y contacto</a></li> -->
    <li>
        <div class="divider"></div>
    </li>
    <li><a href="login/logout"><i class="material-icons red-text">power_settings_new</i>Cerrar sesión</a></li>
    <!-- <li class="bottomLi">
        <img class="responsive-img" src="public/img/logos/logo_p3.png" />
    </li> -->
</ul>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.collapsible');
        var instances = M.Collapsible.init(elems, options);
    });

    // Or with jQuery

    $(document).ready(function () {
        $('.collapsible').collapsible();
    });

    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.dropdown-trigger');
        var instances = M.Dropdown.init(elems, options);
    });

    instance.open();

    instance.close();
</script>