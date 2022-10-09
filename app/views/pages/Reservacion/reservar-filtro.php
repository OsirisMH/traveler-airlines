<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP?></title>
    <?php require (RUTA_APP . '/views/includes/links.php');?>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/reservar-filtro.css"/>
</head>
<body>
    <?php require (RUTA_APP . '/views/includes/headernav.php');?>

    <main>
        <div class="container p-0 busqueda text-center">
            <div class="py-2 titulo"><h2 class="text-center">Buscar vuelos</h2></div>
            <form action="<?php echo RUTA_URL?>/paginas/reservar_seleccion" class="mt-3" method="post">
                <!-- 1ra fila -->
                <div class="row m-0">
                    <!-- Tipo de vuelo -->
                    <div class="col-6 d-flex flex-column tipoVuelo">
                        <span class="pb-3">Tipo de vuelo:</span>
                        <div class="btn-group botones mx-auto" role="group" aria-label="Basic example" id = "tipoVuelos">
                            <button type="button" class="btn btn-outline-primary" id = "btnSencillo">Sencillo</button>
                            <button disabled type="button" class="btn btn-outline-primary" id = "btnRedondo">Redondo</button>
                            <input type="hidden" name = "TipoVuelo" id = "varTipoVuelo" value = "">
                        </div>
                    </div>
                    <!-- Cantidad de pasajeros -->
                    <div class="col-6 d-flex flex-column cantidadPasajeros">
                        <span class="pb-3">Pasajeros:</span>
                        <div class="input-group inputs mx-auto w-25">
                            <div class="input-group-prepend" id = "formPasajeros">
                                <button class="btn btn-outline-primary" type="button" id = "disminuirCantidad">-</button>
                            </div>
                            <input readonly type="text" class="form-control" value="1" aria-label="" aria-describedby="basic-addon1" id = "cantidadPasajerosInput" name="CantidadPasajeros">
                            <div class="input-group-append" id = "formPasajeros">
                                <button class="btn btn-outline-primary" type="button" id = "aumentarCantidad">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2da fila -->
                <div class="row m-0 from-to">
                    <!-- Origen -->
                    <div class="col-6 d-flex flex-column">
                        <label class="mr-sm-2" for="FormCustomSelect">Origen</label>
                        <select required class="custom-select mx-auto" id="OrigenFiltro" name="CodigoOrigen" onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;">
                            <option selected value = "">Choose...</option>
                            <?php foreach($datos as $ciudad):?>
                            <?php echo '<option value="'.$ciudad->ID_Aeropuerto.'">'.$ciudad->Localidad.'</option>';?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Destino -->
                    <div class="col-6 d-flex flex-column" >
                        <label class="mr-sm-2" for="FormCustomSelect">Destino</label>
                        <select required class="custom-select mx-auto" id="DestinoFiltro" name="CodigoDestino" onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;">
                            <option selected value = "">Choose...</option>
                            <?php foreach($datos as $ciudad):?>
                            <?php echo '<option value="'.$ciudad->ID_Aeropuerto.'">'. $ciudad->Localidad .'</option>';?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- 3ra fila -->
                <div class="row m-0 fecha">
                     <!-- Fecha salida -->
                     <div class="col-6 d-flex flex-column">
                        <label for="fechaSalida">Fecha de salida</label>
                        <input required type="date" id="fechaSalida" name="FechaSalida" min="2021-01-02" class="form-control mx-auto" id = "fechaSalida" value = "">
                    </div>
                    <!-- Fecha regreso -->
                    <div class="col-6 d-flex flex-column">
                        <label for="fechaRegreso">Fecha de regreso</label>
                        <input required type="date" id="fechaRegreso" name="FechaRegreso" min="2021-01-02" class="form-control mx-auto" id = "fechaRegreso" value = "">
                    </div>
                </div>

                <!-- Boton -->
                <div class="row m-0 pt-5 justify-content-center boton">
                    <button class = "btn btn-outline-primary w-50" type="submit">Buscar vuelos</button>
                </div>
            </form>
        </div>
    </main>

    <?php require (RUTA_APP . '/views/includes/scripts.php');?>
    <script src="<?php echo RUTA_URL?>/js/reservar-filtro.js"></script>
</body>
</html>