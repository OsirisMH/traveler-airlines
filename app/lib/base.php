<?php
//Clase para conectarse a la base de datos y ejecutar consultas
//MEDIANTE PDO
    class base{
        private $host = DB_HOST;
        private $usuario = DB_USUARIO;
        private $contra = DB_PASSWORD;
        private $nombre_bd = DB_NOMBRE;

        private $dbh; //database handler
        private $stmt;
        private $error;

        public function __construct()
        {
            //condigurar conexion
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->nombre_bd;
            $opciones = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            //Crear una instancia de PDO
            try{
                $this->dbh = new PDO($dsn, $this->usuario, $this->contra, $opciones);
                $this->dbh->exec('set names utf8');
            }catch (PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        //Preparamos la consulta
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql); 
        }

        //Vinculamos la consulta
        public function bind($parametro, $valor, $tipo = null){
            if(is_null($tipo)){
                switch(true){
                    case is_int($valor):
                        $tipo = PDO::PARAM_INT;
                    break;
                    case is_bool($valor):
                        $tipo = PDO::PARAM_BOOL;
                    break;
                    case is_null($valor):
                        $tipo = PDO::PARAM_NULL;
                    break;
                    default:
                        $tipo = PDO::PARAM_STR;
                    break;
                }
            }

            $this->stmt->bindValue($parametro, $valor, $tipo);
        }

        //Ejecuta la consulta
        public function execute(){
            return $this->stmt->execute();
        }

        //Obtener los registros
        public function registros(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        //Obtener un unico registro
        public function unRegistro(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        //Obtener cantidad de filas con el metodo rowCount
        public function contarFilas(){
            $this->execute();
            return $this->stmt->rowCount();
        }

        public function arrayRegistros(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function arrayAllRegistros(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>