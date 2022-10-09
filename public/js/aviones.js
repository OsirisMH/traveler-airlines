$(buscar_datos());

function buscar_datos(consulta){
    $.ajax({
        type: "POST",
        url: "http://localhost/traveler-airlines/paginas/BuscarAviones",
        data: {consulta: consulta},
        dataType: "html",
    })
    .done(function(respuesta){
        $("#data").html(respuesta);
        console.log(respuesta);
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

$('input[type=search]').on('search', function () { 
    buscar_datos();
});