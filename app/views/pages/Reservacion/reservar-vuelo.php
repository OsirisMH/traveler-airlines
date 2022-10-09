<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP?></title>
    <?php require (RUTA_APP . '/views/includes/links.php');?>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/reservar-vuelo.css"/>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/boton-pagar.css"/>
</head>
<body>
    <?php require (RUTA_APP . '/views/includes/headernav.php');?>
    
   
    <main>
        <?php 
            $bandera = false; 
            if($_SESSION['FormVueloSalida']['ClaseVuelo'] == 1){
                $TarifaBase = $datos->costo_turista;
            }
            else{
                $TarifaBase = $datos->costo_ejecutiva;
            }

            $IVA = $TarifaBase * (0.16);
            
            $num_pasajeros = $_SESSION['FormFiltro']['CantidadPasajeros'];

            for($i = 0; $i<$num_pasajeros; $i++){
                $apodos[$i] = generarApodo($i);
            }
        ?>
        <div class = "container mainContainer">
            <div class="container-fluid childContainer">
                <h3 class="text-center font-weight-bold py-3 titulo">Información de la reservación y pago</h3>
                <hr class="linea-divisora">
                <div class="row  ClaseVuelo"><div class="w-100 Clase"><span class="px-3">Turista</span></div></div>

                <div class="row InfoVuelo">
                    <div class="d-flex flex-column w-100 Info">
                        <div class="d-flex flex-row horario">
                            <div class="hora-localidad">
                                <span><?php echo $datos->hora_salida; ?></span>
                                <span><?php echo $datos->cod_origen; ?></span>
                            </div>
                            <div class="BarraTiempo"></div>
                            <div class="hora-localidad">
                                <span><?php echo $datos->hora_llegada; ?></span>
                                <span><?php echo $datos->cod_destino; ?></span>
                            </div>
                        </div>
                        <div class="informacion-adicional">
                            <span>Sin escalas, <?php echo $datos->duracion; ?> minutos.</span>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="w-100 Pasajeros">
                        <h5 class="font-weight-bold">Pasajeros</h5>
                        <?php for($i = 0; $i<$num_pasajeros; $i++):?>
                        <div><span><?php echo $i+1; ?> - </span><span><?php echo $apodos[$i]; ?></span></div>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="w-100 CostoVuelo">
                        <h5 class="font-weight-bold">Costos vuelo</h5>
                        <div><span>Tarifa base:</span><span> <?php echo "$" . round($TarifaBase, 2); ?></span></div>
                        <div class="pt-2"><span>IVA tarifa:</span><span> <?php echo "$" . round($IVA, 2); ?></span></div>
                        <hr>
                        <div><span>Total:</span><span>   <?php echo "$" . round(calcularTotal($num_pasajeros, $TarifaBase, $IVA), 2); ?></span></div>
                    </div>
                </div>
            
                <a href="#" data-backdrop="static" data-keyboard="false" class="" data-toggle = "modal" data-target="#ventanaMetodoPago" id = "pagar">
                    <div class="row justify-content-end py-3">
                        <div class="btnTransaccion" id = "btnTransaccion">
                            <div class="left-side">
                                <div class="card">
                                    <div class="card-line"></div>
                                    <div class="buttons"></div>
                                </div>
                                <div class="post">
                                    <div class="post-line"></div>
                                    <div class="screen">
                                        <div class="dollar">$</div>
                                    </div>
                                    <div class="numbers"></div>
                                    <div class="numbers-line2"></div>
                                </div>
                            </div>
                            <div class="right-side">
                                <div class="new">Pagar</div>
                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 451.846 451.847"><path d="M345.441 248.292L151.154 442.573c-12.359 12.365-32.397 12.365-44.75 0-12.354-12.354-12.354-32.391 0-44.744L278.318 225.92 106.409 54.017c-12.354-12.359-12.354-32.394 0-44.748 12.354-12.359 32.391-12.359 44.75 0l194.287 194.284c6.177 6.18 9.262 14.271 9.262 22.366 0 8.099-3.091 16.196-9.267 22.373z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#cfcfcf"/></svg>
                            </div>
                        </div>
                    </div>
                </a>
                
                
            </div>
        </div>
    </main>

    <?php
        function generarApodo($i){
            $porciones = explode(" ", $_SESSION['FormDatosPasajeros'][$i]['NombrePasajero']);
            $nombre = $porciones[0];
            $porciones = explode(" ", $_SESSION['FormDatosPasajeros'][$i]['ApellidoPasajero']);
            $apellido = $porciones[0];
            return $nombre . " " . $apellido;
        }

        function calcularTotal($num_pasajeros, $TarifaBase, $IVA){
            $total = 0;
            $total = $TarifaBase + $IVA;
            $total = $total * $num_pasajeros;
            return $total;
        }
    ?>

    <?php require (RUTA_APP . '/views/includes/scripts.php');?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
