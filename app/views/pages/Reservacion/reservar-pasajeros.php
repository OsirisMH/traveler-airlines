<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP?></title>
    <?php require (RUTA_APP . '/views/includes/links.php');?>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/reservar-pasajeros.css"/>
</head>
<body>
    <?php require (RUTA_APP . '/views/includes/headernav.php');?>

    <main>
        <?php
            $num_pasajeros = $_SESSION['FormFiltro']['CantidadPasajeros'];
        ?>
        <div class="container py-3 datos-pasajeros">
            <h3 class="font-weight-bold">Datos de los pasajeros</h3><span class = "errorMensaje" id = "error"></span>
            <hr class="linea-titulo">
            <form action="<?php echo RUTA_URL?>/paginas/reservar_asientos/" method="post" id="datos" autocomplete="off">
                <div class = "accordion" id = "pasajeros">
                    <?php for($i = 0; $i<$num_pasajeros; $i++): ?>
                    <div class="card">
                        <div class="card-header pasajero" id = "pasajero_<?php echo $i+1; ?>">
                            <h4 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#infoPasajero_<?php echo $i+1; ?>" aria-expanded="true" aria-controls="infoPasajero_<?php echo $i+1; ?>">
                                Pasajero <?php echo $i+1; ?>
                                </button>
                            </h4>
                        </div>
                        <div id = "infoPasajero_<?php echo $i+1; ?>" class="collapse" aria-labelledby="pasajero_<?php echo $i+1; ?>" data-parent="#pasajeros">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group row txtNombre">
                                        <label for="inputNombre_<?php echo $i+1; ?>" class="col-sm-2 col-form-label">Nombre:</label>
                                        <div class="col-sm-10">
                                        <input required pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" title= "¡No se permiten números!" type="text" class="form-control" name = "NombrePasajero_<?php echo $i+1; ?>" id="inputNombre_<?php echo $i+1; ?>" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="form-group row txtApellido">
                                        <label for="inputApellido_<?php echo $i+1; ?>" class="col-sm-2 col-form-label">Apellido:</label>
                                        <div class="col-sm-10">
                                        <input required pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" title= "¡No se permiten números!" type="text" class="form-control" name = "ApellidoPasajero_<?php echo $i+1; ?>" id="inputApellido_<?php echo $i+1; ?>" placeholder="Apellido">
                                        </div>
                                    </div>
                                    <div class="form-group row txtFechaNacimiento">
                                        <label for="inputFechaNacimiento_<?php echo $i+1; ?>" class="col-sm-2 col-form-label">Fecha de nacimiento:</label>
                                        <div class="col-sm-10">
                                        <input required type="date" class="form-control" name = "FechaNacimientoPasajero_<?php echo $i+1; ?>" id="inputFechaNacimiento_<?php echo $i+1; ?>" value = "">
                                        </div>
                                    </div>
                                    <div class="form-group row txtSexo">
                                        <legend class="col-form-label col-sm-2 pt-0">Sexo:</legend>
                                        <div class="form-check form-check-inline">
                                            <input required checked class="form-check-input" type="radio" name="sexo_<?php echo $i+1; ?>" id="radioMasculino_<?php echo $i+1; ?>" value="M">
                                            <label class="form-check-label" for="radioMasculino_<?php echo $i+1; ?>">Masculino</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input required class="form-check-input" type="radio" name="sexo_<?php echo $i+1; ?>" id="radioFemenino_<?php echo $i+1; ?>" value="F">
                                            <label class="form-check-label" for="radioFemenino_<?php echo $i+1; ?>">Femenino</label>
                                        </div>
                                    </div>
                                </div>
                                <h5 class = "py-1">Datos de contacto:</h5>
                                <div class="form-group">
                                    <div class="form-group row txtTelefono" id = "phone-number">
                                        <label for="inputTelefono_<?php echo $i+1; ?>" class="col-sm-2 col-form-label">Telefono:</label>
                                        <div class="col-sm-10">
                                        <input required type="text" class="form-control" name = "TelefonoPasajero_<?php echo $i+1; ?>" id="inputTelefono_<?php echo $i+1; ?>" placeholder="Telefono">
                                        </div>
                                    </div>
                                    <div class="form-group row txtCorreo">
                                        <label for="inputCorreo_<?php echo $i+1; ?>" class="col-sm-2 col-form-label">Correo:</label>
                                        <div class="col-sm-10">
                                        <input required type="email" class="form-control" name = "CorreoPasajero_<?php echo $i+1; ?>" id="inputCorreo_<?php echo $i+1; ?>" placeholder="Correo Electronico">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                <div class="row justify-content-end m-0 pt-4 btnContinuar">
                    <button type="submit" id = "continuar" class="">Continuar</button>
                </div>
            </form>
        </div>
    </main>
    
    <?php require (RUTA_APP . '/views/includes/scripts.php');?>
    <script src="<?php echo RUTA_URL;?>/js/jQuery-Input-Mask-Phone-Numbers/dist/jquery-input-mask-phone-number.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#pasajeros:first-child .collapse").collapse('toggle');
        });

        $("#continuar").on("click", function() {
            if (!$("#datos")[0].checkValidity()) {
                $(".datos-pasajeros #error").text('*Faltan campos por llenar!');
                $("#pasajeros .collapse").addClass('show');
            }
        });

        $(function(){
            $('#phone-number .form-control').usPhoneFormat({
                format:'(xxx) xxx-xxxx'
            });
        });
    </script>
</body>
</html>