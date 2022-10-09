<?php
    class UserSession{
        static $instancia;
        static $usuario;

        public function __construct()
        {
            session_start();
            self::$usuario = new User();
        }

        static function getInstance(){
            if(self::$instancia === null){
                self::$instancia = new self();
            }

            return self::$instancia;
        }

        static function setCurrentUser($user)
        {
            $_SESSION['user'] = $user->getUserName();
            $_SESSION['NumeroEmpleado'] = $user->getNumeroEmpleado();
            $_SESSION['nickname'] = $user->getApodo();
            $_SESSION['profile-photo'] = $user->getFoto();
            $_SESSION['Puesto'] = $user->getPuesto();
            $_SESSION['Correo'] = $user->getCorreo();
            $_SESSION['Telefono'] = $user->getTelefono();
            $_SESSION['Sexo'] = $user->getSexo();
            $_SESSION['FechaNacimiento'] = $user->getFechaNacimiento();
            $_SESSION['CantidadVentas'] = 0;
        }

        static function getCurrentUser(){
            return $_SESSION['user'];
        }

        static function closeSession(){
            session_unset();
            session_destroy();
        }
    }
?>