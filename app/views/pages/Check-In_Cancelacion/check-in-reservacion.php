<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP?></title>
    <?php require (RUTA_APP . '/views/includes/links.php');?>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/check_in_reservacion.css"/>
</head>
<body>
    <?php require (RUTA_APP . '/views/includes/headernav.php');?>

    <main>

    <?php
        // echo "<p>Datos de la reservación</p>";
        // echo "<pre>";
        // print_r($datos);
        // echo "</pre>";
    ?>
        <div class="container contenedorPrincipal">
            <div class = "titulo py-2">
                <h3 class="text-center my-0" id = "titulo">Registro de asistencia</h3>
            </div>
            <?php if(!is_int($datos)): ?>
            <div class="row InfoVuelo m-0">
                <div class="d-flex flex-column w-100 Info">
                    <div class="d-flex flex-row horario">
                        <div class="hora-localidad">
                            <p><?php echo $datos->fecha_salida; ?></p>
                            <p><?php echo $datos->hora_salida; ?></p>
                            <p><?php echo $datos->cod_origen; ?></p>
                        </div>
                        <div class="BarraTiempo"></div>
                        <div class="hora-localidad">
                            <p><?php echo $datos->fecha_llegada; ?></p>
                            <p><?php echo $datos->hora_llegada; ?></p>
                            <p><?php echo $datos->cod_destino; ?></p>
                        </div>
                    </div>
                </div>
                <div class = "col-6"><h6>Aeropuerto de origen: </h6><span><?php echo $datos->aeropuerto_origen; ?></span></div>
                <div class = "col-6 text-right pb-3"><h6>Aeropuerto de destino: </h6><span><?php echo $datos->aeropuerto_destino; ?></span></div>
            </div>
            <div class="row justify-content-between pt-3 NumeroReservacion">
                <div class="col-11">
                    <h6 class = "font-weight-bold">Numero de reservación: </h6>
                </div>
                <div class = "col-1">
                    <span><?php echo $datos->Numero_Reservacion; ?></span>
                </div>
            </div>
            <div class="formCheck">
                <hr>
                <div class="row">
                    <div class="col-12">
                        <ul class = "px-0">
                            <h6 class = "font-weight-bold">Pasajero:</h6>
                            <li>
                                <span>☼ <?php echo $datos->Nombre . ' ' . $datos->Apellido; ?>
                                </span>
                            </li> 
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="col-12 text-center py-3">
                    <button class = "btnConfirmar" id = "btnConfirmar">Confirmar asistencia</button>
                </div>
            </div>
            <?php elseif ($datos == 1): ?>
            <div class="text-center py-2">
                <h3>Ya se realizó el Check-in previamente...</h3>
            </div>
            <?php else: ?>
            <div class="text-center py-2">
                <h3>No se encontró la reservación!..</h3>
            </div>
            <?php endif; ?>
        </div>
    </main>
    
    <?php require (RUTA_APP . '/views/includes/scripts.php');?>
                
    <script>
        $(document).ready(function(){
            if(<?php echo is_int($datos);?>){
                $("#titulo").text("Redirigiendo a la busqueda...");
                setTimeout("location.href='<?php echo RUTA_URL;?>/paginas/check_in_busqueda'", 3000);
            }
        });
    </script>
</body>


<div class="modal fade" id = "ventana1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id = "modal-titulo">Boletos</h4>
            </div>

            <!-- Contenido de la ventan  -->
            <div class="modal-body mx-auto">
                <embed src="<?php echo RUTA_URL?>/paginas/impresion_boleto/" frameborder="0" width="700px" height="500px">
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" id = "btnImprimir">Imprimir boleto</button>
                <button class="btn btn-outline-primary" id = "btnAceptar" disabled>Aceptar</button>
            </div>
        </div>
    </div>  
</div>

<script>
    $("#btnConfirmar").click(function(){
        $('#ventana1').modal({backdrop: 'static', keyboard: false});
        $('#ventana1').modal('show');
        <?php $this->check_in_confirmar($datos->Numero_Reservacion); ?>
    });

    $("#btnImprimir").click(function(){
        $("#btnAceptar").attr("disabled", false);
    });

    $("#btnAceptar").click(function(){
        $("#modal-titulo").text("Redirigiendo...");
        setTimeout("location.href='<?php echo RUTA_URL;?>/Paginas/check_in_busqueda'", 3000);
    });
</script>

</html>