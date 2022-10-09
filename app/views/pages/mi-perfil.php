<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP?></title>
    <?php require (RUTA_APP . '/views/includes/links.php');?>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/mi-perfil.css"/>
</head>
<body>
    <?php require (RUTA_APP . '/views/includes/headernav.php');?>

    <main class = "dashboard">
        <?php
            
        ?>
        <section class="container p-0 mt-4 cajaCuenta bordes">
            <div class="row no-gutters rounded">   
                <!-- Columna de la Imagen -->
                <div class="col-lg-4 imagenUsuario">
                    <div class = "contenedorImg"><img src="<?php echo $_SESSION['profile-photo']; ?>" alt="Foto de perfil" class="mx-auto d-block rounden" width="200px" height="200px"></div>
                    <h2 class="mt-4"><?php echo $_SESSION['nickname']; ?></h2>      
                </div>
                <!-- Columna del formulario -->
                <div class="col-lg-8 pt-4 px-4 py-4 formulario">
                    <div >
                        <!-- Información Personal -->
                        <h2 class="text-center">Información Personal</h2>
                        <form action="" >
                            <div class="d-flex p-2 justify-content-center">
                                <div class="form-group col-lg-6 mb-0">
                                    <label for="">NOMBRE:</label>
                                    <input readonly type="text" class="form-control" placeholder="Nombre" value = "<?php echo $_SESSION['nickname']; ?>">
                                </div>
                                <div class="form-group col-lg-6 mb-0">
                                    <label for="">PUESTO:</label>
                                    <input readonly type="text" class="form-control" placeholder="Puesto" value="<?php echo $_SESSION['Puesto']; ?>">
                                </div>
                            </div>

                            <div class="d-flex p-2 justify-content-center">
                                <div class="form-group col-lg-6 mb-0">
                                    <label for="">FECHA DE NACIMIENTO:</label>
                                    <input readonly type="text" class="form-control" value="<?php echo $_SESSION['FechaNacimiento']; ?>">
                                </div>
                                <div class="form-group col-lg-6 mb-0">
                                    <label for="">SEXO:</label>
                                    <input readonly type="text" class="form-control" value="<?php echo $_SESSION['Sexo']; ?>"> 
                                </div>
                            </div>
                            <div class="d-flex p-2 justify-content-center">
                                <div class="form-group col-lg-6 mb-0">
                                    <label for="">CORREO:</label>
                                    <input readonly type="text" class="form-control" value="<?php echo $_SESSION['Correo']; ?>">
                                </div>
                                <div class="form-group col-lg-6 mb-0">
                                    <label for="">TELEFONO:</label>
                                    <input readonly type="text" class="form-control" placeholder="<?php echo $_SESSION['Telefono']; ?>">
                                </div>  
                            </div>  
                        </form>
                        <hr class="divisor">
                        <!-- Información de la cuenta -->
                        <h2 class="text-center">Datos de perfil</h2>
                        <form action="">
                            <div class="d-flex p-2 justify-content-center">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="idusuario">USUARIO:</label>
                                    <input type="text" class="form-control" id="usuaio" placeholder="Usuario" value="<?php echo $_SESSION['user']; ?>">
                                </div>
                                <div class="form-group col-md-6 mb-1">
                                    <label for="">CONTRASEÑA:</label>
                                    <input type="password" class="form-control" placeholder="Contraseña" id = "password" value="">
                                </div>
                            </div>
                            <div class="form-group col-md-6 m-auto">
                                <button type="submit" class="btn btn-primary w-100 miBoton">Guardar cambios</button>
                            </div>   
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <?php require (RUTA_APP . '/views/includes/scripts.php');?>

    <script>
        $(document).ready(ObtenerContrasena());

        function ObtenerContrasena(){
            $.ajax({
                type: "POST",
                url: "http://localhost/traveler-airlines/Paginas/GetPassword",
                dataType: "json",
            })
            .done(function(respuesta){
                console.log(respuesta);
                $("#password").val(respuesta['Contraseña']);

            })
            .fail(function(){
                console.log("error");
            });
        }

        function CambiarDatosUsuario(Usuario, Password){
            $.ajax({
                type: "POST",
                url: "http://localhost/traveler-airlines/Paginas/GetPassword",
                data: {Usuario: Usuario, Password: Password},
                dataType: "html",
            })
            .done(function(respuesta){
                alert("Se ha modificado exitosamente los datos de usuario.");
            })
            .fail(function(){
                console.log("error");
            });
        }

    </script>
</body>
</html>