</body>

<div class="modal fade" id = "ventanaMetodoPago">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title" id = "modal-titulo-pago">Información de Pago</h4>
            </div>

            <!-- Contenido de la ventan  -->
            <form target="_blank" id = "formpago" method="POST" action="http://localhost/traveler-airlines/paginas/imprimir_ticket">
                <div class="modal-body mx-auto text-center"> 
                    <div class="form-group">
                        <h6>Forma de pago:</h6>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input checked type="radio" id="Efectivo" name="FormaPago" class="custom-control-input" value="EFECTIVO">
                            <label class="custom-control-label" for="Efectivo">Efectivo</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="Tarjeta" name="FormaPago" class="custom-control-input" value="TARJETA">
                            <label class="custom-control-label" for="Tarjeta">Tarjeta de Crédito</label>
                        </div>
                    </div>
                    <span id = "error"></span>
                    <div class="pagoTarjeta d-none" id = "PagoTarjeta">
                        <div class="form-group" id = "NombreTitular">
                            <label for="NombreTarjeta">Nombre del titular:</label>
                            <input type="text" name = "NombreTitular" class="form-control" id="NombreTarjeta" placeholder="Nombre...">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-10" id = "phone-number">
                                <label for="NumeroTarjeta">Número de tarjeta:</label>
                                <input type="text" name = "NumeroTarjeta" class="form-control" id="NumeroTarjeta" aria-describedby="NumeroHelp" maxlength="25" minlength="25" placeholder="Número de tarjeta...">
                                <small id="NumeroHelp" class="form-text text-muted">Digite el número de 16 digitos de la tarjeta.</small>
                            </div>
                            <div class="form-group col-2" id = "CVC">
                                <label for="CodigoSeguridad">CVC:</label>
                                <input type="password" class="form-control" id="CodigoSeguridad" maxlength="3" placeholder="CVC..">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                            <label for="">Fecha de expiración:</label>
                            </div>
                            <div class="col-6">
                                <select class="custom-select" name="dob-month" id = "Mes">
                                    <option value="">Mes</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <select class="custom-select" name="dob-month" id = "Anio">
                                    <option value="">Año</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name = "tarifa" value="<?php echo $TarifaBase; ?>">
                        <input type="hidden" name = "total" value="<?php echo calcularTotal($num_pasajeros, $TarifaBase, $IVA); ?>">
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" id = "btnCancelar" data-dismiss = "modal">Cancelar</a>
                    <button class="btn btn-outline-primary" type="submit" id = "btnConfirmar">Confirmar</button>
                </div>
            </form>
        </div>
    </div>  
</div>

<div class="modal fade" id = "ventana1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id = "modal-titulo">Información</h4>
            </div>

            <!-- Contenido de la ventan  -->
            <div class="modal-body mx-auto">
                <img id = "imagen" src="<?php echo RUTA_URL?>/images/success.png" alt="" width="70px" class="d-block mx-auto pb-2">
                <h5 id = "mensaje">¡Pago realizado correctamente!</h5>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button class="btn btn-outline-primary" id = "btnAceptar">Volver al inicio</button>
            </div>
        </div>
    </div>  
</div>

