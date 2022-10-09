//EMPLEADOS
$(buscar_datos());

function buscar_datos(consulta){
    $.ajax({
        type: "POST",
        url: "http://localhost/traveler-airlines/paginas/BuscarEmpleados",
        data: {consulta: consulta},
        dataType: "html",
    })
    .done(function(respuesta){
        $("#data").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}

$(document).on('keyup', '#busqueda', function(){
    var valor = $(this).val();
    if(valor != ""){
        buscar_datos(valor);
    }
    else{
        buscar_datos();
    }
});

//USUARIOS
$(buscar_datos_usuario());

function buscar_datos_usuario(consultaUsuario){
    $.ajax({
        type: "POST",
        url: "http://localhost/traveler-airlines/paginas/BuscarUsuarios",
        data: {consultaUsuario: consultaUsuario},
        dataType: "html",
    })
    .done(function(respuesta){
        $("#UserData").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}

$(document).on('keyup', '#busquedaUsuario', function(){
    var valorUser = $(this).val();
    if(valorUser != ""){
        buscar_datos_usuario(valorUser);
    }
    else{
        buscar_datos_usuario();
    }
});

//BUSQUEDA

$('#empleados input[type=search]').on('search', function () { 
    buscar_datos();
});

$('#usuarios input[type=search]').on('search', function () { 
    buscar_datos_usuario();
});