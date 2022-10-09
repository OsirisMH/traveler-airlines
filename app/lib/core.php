<?php
    /*
        Mapear la url ingresada en el navegador,
        1 - controlador
        2 - método
        3 - parámetro
    */

    class core{
        protected $controladorActual = 'paginas';
        protected $metodoActual = 'index';
        protected $parametros = [];

        //Constructor
        public function __construct()
        {
            //print_r($this->getUrl());
            $url = $this->getUrl();

            //Buscar en controladores si el controlador existe
            if (isset($url[0])){
                if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
                    //Si existe se configura como controlador por defecto
                    $this->controladorActual = ucwords($url[0]);
    
                    //desconfigurar indice
                    unset($url[0]);
                }
            }

            //Requerir el controlador
            require_once '../app/controllers/' . $this->controladorActual . '.php';
            $this->controladorActual = new $this->controladorActual;

            //Verificar la segunda parte de la url
            if(isset($url[1])){
                if(method_exists($this->controladorActual, $url[1])){
                    $this->metodoActual = $url[1];
                    //desconfigurar indice
                    unset($url[1]);
                }
            }
            //echo $this->metodoActual;

            //obtener parametros
            $this->parametros = $url ? array_values($url) : [];

            //Llamar callback con parametros array
            call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
        }

        public function getUrl(){
            //echo $_GET['url'];

            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>