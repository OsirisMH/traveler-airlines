
<header class="sticky-top">
    <!-- Cabecera Principal -->
    <div class="container-fluid d-flex justify-content-between align-items-center cabecera">
        <div class="menu-obj">
            <img src="<?php echo RUTA_URL?>/images/Logo.png" class = "d-inline" width="50px" id="img">
            <div class = "d-inline nombre-empresa">
                <span>Traveler Airlines</span>
            </div>
        </div>
        <div class="dropdown perfil">
            <a class="btn btn-light dropdown-toggle boton" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span><?php echo $_SESSION['nickname']; ?></span>
                <img src="<?php echo $_SESSION['profile-photo']; ?>" alt="" height="45px">
            </a>
            
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="<?php echo RUTA_URL?>/paginas/perfil">Ver perfil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo RUTA_URL?>/paginas/cerrarSesion">Cerrar Sesión</a>
            </div>
        </div>
    </div>
    <nav class="navbar_header">
        <ul class="navbar-nav_header">
            <li class="logo" id = "logo">
            <a class="nav-link_header">
                <span class="link-text_header logo-text">Menú</span>
                <svg
                    aria-hidden="true"
                    focusable="false"
                    data-prefix="fad"
                    data-icon="angle-double-right"
                    role="img"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512"
                    class="svg-inline--fa fa-angle-double-right fa-w-14 fa-5x"
                >
                    <g class="fa-group">
                    <path
                        fill="currentColor"
                        d="M224 273L88.37 409a23.78 23.78 0 0 1-33.8 0L32 386.36a23.94 23.94 0 0 1 0-33.89l96.13-96.37L32 159.73a23.94 23.94 0 0 1 0-33.89l22.44-22.79a23.78 23.78 0 0 1 33.8 0L223.88 239a23.94 23.94 0 0 1 .1 34z"
                        class="fa-secondary"
                    ></path>
                    <path
                        fill="currentColor"
                        d="M415.89 273L280.34 409a23.77 23.77 0 0 1-33.79 0L224 386.26a23.94 23.94 0 0 1 0-33.89L320.11 256l-96-96.47a23.94 23.94 0 0 1 0-33.89l22.52-22.59a23.77 23.77 0 0 1 33.79 0L416 239a24 24 0 0 1-.11 34z"
                        class="fa-primary"
                    ></path>
                    </g>
                </svg>
            </a>
            </li>

            <li class="nav-item_header" id = "nav_inicio">
                <a href="<?php echo RUTA_URL?>" class="nav-link_header">
                <img src="<?php echo RUTA_URL?>/images/inicio.png" alt="">
                <span class="link-text_header">INICIO</span>
                </a>
            </li>

            <li class="nav-item_header" id = "nav_reservar">
            <a href="<?php echo RUTA_URL?>/paginas/reservar_filtro" class="nav-link_header">
                <img src="<?php echo RUTA_URL?>/images/reservar.png" alt="">
                <span class="link-text_header">RESERVACIONES</span>
            </a>
            </li>

            <li class="nav-item_header" id = "nav_documentar">
            <a href="#" class="nav-link_header">
                <img src="<?php echo RUTA_URL?>/images/documentar.png" alt="">
                <span class="link-text_header">DOCUMENTACIÓN</span>
            </a>
            </li>

            <li class="nav-item_header" id = "nav_check_in">
            <a href="<?php echo RUTA_URL?>/paginas/check_in_busqueda" class="nav-link_header">
                <img src="<?php echo RUTA_URL?>/images/check-in.png" alt="">
                <span class="link-text_header">CHECK-IN / CANCELACIÓN</span>
            </a>
            </li>

            <li class="nav-item_header" id = "nav_facturar">
            <a href="<?php echo RUTA_URL?>/paginas/facturar" class="nav-link_header">
                <img src="<?php echo RUTA_URL?>/images/facturar.png" alt="">
                <span class="link-text_header">FACTURACIÓN</span>
            </a>
            </li>

            <?php if($_SESSION['Puesto'] == 'ADMINISTRADOR'): ?>
            <li class="nav-item_header" id = "nav_administracion">
            <a href="<?php echo RUTA_URL?>/paginas/administracion" class="nav-link_header">
                <img id = "admin_imagen" src="<?php echo RUTA_URL?>/images/administracion.png" alt="">
                <span class="link-text_header">ADMINISTRACIÓN</span>
            </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>  