<?php
    //Cargar config
    require_once 'config/config.php';
    require_once 'helpers/url_helper.php';
    
    require_once '../app/common/User.php';
    require_once  '../app/common/UserSession.php';

    // require_once 'lib/base.php';
    // require_once 'lib/controlador.php';
    // require_once 'lib/core.php';


    //AUTOLOAD PHP - Cargar librerias
    spl_autoload_register(function($nombreClase){
        require_once 'lib/' . $nombreClase . '.php';

    });
?>