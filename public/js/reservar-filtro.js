$(document).ready(function() {
    $("#btnSencillo").addClass('active')
    $("#fechaRegreso").attr('readonly', true);
    $("#varTipoVuelo").attr('value', "sencillo");
});

$("#tipoVuelos button").click(function(){
    $(this).addClass('active').siblings().removeClass('active');
    if($(this).attr('id') == "btnSencillo"){
        $("#fechaRegreso").attr('readonly', true);
        $("#varTipoVuelo").attr('value', "sencillo");
    }
    else{
        $("#fechaRegreso").attr('readonly', false);
        $("#varTipoVuelo").attr('value', "redondo");
    }
});

$("#formPasajeros button").click(function(i, oldval){
    var cantidad =  $("#cantidadPasajerosInput").attr('value');
    if($(this).attr('id') == "aumentarCantidad"){
        if($("#cantidadPasajerosInput").attr('value') < 9){
            $("#cantidadPasajerosInput").attr('value', ++cantidad);
        }
    }
    else{
        if($("#cantidadPasajerosInput").attr('value') > 1){
            $("#cantidadPasajerosInput").attr('value', --cantidad);
        }
    }
});