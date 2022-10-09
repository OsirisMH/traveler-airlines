<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP?></title>
    <?php require (RUTA_APP . '/views/includes/links.php');?>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/facturar.css"/>
</head>
<body>
    <?php require (RUTA_APP . '/views/includes/headernav.php');?>

    <main class="facturacion">
        <script>
            var Num_Fila = 1;
        </script>
        <div class="container">
            <div class="row mt-4 mb-2 justify-content-center">
                <!-- NAV PILLS -->
                <ul disable class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link pestaña active show" id="pills-agregar-boleto-tab" data-toggle="pill" href="#pills-agregar-boleto" role="tab" aria-controls="pills-agregar-boleto" aria-selected="true">Agregar Boletos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pestaña" id="pills-datos-fiscales-tab" data-toggle="pill" href="#pills-datos-fiscales" role="tab" aria-controls="pills-datos-fiscales" aria-selected="false">Datos Fiscales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pestaña" id="pills-generar-factura-tab" data-toggle="pill" href="#pills-generar-factura" role="tab" aria-controls="pills-generar-factura" aria-selected="false">Generar Factura</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <!-- Agregar boletos -->
                <div class="tab-pane fade facturar-contenido show active" id="pills-agregar-boleto" role="tabpanel" aria-labelledby="pills-agregar-boleto-tab">
                    <section name="ingresar_boleto" class="ingresar-boletos-form">
                        <div class="d-flex pb-1 m-auto justify-content-center input-agregar-boleto">
                            <div class="form-group col-lg-12 my-4">
                                <label class = "label" for="No_Boleto" id = "lblBoleto">Número de boleto:</label>
                                <input type="text" class="form-control" name = "No_Boleto" id = "No_Boleto">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center pb-2 btn-agregar-boleto">
                            <button class="slide" id = "btnAgregarBoleto">Agregar</button>
                        </div>
                    </section>
                    <div class="d-flex p-4 justify-content-center tabla-boletos">
                        <table class="table table-hover table-striped" id = "tabla-boletos">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Número de boleto</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Documento fiscal</th>
                                <th scope="col">Total</th>
                                <th scope="col">Acción</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                    </div>
                </div>
                <!-- FIN - Agregar boletos -->
                <!-- Datos fiscales -->
                <div class="tab-pane fade facturar-contenido" id="pills-datos-fiscales" role="tabpanel" aria-labelledby="pills-datos-fiscales-tab">
                    <div class="hoja pb-3 mx-auto">
                        <div class="encabezado-hoja d-flex justify-content-between pl-4 pr-2">
                            <img src="<?php echo RUTA_URL?>/images/SAT.png" alt="" class="SAT">
                            <div class="logo-hoja my-auto">
                                <img src="<?php echo RUTA_URL?>/images/Logo.png">
                                <span class="my-auto ml-2">Traveler Airlines</span>  
                            </div>                       
                        </div>
                        <div class="titulo-hoja">
                            <h3 class="text-center p-3">Formulario de datos fiscales</h3>
                            <hr class="divisor">
                        </div>
                        <form action="" name = "datos_fiscales" class="pt-3 pb-2 mx-2 facturar-form">
                            <div class="d-flex p-2 justify-content-center">
                                <div class="form-group col-lg-6 mb-0 my-4">
                                    <label class = "label" for="">RFC:</label>
                                    <input type="text" class="form-control" name = "RFC">
                                </div>
                                <div class="form-group col-lg-6 mb-0 my-4">
                                    <label class = "label" for="">Correo:</label>
                                    <input type="email" class="form-control" name = "Correo">
                                </div>
                            </div>
                            <div class="d-flex p-2 justify-content-start">
                                <div class="form-group col-lg-8 mb-0 my-4">
                                    <label class = "label" for="">Nombre o Razón Social:</label>
                                    <input type="text" class="form-control" name = "Nombre">
                                </div>
                            </div>
                            <div class="d-flex p-2 justify-content-center">
                                <div class="form-group col-lg-6 mb-0 my-4">
                                    <label class = "label" for="">Calle:</label>
                                    <input type="text" class="form-control" name = "Calle">
                                </div>
                                <div class="form-group col-lg-3 mb-0 my-4">
                                    <label class = "label" for="">No. Exterior:</label>
                                    <input type="text" class="form-control" name = "Nunero_Exterior">
                                </div>
                                <div class="form-group col-lg-3 mb-0 my-4">
                                    <label class = "label" for="">No. Interior:</label>
                                    <input type="text" class="form-control" name = "Numero_Interior">
                                </div>
                            </div>
                            <div class="d-flex p-2 justify-content-center">
                                <div class="form-group col-lg-6 mb-0 my-4">
                                    <label class = "label" for="">Colonia:</label>
                                    <input type="text" class="form-control" name = "Colonia">
                                </div>
                                <div class="form-group col-lg-6 mb-0 my-4">
                                    <label class = "label" for="">Ciudad o Delegación:</label>
                                    <input type="text" class="form-control" name = "Ciudad">
                                </div>
                            </div>
                            <div class="form-group d-flex p-2 justify-content-between">
                                <div class="form-group col-lg-6 mb-0 my-4">
                                    <label class = "label" for="">Código Postal:</label>
                                    <input type="text" class="form-control" name = "Codigo_Postal">
                                </div>
                                <div class="form-group col-lg-6 mb-0 my-4">
                                    <select class="custom-select mt-1">
                                        <option selected>Estado</option>
                                        <option value="1">Chihuahua</option>
                                        <option value="2">Sinaloa</option>
                                        <option value="3">Durango</option>
                                        <option value="4">Sonora</option>
                                        <option value="5">Ciudad de México</option>
                                        <option value="6">Oaxaca</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- FIN - Datos fiscales -->
                <!-- Generar factura -->
                <div class="tab-pane fade facturar-contenido" id="pills-generar-factura" role="tabpanel" aria-labelledby="pills-generar-factura-tab">

                </div>
                <!-- FIN- Generar factura -->
            </div>
            <!-- Botones -->
            <div class="d-flex justify-content-center pb-4 btn-opciones-facturacion">
                <button id = "anterior" type="" class="mx-3 btn-siguiente">
                    <svg width="20" height="20" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-circle-left" class="svg-inline--fa fa-arrow-circle-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zm28.9-143.6L209.4 288H392c13.3 0 24-10.7 24-24v-16c0-13.3-10.7-24-24-24H209.4l75.5-72.4c9.7-9.3 9.9-24.8.4-34.3l-11-10.9c-9.4-9.4-24.6-9.4-33.9 0L107.7 239c-9.4 9.4-9.4 24.6 0 33.9l132.7 132.7c9.4 9.4 24.6 9.4 33.9 0l11-10.9c9.5-9.5 9.3-25-.4-34.3z"></path>
                    </svg>
                    Anterior
                </button>
                <button id = "siguiente" type="" class="mx-3 btn-anterior ">Siguiente 
                    <svg width="20" height="20" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-circle-right" class="svg-inline--fa fa-arrow-circle-right fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path></svg>
                </button>
            </div>
        </div>
    </main>
    
    
    <?php require (RUTA_APP . '/views/includes/scripts.php');?>
    <script src="<?php echo RUTA_URL?>/js/facturar.js"></script>

    <!-- AGREGAR BOLETO SCRIPT -->
    <script>
        $("main #siguiente").click(function(){
            var item1 = $('#pills-tab li a');

            if(item1[0].className == "nav-link pestaña active show"){
                $('#pills-tab li:nth-child(2) a').tab('show');
                $('main #anterior').show();
            }
            else{
                if(item1[1].className == "nav-link pestaña active show"){
                    $('#pills-tab li:nth-child(3) a').tab('show');
                    $('main #siguiente').hide();
                    $('main #anterior').hide();
                }
            }
            
        });

        $("main #anterior").click(function(){
            var item1 = $('#pills-tab li a');

            if(item1[1].className == "nav-link pestaña active show"){
                $('#pills-tab li:nth-child(1) a').tab('show');
                $('main #anterior').hide();
            }
        });

        //Agregar boletos
        function agregarFila(Fila, NoBoleto, Fecha, Tipo, Documento, Total) {
            var htmlTags = '<tr>'+ 
                    '<th scope = "scope">' + Fila + '</th>' +
                    '<td>' + NoBoleto + '</td>'+
                    '<td>' + Fecha + '</td>'+
                    '<td>' + Tipo + '</td>'+
                    '<td>' + Documento + '</td>'+
                    '<td>' + Total + '</td>'+
                    '<td>' + '<button class="btn btn-danger borrar" id = "'+ Fila +'">&#10006;</button>' + '</td>'+
                '</tr>';
                
            $('#tabla-boletos tbody').append(htmlTags);
        }
                
        function obtenerValores(NumeroBoleto){
            $.ajax({
                type: "POST",
                url: "http://localhost/traveler-airlines/paginas/ConsultaReservacion",
                data: {NumeroBoleto: NumeroBoleto},
                dataType: "json",
            })
            .done(function(respuesta){
                var BoletoExistente = false;
                //console.log(respuesta);
                if(respuesta){
                    $("#tabla-boletos td").each(function(){
                        if($(this).text() == respuesta['Numero_Reservacion']){
                            BoletoExistente = true;
                        }
                    });

                    if(!BoletoExistente){
                        agregarFila(Num_Fila, respuesta['Numero_Reservacion'], respuesta['Fecha_Reservacion'], "F", "Factura", respuesta['ImporteTotal']);
                        Num_Fila++;
                    }
                    else{
                        alert("Ya se registró el boleto...");
                    }
                }
                else{
                    alert("No se encontró la reservación...");
                }
            })
            .fail(function(){
                console.log("error");
            });
        }

        $("#btnAgregarBoleto").click(function(){
            obtenerValores($("#No_Boleto").val());
        });

        $("#No_Boleto").focus(function(){
            $("#lblBoleto").addClass("activo")
        });

        $("#No_Boleto").blur(function(){
            if($(this).val() == ""){
                $("#lblBoleto").removeClass("activo")
            }
            else{

            }
        });

        $(document).on('click', '.borrar', function (event) {
            event.preventDefault();
            $(this).closest('tr').remove();
            Num_Fila--;
        });
    </script>

    <!-- DATOS FISCALES -->
    <script>
        
    </script>
</body>
</html>