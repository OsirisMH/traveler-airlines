<?php
    class controlador{
        public function modelo($modelo){
           require_once '../app/models/' . $modelo . '.php';

           return new $modelo();
        }

        //Cuando se quiera utilizar la información enviada por parametro siempre deberá llamarse por $datos
        public function vista($vista, $datos = []){
            if(file_exists('../app/views/' . $vista . '.php')){
                require_once '../app/views/' . $vista . '.php';
            }
            else{
                die("La vista no existe");
            }
        }

        public function vista_sobrecarga($vista, $datos = [], $datos2 = NULL, $datos3 = NULL){
            if(file_exists('../app/views/' . $vista . '.php')){
                require_once '../app/views/' . $vista . '.php';
            }
            else{
                die("La vista no existe");
            }
        }
    }
?>