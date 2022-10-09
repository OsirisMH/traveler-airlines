<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP?></title>
    <?php require (RUTA_APP . '/views/includes/links.php');?>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/administracion.css"/>
</head>
<body>
    <?php require (RUTA_APP . '/views/includes/headernav.php');?>

    <main>
        <!-- CARTAS -->
        <div class="container py-5 contenedor">
            <!-- Carta 1 -->
            <div class="carta">
                <div class="cara cara1">
                    <div class="contenido">
                        <img src="<?php echo RUTA_URL?>/images/empleados.png" alt="">
                        <h3>Empleados</h3>
                    </div>
                    <a href="<?php echo RUTA_URL?>/paginas/administrar_empleados" class="stretched-link"></a>
                </div>
                <div class="cara cara2">
                    <div class="contenido">
                        <p class="text-justify">
                        Registra, consulta o modifica información del personal. Ademas de administrar las cuentas de los usuarios registrados en el sistema.
                        </p>
                    </div>
                    <a href="<?php echo RUTA_URL?>/paginas/administrar_empleados" class="stretched-link"></a>
                </div>
            </div> <!-- Carta 1 -->

            <!-- Carta 2 -->
            <div class="carta">
                <div class="cara cara1">
                    <div class="contenido">
                        <img src="<?php echo RUTA_URL?>/images/vuelos.png" alt="">
                        <h3>Vuelos</h3>
                    </div>
                    <a href="<?php echo RUTA_URL?>/paginas/administrar_vuelos" class="stretched-link"></a>
                </div>
                <div class="cara cara2">
                    <div class="contenido">
                        <p class="text-justify">
                            Registra, consulta o modifica información de los vuelos, las rutas y aeropuertos.
                        </p>
                    </div>
                    <a href="<?php echo RUTA_URL?>/paginas/administrar_vuelos" class="stretched-link"></a>
                </div>
            </div> <!-- Carta 2 -->

            <!-- Carta 3 -->
            <div class="carta">
                <div class="cara cara1">
                    <div class="contenido">
                        <img src="<?php echo RUTA_URL?>/images/aviones.png" alt="">
                        <h3>Aviones</h3>
                    </div>
                    <a href="<?php echo RUTA_URL?>/paginas/administrar_aviones" class="stretched-link"></a>
                </div>
                <div class="cara cara2">
                    <div class="contenido">
                        <p class="text-justify">
                            Registra, consulta o modifica información de los aviones.
                        </p>
                    </div>
                    <a href="<?php echo RUTA_URL?>/paginas/administrar_aviones" class="stretched-link"></a>
                </div>
            </div> <!-- Carta 3 -->
        </div>
    </main>
    
    <?php require (RUTA_APP . '/views/includes/scripts.php');?>
</body>
</html>