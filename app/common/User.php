<?php
    class User{
        private $db;
        private $num_empleado;
        private $username;
        private $nombre;
        private $apellido;
        private $correo;
        private $telefono;
        private $sexo;
        private $fechaNacimiento;
        private $apodo;
        private $foto;
        private $puesto;
 
        public function __construct(){
            $this->db = new base();
        }

        //Metodos get-set
        public function getUserName(){
            return $this->username;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getApellido(){
            return $this->apellido;
        }

        public function getCorreo(){
            return $this->correo;
        }

        public function getTelefono(){
            return $this->telefono;
        }

        public function getSexo(){
            if($this->sexo == 'M'){
                return 'MASCULINO';
            }
            else{
                return 'FEMENINO';
            }
        }

        public function getFechaNacimiento(){
            return $this->fechaNacimiento;
        }

        public function getApodo(){
            return $this->apodo;
        }

        public function getFoto(){
            return $this->foto;
        }

        public function userExists($user, $pass){
            //$md5pass = md5($pass);
            $this->db->query('SELECT*FROM usuarios where Nombre_Usuario = :user AND Contraseña = :pass');
            $this->db->bind(':user', $user);
            $this->db->bind(':pass', $pass);
            $this->db->execute();

            if($this->db->contarFilas()){
                return true;
            }
            else{
                return false;
            }
        }

        private function setApodo($nombre, $apellido){
            $nombreCorto = $this->nombre;
            $porciones = explode(" ", $nombreCorto);
            $nombreCorto = $porciones[0];
            $apellidoCorto = $this->apellido;
            $porciones = explode(" ", $apellidoCorto);
            $apellidoCorto = $porciones[0];
            return $nombreCorto . ' ' . $apellidoCorto; 
        }

        public function setUser($user){
            $this->db->query('SELECT e.Numero_Empleado, u.Nombre_Usuario, e.Nombre, e.Apellido, e.Correo, e.Telefono, e.Sexo, e.Fecha_Nacimiento, e.Puesto, u.Link_Foto FROM usuarios u inner join empleados e on u.Numero_Empleado_U = e.Numero_Empleado where u.Nombre_Usuario = :user');
            $this->db->bind(':user', $user);
            $usuario = $this->db->arrayRegistros();
            $this->num_empleado = $usuario['Numero_Empleado'];
            $this->username = $usuario['Nombre_Usuario'];
            $this->nombre = $usuario['Nombre'];
            $this->apellido = $usuario['Apellido'];
            $this->correo = $usuario['Correo'];
            $this->telefono = $usuario['Telefono'];
            $this->sexo = $usuario['Sexo'];
            $this->fechaNacimiento = $usuario['Fecha_Nacimiento'];
            $this->apodo = $this->setApodo($this->nombre, $this->apellido);
            $this->foto = $usuario['Link_Foto'];        
            $this->puesto = $usuario['Puesto'];
        }

        public function getUser(){
            return $this->username;
        }

        public function getPhoto(){
            return $this->foto;
        }

        public function getNumeroEmpleado(){
            return $this->num_empleado;
        }

        public function getPuesto(){
            return $this->puesto;
        }
    }

?>