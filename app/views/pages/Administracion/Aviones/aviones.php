<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP?></title>
    <?php require (RUTA_APP . '/views/includes/links.php');?>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/empleados.css"/>
</head>
<body>
    <?php require (RUTA_APP . '/views/includes/headernav.php');?>

    <main>
        <div class="container-fluid px-5 py-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="empleados-tab" data-toggle="tab" href="#empleados" role="tab" aria-controls="empleados" aria-selected="true">Aviones</a>
                </li>
                <li class="nav-item" id="regresar-tab" data-toggle="" href="#regresar" role="" aria-controls="regresar" aria-selected="false">
                    <a class="nav-link" id="regresar-tab" href="<?php echo RUTA_URL?>/paginas/administracion">
                        <?xml version="1.0"?>
                        <div class = "d-inline">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="18" height="18" x="0" y="0" viewBox="0 0 490.667 490.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g>
                                <path xmlns="http://www.w3.org/2000/svg" d="M245.333,0C109.839,0,0,109.839,0,245.333s109.839,245.333,245.333,245.333  s245.333-109.839,245.333-245.333C490.514,109.903,380.764,0.153,245.333,0z" fill="#253083" data-original="#009688" class=""/>
                                <path xmlns="http://www.w3.org/2000/svg" d="M373.333,192H249.749l19.2-19.2c18.893-18.881,18.902-49.503,0.021-68.395  c-0.007-0.007-0.014-0.014-0.021-0.021c-19.179-18.247-49.317-18.181-68.416,0.149L82.219,222.699  c-12.492,12.496-12.492,32.752,0,45.248l118.315,118.187c17.565,20.137,48.13,22.222,68.267,4.656  c20.137-17.565,22.222-48.13,4.656-68.267c-1.445-1.656-3-3.212-4.656-4.656l-19.2-19.2h123.733  c29.455,0,53.333-23.878,53.333-53.333S402.789,192,373.333,192z" fill="#fafafa" data-original="#fafafa" class=""/>
                            </svg>
                        </div>
                        Regresar
                    </a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="empleados" role="tabpanel" aria-labelledby="empleados-tab">
                <div class="col-12">
                    <div class="form-inline py-3">
                        <div class="form-group w-50">
                            <label for="busqueda" class="text-uppercase font-weight-bold pr-4">Buscar</label>
                            <input type="search" class="form-control w-75" id="busqueda" placeholder="Modelo...">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div id="data"></div>
                </div>

                <div class="col-12 py-3 text-center">
                    <button class = "btn btn-outline-primary mx-3">Registrar</button>
                    <button class = "btn btn-outline-primary mx-3">Editar</button>
                    <button class = "btn btn-outline-primary mx-3">Dar de baja</button>
                </div>
                </div>
            </div>
          
        </div>
    </main>
    
    <?php require (RUTA_APP . '/views/includes/scripts.php');?>
    <script src="<?php echo RUTA_URL?>/js/aviones.js"></script>r

</body>
</html>