<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <!-- Icono de la APP -->
    <link rel="icon" href="<?php echo RUTA_URL?>/images/Logo.png" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/login.css"/>
</head>
<body>
    <main>
      <div class="row no-gutters">
        <div class="col-lg-7 d-none d-lg-block galeria"> <!-- Slide de Fotos -->
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item img1 min-vh-100 active">
                  <div class="carousel-caption d-none d-md-block">
                      <h5>Vive tu sueño, vuela con nosotros</h5>
                      <p>Porqué para tener algo bueno no es neceario gastar mucho</p>
                  </div>
                </div>
                <div class="carousel-item img2 min-vh-100">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Vive tu sueño, vuela con nosotros</h5>
                    <p>Porqué para tener algo bueno no es neceario gastar mucho</p>
                  </div>
                </div>
                <div class="carousel-item img3 min-vh-100 ">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Vive tu sueño, vuela con nosotros</h5>
                    <p>Porqué para tener algo bueno no es neceario gastar mucho</p>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
          </div>
        </div>

        <div class="col-lg-5 formulario">
          <div class="row mx-0 justify-content-center">
            <div class="align-items-center py-5 logo-login">
              <img src="<?php echo RUTA_URL?>/images/Logo.png" alt="" width="60px" class="d-inline mx-3">
              <h2 class="d-inline align-middle">Traveler Airlines</h2>
            </div>
          </div>
          <div class = "formulario-inputs my-2">
            <h3>Bienvenido!</h3>
            <form action="" method="POST" class="py-1">
            <span class="text-light m">
              <?php 
                if(isset($datos['errorLogin'])){
                  echo $datos['errorLogin'];
                }
              ?>
            </span>
              <div class="form-group pb-3">
                <input type="text" class="form-control border-0" required id="usuario" name = "usuario" aria-describedby="ayudaUsuario">
                <label for="usuario" class="font-weight-bold">Usuario</label>
                <small id="ayudaUsuario" class="form-text text-muted">Acceso restringido, usuarios solamente autorizados</small>
              </div>
              <div class="form-group mb-2">
                <input type="password" class="form-control border-0" required id="contraseña" name = "contraseña">
                <label for="contraseña" class="font-weight-bold">Contraseña</label>
              </div>
              <div class="form-check ml-3 pb-3">
                <input id = "defaultCheck1" type="checkbox" class="form-check-input" onclick="myFunction()">
                <label class="form-check-label px-3" for="defaultCheck1">Mostrar contraseña</label>
              </div>
              <div class="text-center py-5 contenedor-btn">
                <button type="submit" class="miBoton">Ingresar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
      function myFunction() {
        var x = document.getElementById("contraseña");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>
  </body>
</html>