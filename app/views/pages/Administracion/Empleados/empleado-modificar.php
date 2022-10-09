<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP?></title>
    <?php require (RUTA_APP . '/views/includes/links.php');?>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/empleados-registro.css"/>
</head>
<body>
    <?php require (RUTA_APP . '/views/includes/headernav.php');?>

    <main>
        <div class = "container datos-pasajeros py-4">
            <div class = "titulo d-flex justify-content-between py-1 px-3">
                <h4 class = "text-uppercase font-weight-bold text-light d-inline" id = "titulo">MODIFICAR EMPLEADO</h4>
                <a href="<?php echo RUTA_URL?>/paginas/administrar_empleados" class="text-right text-light">
                    <?xml version="1.0"?>
                    <div class = "d-inline">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="18" height="18" x="0" y="0" viewBox="0 0 490.667 490.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g>
                            <path xmlns="http://www.w3.org/2000/svg" d="M245.333,0C109.839,0,0,109.839,0,245.333s109.839,245.333,245.333,245.333  s245.333-109.839,245.333-245.333C490.514,109.903,380.764,0.153,245.333,0z" fill="#253083" data-original="#009688" class=""/>
                            <path xmlns="http://www.w3.org/2000/svg" d="M373.333,192H249.749l19.2-19.2c18.893-18.881,18.902-49.503,0.021-68.395  c-0.007-0.007-0.014-0.014-0.021-0.021c-19.179-18.247-49.317-18.181-68.416,0.149L82.219,222.699  c-12.492,12.496-12.492,32.752,0,45.248l118.315,118.187c17.565,20.137,48.13,22.222,68.267,4.656  c20.137-17.565,22.222-48.13,4.656-68.267c-1.445-1.656-3-3.212-4.656-4.656l-19.2-19.2h123.733  c29.455,0,53.333-23.878,53.333-53.333S402.789,192,373.333,192z" fill="#fafafa" data-original="#fafafa" class=""/>
                        </svg>
                    </div>
                    Regresar
                </a>
            </div>
            <form action="<?php echo RUTA_URL?>/paginas/administrar_modificar_empleado/<?php echo $datos['NumeroEmpleado']; ?>" class = "py-3" method="POST">
                <div class="form-group">
                    <div class="form-group row txtNombre">
                        <label for="inputNombre" class="col-sm-2 col-form-label">Nombre:</label>
                        <div class="col-sm-10">
                        <input required pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" title= "¡No se permiten números!" type="text" class="form-control" name = "NombreEmpleado" id="inputNombre" placeholder="Nombre" value="<?php echo $datos['Nombre']; ?>">
                        </div>
                    </div>
                    <div class="form-group row txtApellido">
                        <label for="inputApellido" class="col-sm-2 col-form-label">Apellido:</label>
                        <div class="col-sm-10">
                        <input required pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" title= "¡No se permiten números!" type="text" class="form-control" name = "ApellidoEmpleado" id="inputApellido" placeholder="Apellido" value = "<?php echo $datos['Apellido']; ?>">
                        </div>
                    </div>
                    <div class="form-group row txtFechaNacimiento">
                        <label for="inputFechaNacimiento" class="col-sm-2 col-form-label">Fecha de nacimiento:</label>
                        <div class="col-sm-10">
                        <input required type="date" class="form-control" name = "FechaNacimientoEmpleado" id="inputFechaNacimiento"  value = "<?php echo $datos['Fecha_Nacimiento']; ?>">
                        </div>
                    </div>
                    <div class="form-group row txtSexo">
                        <legend class="col-form-label col-sm-2 pt-0">Sexo:</legend>
                        <div class="form-check form-check-inline pl-3">
                            <input required class="form-check-input" type="radio" name="sexo" id="radioMasculino" value="M">
                            <label class="form-check-label" for="radioMasculino">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input required class="form-check-input" type="radio" name="sexo" id="radioFemenino" value="F">
                            <label class="form-check-label" for="radioFemenino">Femenino</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="form-group row txtCorreo">
                        <label for="inputCorreo" class="col-sm-2 col-form-label">Correo:</label>
                        <div class="col-sm-10">
                        <input required type="email" class="form-control" name = "CorreoEmpleado" id="inputCorreo" placeholder="Correo Electronico" value = "<?php echo $datos['Correo']; ?>">
                        </div>
                    </div>
                    <div class="form-group row txtTelefono" id = "phone-number">
                        <label for="inputTelefono" class="col-sm-2 col-form-label">Telefono:</label>
                        <div class="col-sm-10">
                        <input required type="text" class="form-control" name = "TelefonoEmpleado" id="inputTelefono" placeholder="Telefono" value = "<?php echo $datos['Telefono']; ?>">
                        </div>
                    </div>
                    <div class="form-group row selectPuesto">
                        <label for="Puesto" class="col-sm-2 col-form-label">Puesto:</label>
                        <div class="col-sm-10">
                            <select required class="custom-select mr-sm-2" id="Puesto" name="PuestoEmpleado">
                                <option selected value = "">Seleccione una opción...</option>
                                <option value="ADMINISTRADOR">Administrador</option>
                                <option value="VENTAS">Ventas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end m-0 pt-4 btnContinuar">
                    <div class = "px-3">
                        <button type="reset" id = "btnReset" class="">Restablecer formulario</button>
                    </div>
                    <button type="submit" id = "btnContinuar" class="">Actualizar</button>
                </div>
            </form>
    </main>
    
    <?php require (RUTA_APP . '/views/includes/scripts.php');?>
    <script src="<?php echo RUTA_URL;?>/js/jQuery-Input-Mask-Phone-Numbers/dist/jquery-input-mask-phone-number.min.js"></script>
    <script>
        $(document).ready(function(){
            var Sexo = "<?php echo $datos['Fecha_Nacimiento']; ?>";
            var Puesto = "<?php echo $datos['Puesto']; ?>";

            if(Sexo == $("#radioFemenino").val()){
                $("#radioFemenino").attr('checked', true);
            }
            else{
                $("#radioMasculino").attr('checked', true);
            }

            $("select option").each(function(){
                if($(this).val() == Puesto){
                    $(this).attr('selected', true);
                }
            });
        });

        $(function(){
            $('#phone-number .form-control').usPhoneFormat({
                format:'(xxx) xxx-xxxx'
            });
        });
    </script>
</body>
</html>