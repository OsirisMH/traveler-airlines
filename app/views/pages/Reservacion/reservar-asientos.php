<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP?></title>
    <?php require (RUTA_APP . '/views/includes/links.php');?>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/reservar-asientos.css"/>
</head>
<body>
    <?php require (RUTA_APP . '/views/includes/headernav.php');?>

    <main>
        <?php
            // echo "<p>Datos de los pasajeros</p>";
            // echo "<pre>";
            // print_r( $datos['asientosOcupados']);
            // echo "</pre>";

            $cantidad_asientos = 0;
            $num_pasajeros = $_SESSION['FormFiltro']['CantidadPasajeros'];
            for($i = 0; $i<$num_pasajeros; $i++){
                $apodos[$i] = generarApodo($i);
            }
        ?>
        <div class="container-fluid py-2 px-4">
            <h3 class="text-center font-weight-bold">Asientos</h3>
            <div class="row m-0 pt-3"> 
                <!-- ASIENTOS DISPONIBLES -->
                <div class="col-6 px-1 seleccion-asientos">
                    <div id = "ClaseEjecutiva">
                        <!-- CLASE EJECUTIVA -->
                        <?php foreach($datos['ejecutiva'] as $asiento): ?>
                        <?php if($cantidad_asientos % 9 == 0): //IF_FILAS?>
                        <div class="row m-0 py-3 justify-content-around claseEjecutiva">
                        <?php endif; //FIN IF_FILAS?> 
                            <?php if($cantidad_asientos % 3 == 0): //GRUPO_ASIENTOS?>
                            <div class="btn-group asientos" role="group" aria-label="Fila <?php echo $asiento->Fila?>">
                            <?php endif; //FIN IF_GRUPO_ASIENTOS?> 
                                <button type="button" class="btn btn-outline-primary" value = "<?php echo $asiento->Fila . "-" . $asiento->Numero_Asiento?>"><?php echo $asiento->Fila . "-" . $asiento->Numero_Asiento?></button>
                                <?php $cantidad_asientos++; ?>
                            <?php if($cantidad_asientos % 3 == 0): //GRUPO_ASIENTOS?>
                            </div>
                            <?php endif; //FIN IF_GRUPO_ASIENTOS?> 
                        <?php if($cantidad_asientos % 9 == 0 || ($asiento->Fila == 'B' && $cantidad_asientos == 15)): //IF_FILAS?>
                        </div>
                        <?php endif; //FIN IF_FILAS?> 
                        <?php endforeach;?>
                    </div>

                    <div id = "ClaseTurista">
                        <!-- CLASE TURISTA -->
                        <?php $cantidad_asientos = 0; ?>
                        <?php foreach($datos['turista'] as $asiento): ?>
                        <?php if($cantidad_asientos % 9 == 0): //IF_FILAS?>
                        <div class="row m-0 py-3 justify-content-around claseTurista">
                        <?php endif; //FIN IF_FILAS?> 
                            <?php if($cantidad_asientos % 3 == 0): //GRUPO_ASIENTOS?>
                            <div class="btn-group asientos" role="group" aria-label="Fila <?php echo $asiento->Fila?>">
                            <?php endif; //FIN IF_GRUPO_ASIENTOS?> 
                                <button type="button" class="btn btn-outline-primary" value = "<?php echo $asiento->Fila . "-" . $asiento->Numero_Asiento?>"><?php echo $asiento->Fila . "-" . $asiento->Numero_Asiento?></button>
                                <?php $cantidad_asientos++; ?>
                            <?php if($cantidad_asientos % 3 == 0): //GRUPO_ASIENTOS?>
                            </div>
                            <?php endif; //FIN IF_GRUPO_ASIENTOS?> 
                        <?php if($cantidad_asientos % 9 == 0 || ($asiento->Fila == 'F' && $cantidad_asientos == 30)): //IF_FILAS?>
                        </div>
                        <?php endif; //FIN IF_FILAS?> 
                        <?php endforeach;?>
                    </div>
                </div>
                <!-- FIN: ASIENTOS DISPONIBLES -->

                <!-- INFORMACIÓN - AYUDA -->
                <div class="col-6 py-2 px-4 informacion-asientos">
                    <h4>Datos del vuelo</h4>
                    <br>
                    <span id="error" class="error"></span>
                    <form action="<?php echo RUTA_URL?>/paginas/reservar_detalles" method="post" id = "form">
                        <div class= "scrollable">
                            <table class="table table-hover" id = "table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pasajero</th>
                                    <th scope="col">Asiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for($i = 0; $i < $num_pasajeros; $i++): ?>
                                    <tr>
                                        <th scope="row"><?php echo $i+1; ?></th>
                                        <td>
                                            <?php echo $apodos[$i]; ?>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input required readonly class="form-control asiento" type="text" placeholder = "Seleccione asiento..." id="asientos_<?php echo $i+1 ?>" name = "asientoPasajero_<?php echo $i+1 ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row m-0 pt-3 justify-content-end">
                            <div class="col">
                                <div class="row">
                                    <div class="leyendaTurista d-inline-block my-auto"></div><span class="pl-2 pr-4"> - Clase Turista</span>
                                    <div class="leyendaDisabled d-inline-block my-auto"></div><span class="pl-2 pr-4"> - No disponible</span>
                                    <div class="leyendaSeleccionado d-inline-block my-auto"></div><span class="pl-2 pr-4"> - Seleccionado</span>
                                </div>
                                <div class="row">
                                    <div class="leyendaEjecutiva d-inline-block my-auto"></div><span class="pl-2 pr-4"> - Clase Ejecutiva</span>
                                    <div class="leyendaOcupado d-inline-block my-auto"></div><span class="pl-2 pr-4"> - Ocupado</span>
                                </div>
                            </div>
                            <button type = "submit" class="btnContinuar">Continuar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <?php require (RUTA_APP . '/views/includes/scripts.php');?>

    <?php
        function generarApodo($i){
            $porciones = explode(" ", $_SESSION['FormDatosPasajeros'][$i]['NombrePasajero']);
            $nombre = $porciones[0];
            $porciones = explode(" ", $_SESSION['FormDatosPasajeros'][$i]['ApellidoPasajero']);
            $apellido = $porciones[0];
            return $nombre . " " . $apellido;
        }
    ?>

    <script>
        var pasajero = 0;

        $(document).ready(function(){
            var clase = '<?php echo $_SESSION['FormVueloSalida']['ClaseVuelo']; ?>';
            if( clase == 1){
            $("#ClaseEjecutiva :button").attr("disabled", true);
            }
            else{
                $("#ClaseTurista :button").attr("disabled", true);
            }
        });

        $(document).ready(function(){
            var miArray = <?php echo json_encode($datos['asientosOcupados']); ?>;
            for(var clave in miArray){
                $('.seleccion-asientos button').each(function(){
                    if(miArray[clave]['asiento'] == $(this).val()){
                        $(this).attr("disabled", true);
                        $(this).addClass("ocupado");
                    }
                });
            }
        });

        $("#table tr").click(function(){ 
            $(this).addClass('table-active').siblings().removeClass('table-active');  
            pasajero = value=$(this).find('th:first').html();
            $(".seleccion-asientos .selected").attr("disabled", true);
            if($("#asientos_" + pasajero).val() != ""){
                $(".seleccion-asientos button[value = " + $("#asientos_" + pasajero).val() + "]").attr("disabled", false);
            }
        });

        $('.seleccion-asientos button').click(function(){
            var asientobtn = $(this).val();
            var asientoslc = $("#asientos_" + pasajero).val();

            if(pasajero == 0){
                alert("Seleccione un pasajero!");
            }
            else{
                if($(this).hasClass('selected')){
                    $(this).removeClass('selected');
                    $("#asientos_" + pasajero).val("");
                }
                else{
                    if($("#asientos_" + pasajero).val() != ""){
                        $('.seleccion-asientos button[value =' + asientoslc + ']').removeClass('selected');
                    }
                    $(this).addClass('selected');
                    $("#asientos_" + pasajero).val(asientobtn);
                } 
            }
        });

        $("#form").on('submit', function(evt){
            if(!validarForm()){
                evt.preventDefault();
                console.log(4);
                // tu codigo aqui
                if(<?php echo $num_pasajeros; ?> > 1){
                    $("#error").text("*No ha seleccionado los asientos!..");
                }
                else{
                    $("#error").text("*No ha seleccionado un asiento!..");
                }
            }
        });

        function validarForm(){
            var enviar= true;
            $("input").each(function(){
                if ($(this).val().length == 0){
                    console.log(1);
                    enviar = false;
                }
            });
            return enviar;
        }
    </script>
</body>
</html>