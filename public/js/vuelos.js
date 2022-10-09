//VUELOS
$(buscar_datos());

function buscar_datos(consulta){
    $.ajax({
        type: "POST",
        url: "http://localhost/traveler-airlines/paginas/BuscarVuelos",
        data: {consulta: consulta},
        dataType: "html",
    })
    .done(function(respuesta){
        $("#DatosVuelos").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}

$(document).on('keyup', '#BusquedaVuelos', function(){
    var valor = $(this).val();
    if(valor != ""){
        buscar_datos(valor);
    }
    else{
        buscar_datos();
    }
});

//RUTAS
$(buscar_datos_rutas());

function buscar_datos_rutas(consultaRuta){
    $.ajax({
        type: "POST",
        url: "http://localhost/traveler-airlines/paginas/BuscarRutas",
        data: {consultaRuta: consultaRuta},
        dataType: "html",
    })
    .done(function(respuesta){
        $("#DatosRutas").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}

$(document).on('keyup', '#BusquedaRutas', function(){
    var valorUser = $(this).val();
    if(valorUser != ""){
        buscar_datos_rutas(valorUser);
    }
    else{
        buscar_datos_rutas();
    }
});

//Aeropuertos
$(buscar_datos_aeropuertos());

function buscar_datos_aeropuertos(consultaAero){
    $.ajax({
        type: "POST",
        url: "http://localhost/traveler-airlines/paginas/BuscarAeropuertos",
        data: {consultaAero: consultaAero},
        dataType: "html",
    })
    .done(function(respuesta){
        $("#DatosAeropuertos").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}

$(document).on('keyup', '#BusquedaAeropuertos', function(){
    var valorAero = $(this).val();
    if(valorAero != ""){
        buscar_datos_aeropuertos(valorAero);
    }
    else{
        buscar_datos_aeropuertos();
    }
});


//BUSQUEDA

$('#vuelos input[type=search]').on('search', function () { 
    buscar_datos();
});

$('#rutas input[type=search]').on('search', function () { 
    buscar_datos_usuario();
});

$('#aeropuertos input[type=search]').on('search', function () { 
    buscar_datos_aeropuertos();
});