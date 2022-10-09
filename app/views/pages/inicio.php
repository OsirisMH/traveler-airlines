<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP?></title>
    <?php require (RUTA_APP . '/views/includes/links.php');?>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/inicio.css"/>
</head>
<body>
    <?php require (RUTA_APP . '/views/includes/headernav.php');?>

    <main class = "dashboard">
    <?php $this->unsetear_variables();?>
        <div class = "container py-4 px-0">
            <div class = "row mx-auto daily-message">
                <div class="col-1 px-0 hello-img">
                    <img src="<?php echo RUTA_URL?>/images/hello.svg" alt="Hola" class="w-100">
                </div>
                <div class = "col-11 p-1">
                    <div class="col-12">
                        <h2>Bienvenido de vuelta <?php echo $_SESSION['nickname']; ?>!</h2>
                    </div>
                    <div class="col-12"><h6>El sistema esta listo para realizar ventas ;)</h6></div>
                </div>
            </div>

            <div class = "row justify-content-between data py-4">
                <div class="col-3">
                    <div class="col-12 usuarios-activos">
                        <img src="<?php echo RUTA_URL?>/images/user-group.png" alt="" width="80px">
                        <div class="d-flex justify-content-between">
                            <h5>Usuarios<br>activos</h5>
                            <h4>1</h4>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="col-12 ventas-realizadas">
                        <img src="<?php echo RUTA_URL?>/images/ventas.png" alt="" width="70px">
                        <div class="d-flex justify-content-between">
                            <h5>Ventas<br>realizadas</h5>
                            <h4><?php echo $_SESSION['CantidadVentas']; ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="col-12 horarios">
                        <img src="<?php echo RUTA_URL?>/images/horario.png" class="pt-1" alt="" width="60px">
                        <div class="row px-3 justify-content-between">
                            <h5>Hora apertura</h5>
                            <h5>6:00</h5>
                        </div>
                        <div class="row px-3 justify-content-between">
                            <h5>Hora cierre</h5>
                            <h5>20:00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="col-12 reloj">
                        <img src="<?php echo RUTA_URL?>/images/reloj.png" class="pt-1" alt="" width="60px">
                        <div class="reloj-fun row justify-content-center">
                            <p id="horas" class="horas"></p>
                            <p>:</p>
                            <p id="minutos" class="minutos"></p>
                            <p>:</p>
                            <div class="caja-segundos">
                                <p id="ampm" class="m-0 ampm"></p>
                                <p id="segundos" class="m-0 pb-3 segundos"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row reports pt-3">
                <div class="col-6">
                    <div class="col-12 ventas-mensuales">
                        <h2>Reporte mensual de ventas</h2><h6>Culiacán, Sinaloa, México</h6><canvas id = "line-chart" height="230" width="400"></canvas>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-12 otros-reportes">
                        <h2>Otros reportes</h2>
                        <h6>Culiacán, Sinaloa, México</h6>
                        <div class="row justify-content-around py-4 botones-reporte-1">
                            <button class="btn btn-primary">Empleados</button>
                            <button class="btn btn-primary">Aviones</button>
                        </div>
                        <div class="row justify-content-around botones-reporte-2">
                            <button class="btn btn-primary">Vuelos</button>
                            <button class="btn btn-primary">Mas</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php require (RUTA_APP . '/views/includes/scripts.php');?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="<?php echo RUTA_URL?>/js/inicio.js"></script>
</body>
</html>