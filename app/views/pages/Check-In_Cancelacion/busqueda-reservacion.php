<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP?></title>
    <?php require (RUTA_APP . '/views/includes/links.php');?>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/check_in_busqueda.css"/>
</head>
<body>
    <?php require (RUTA_APP . '/views/includes/headernav.php');?>

    <main>
        <div class="container contenedorPrincipal">
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="check-in-tab" data-toggle="tab" href="#check-in" role="tab" aria-controls="check-in" aria-selected="true">CHECK-IN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cancelacion-tab" data-toggle="tab" href="#cancelacion" role="tab" aria-controls="cancelacion" aria-selected="false">CANCELACIÓN</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <!-- CHECK-IN -->
                <div class="tab-pane fade show active" id="check-in" role="tabpanel" aria-labelledby="check-in-tab">
                    <p class="text-center pt-4">
                        Registra la presencia en el vuelo, con solo dos datos.
                    </p>
                    <form action="<?php echo RUTA_URL?>/paginas/Detalles_Reservacion" method="post" id="FormCheck-In" class="formBusqueda">
                        <div class="row d-flex p-2 justify-content-center">
                            <div class="form-group px-5 pt-4 col-lg-12">
                                <label for="NumeroReservacion" id = "lbl">Número de reservacion</label>
                                <input type="text" name = "NumeroReservacion" id = "txtNumeroReservacion" class="form-control" value="">
                                <small id="ayaUsuario" class="form-text text-muted text-right pb-3 pr-1">Código de reservación o número de boleto</small>
                            </div>
                            <div class="form-group px-5 pt-2 pb-3 col-lg-12">
                                <label for="Apellido" id = "lbl">Apellido</label>
                                <input type="text" name = "Apellido" id = "txtApellido" class="form-control" value="">
                            </div>
                            <div class="col-lg-12 text-center py-3">
                                <input type="hidden" name = "Accion" value = "1">
                                <button class="btn btn-secondary btnBuscar" type="button" id = "btnBuscarCheck">Buscar reservación</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- CANCELACIÓN -->
                <div class="tab-pane fade" id="cancelacion" role="tabpanel" aria-labelledby="cancelacion-tab">
                    <p class="text-center pt-4">
                        Cancele su vuelo, con solo dos datos.
                    </p>
                    <form action="<?php echo RUTA_URL?>/paginas/Detalles_Reservacion" id = "FormCancelar" method="post" class="formBusqueda">
                        <div class="row d-flex p-2 justify-content-center">
                            <div class="form-group px-5 pt-4 col-lg-12">
                                <label for="NumeroReservacion" id = "lbl">Número de reservacion</label>
                                <input type="text" name = "NumeroReservacion" id = "txtNumeroReservacionCancelar" class="form-control" value="">
                                <small id="ayaUsuario" class="form-text text-muted text-right pb-3 pr-1">Código de reservación o número de boleto</small>
                            </div>
                            <div class="form-group px-5 pt-2 pb-3 col-lg-12">
                                <label for="Apellido" id = "lbl">Apellido</label>
                                <input type="text" name = "Apellido" id = "txtApellidoCancelar" class="form-control" value="">
                            </div>
                            <div class="col-lg-12 text-center py-3">
                                <input type="hidden" name = "Accion" value = "0">
                                <button class="btn btn-secondary btnBuscar" type="button" id = "btnBuscarCancelar">Buscar reservación</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
    </main>
    
    <?php require (RUTA_APP . '/views/includes/scripts.php');?>

    <script>
        //AJAX
        function BuscarReservacion_Check(NumeroReservacion, Apellido){
            $.ajax({
                type: "POST",
                url: "http://localhost/traveler-airlines/paginas/Obtener_Reservacion",
                data: {NumeroReservacion: NumeroReservacion, Apellido: Apellido},
                dataType: "json",
            })
            .done(function(Reservacion){
                console.log(Reservacion);
                if(Reservacion != false && Reservacion['Estado'] != 'CANCELADO'){
                    if(Reservacion['Asistencia'] == 'PENDIENTE'){
                        $("#FormCheck-In").submit();
                    }
                    else{
                        alert("Ya se realizó el CHECK-IN previamente.");
                    }
                }
                else{
                    alert("No se encontró la reservación.");
                }
            })
            .fail(function(){
                console.log("error");
            });
        }

        function BuscarReservacion_Cancelar(NumeroReservacion, Apellido){
            $.ajax({
                type: "POST",
                url: "http://localhost/traveler-airlines/paginas/Obtener_Reservacion",
                data: {NumeroReservacion: NumeroReservacion, Apellido: Apellido},
                dataType: "json",
            })
            .done(function(Reservacion){
                console.log(Reservacion);
                if(Reservacion){
                    if(Reservacion['Estado'] != 'CANCELADO'){
                        $("#FormCancelar").submit();
                    }
                    else{
                        alert("Ya se canceló la reservación previamente.");
                    }
                }
                else{
                    alert("No se encontró la reservación.");
                }
            })
            .fail(function(){
                console.log("error");
            });
        }

        //MÉTODOS
        $("#btnBuscarCheck").click(function(){
            var NumeroReservacion = $("#txtNumeroReservacion").val();
            var Apellido = $("#txtApellido").val();
            BuscarReservacion_Check(NumeroReservacion, Apellido);
        });

        $("#btnBuscarCancelar").click(function(){
            var NumeroReservacion = $("#txtNumeroReservacionCancelar").val();
            var Apellido = $("#txtApellidoCancelar").val();
            BuscarReservacion_Cancelar(NumeroReservacion, Apellido);
        });
        
        //ANIMACIÓN FOCUS INPUT - LABEL
        $("input").focus(function(){
            $("input").each(function(){
                $(this).blur(function(){
                    if($(this).val().length <= 0){
                        $("label[for = '" + $(this).attr('name') + "']").removeClass("activo");
                    }
                });
            });
            $("label[for = '" + $(this).attr('name') + "']").addClass("activo");
        });

        $("label").click(function(){
            $("input[name = '" + $(this).attr('for') + "']").focus();
        });
    </script>
</body>
</html>