<div class="modal fade" id = "ventanaNoProcesado">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Información</h4>
            </div>

            <!-- Contenido de la ventan  -->
            <div class="modal-body mx-auto">
                <img src="<?php echo RUTA_URL?>/images/error.png" alt="" width="70px" class="d-block mx-auto pb-2">
                <h5>¡No se pudo procesar el pago!</h5>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" id = "btnCambio">Utilizar otro método</a>
                <button class="btn btn-outline-primary" id = "btnReintentar">Reintentar</button>
            </div>
        </div>
    </div>  
</div>

<script>
    function reservarVuelo(tarifa){
        $.ajax({
            type: "POST",
            url: "http://localhost/traveler-airlines/paginas/reservar_vuelo", //LINK DEL METODO "http://localhost/traveler-airlines/paginas/reservar_vuelo"
            data: {importe: tarifa},
            dataType: "html",
        })
        .done(function(){
            console.log("REGISTRO REALIZADO");
        })
        .fail(function(){
            console.log("error");
        });
    }

    function vereficarInputVacios(){
        if($('#Tarjeta').is(':checked')){
            if($("#NombreTarjeta").val().length  == 0){
            console.log(1);
            return false;
            }
            if($("#CodigoSeguridad").val().length  == 0){
                console.log(2);
                return false;
            }
            if($("#NumeroTarjeta").val().length  == 0){
                console.log(4);
                return false;
            }
            if($("#NumeroTarjeta").val().length != 25){
                console.log(3);
                return false;
            }
            if($("#Mes").val().length  == 0){
                console.log(5);
                return false;
            }
            if($("#Anio").val().length  == 0){
                console.log(6);
                return false;
            }
        }

        return true;
    }

    $("#formpago").on("submit",function (e) {
        $("#modal-titulo-pago").text("Procesando...");
        var bandera = false;
        bandera = verificarFormaPago();

        if(!vereficarInputVacios()){
            e.preventDefault();
            $("#modal-titulo-pago").text("Información de Pago");
            $("#error").css("color", "red");
            $("#error").text("Faltan campos por rellenar*");
            return;
        }

        if(bandera){
            $('#ventanaMetodoPago').modal('hide');
            $('#ventana1').modal({backdrop: 'static', keyboard: false});
            $('#ventana1').modal('show');
            var tarifaBase = <?php echo calcularTotal($num_pasajeros, $TarifaBase, $IVA); ?>;
            reservarVuelo(tarifaBase);
        }
        else{
            e.preventDefault();
            $("#ventanaMetodoPago").modal('hide');
            $('#ventanaNoProcesado').modal('show');
        }
    });

    //RADIO PARA VEREFICAR LA FORMA DE PAGO
    $("input[type='radio']").change(function(){
        if($('#Tarjeta').is(':checked') == true){
            $("#PagoTarjeta").removeClass("d-none");
        }
        else{
            $("#PagoTarjeta").addClass("d-none");
            $("#error").text("");
        }
    });

    //BOTON PARA CAMBIAR LA FORMA DE PAGO
    $("#btnCambio").click(function(){
        $('#ventanaNoProcesado').modal('hide');
        $('#ventanaMetodoPago').modal('show');
    });

    //BOTON PARA REINTENTAR PAGAR
    $("#btnReintentar").click();

    //BOTON PARA VOLVER AL MENU DE INICIO
    $("#btnAceptar").click(function(){
        $("#modal-titulo").text("Redirigiendo al inicio...");
        setTimeout("location.href='<?php echo RUTA_URL;?>'", 3000);
    });

    $(function(){
        $('#phone-number .form-control').mask("0000 - 0000 - 0000 - 0000",{placeholder: "XXXX - XXXX - XXXX - XXXX"});
    });

    function verificarFormaPago(){
        var Identificador = $("#NumeroTarjeta").val();
        var Identificador = Identificador.substring(0,4);
        
        if($('#Tarjeta').is(':checked')){
            if(Identificador > 4200){
                return true;
            }
        }
        
        if($('#Efectivo').is(':checked')){
            return true;
        }

        return false
    }

    $("#NombreTitular .form-control").bind('keypress', function(event) {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    $("#CVC .form-control").bind('keypress', function(event) {
        var regex = new RegExp("^[0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
</script>

</html>