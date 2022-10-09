(function(){
    var formulario = document.datos_fiscales;
    var elementos = datos_fiscales.elements;

    //Funciones
    var validarInput = function(){
        for(var i = 0; i < elementos.length; i++){
            if(elementos[i].type == "text" || elementos[i].type == "email" || elementos[i].type == "password"){
                if(elementos[i].value == 0){
                    console.log('El campo ' + elementos[i].name + ' esta incompleto');
                    elementos[i].className = elementos[i].className + ' error';
                    return false;
                }
                else{
                    elementos[i].className = elementos[i].className.replace(" error", "");
                    return false;
                }
            }
        }
    };

    var enviar = function(e){
        if(!validarInput()){
            console.log('Falto validar los input');
            e.preventDefautl();
        }
        else{
            console.log('Envia los datos correctamente');
            e.preventDefautl();
        }
    };

    //Funciones Blur y Focus
    var focusInput = function(){
        this.parentElement.children[0].className = "label activo";
        this.parentElement.children[1].className = this.parentElement.children[1].className.replace(" error", "");
    };

    var blurInput = function(){
        if(this.value <= 0){
            this.parentElement.children[0].className = "label";
            this.parentElement.children[1].className = this.parentElement.children[1].className + " error";
        }
    };

    //Eventos
    datos_fiscales.addEventListener("submit", enviar);

    for (var i = 0; i < elementos.length; i++){
        if(elementos[i].type == "text" || elementos[i].type == "email" || elementos[i].type == "password"){
            elementos[i].addEventListener("focus", focusInput);
            elementos[i].addEventListener("blur", blurInput);
        }
    }
}());