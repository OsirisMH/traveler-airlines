<?php
    class Paginas extends Controlador{

        private $sesion;
        private $usuario;

        public function __construct()
        {
            $this->VuelosModelo = $this->modelo('VuelosModelo');
            $this->ReservacionModelo = $this->modelo('ReservacionModelo');
            $this->EmpleadoModelo = $this->modelo('EmpleadoModelo');
            $this->UsuarioModelo = $this->modelo('UsuarioModelo');
            $this->AvionModelo = $this->modelo('AvionModelo');
            $this->RutaModelo = $this->modelo('RutaModelo');
            $this->AeropuertoModelo = $this->modelo('AeropuertoModelo');
            $sesion = UserSession::getInstance();
        }

        #region Inicio de Sesión

        public function index(){
            if(isset($_SESSION['user'])){
                $this->vista('pages/inicio');
            }
            else if(isset($_POST['usuario']) && isset($_POST['contraseña'])){
                $userForm = $_POST['usuario'];
                $passForm = $_POST['contraseña'];
        
                if(UserSession::$usuario->userExists($userForm, $passForm)){
                    UserSession::$usuario->setUser($userForm);
                    UserSession::setCurrentUser(UserSession::$usuario);
                    $this->vista('pages/inicio');
                }
                else{
                    $datos = [
                        'errorLogin' => "Nombre de usuario y/o contraseña incorrecto"
                    ];
                
                    $this->vista('pages/login', $datos);
                }
            }
            else{
                $this->vista('pages/login');
            }
        }

        public function perfil(){
            $this->vista('pages/mi-perfil');
        }

        public function GetPassword(){
            $resultado = $this->UsuarioModelo->obtenerContraseña($_SESSION['NumeroEmpleado']);
            return $resultado;
        }

        #endregion

        #region Facturación

        public function facturar(){
            $this->vista('pages/facturar');
        }

        public function ConsultaReservacion(){
            $resultado = $this->ReservacionModelo->DatosReservacion($_POST['NumeroBoleto']);
            return $resultado;
        }

        #endregion

        #region Reservaciones

        public function reservar_filtro(){
            $ciudades = $this->VuelosModelo->obtenerCiudades();

            $this->vista('pages/Reservacion/reservar-filtro', $ciudades);
        }

        public function reservar_seleccion(){            
            //Obtener los vuelos
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                foreach($_POST as $clave => $valor){
                    $_SESSION['FormFiltro'][$clave] = $valor;
                }
                
                $vuelos = $this->VuelosModelo->obtenerVuelos($_SESSION['FormFiltro']['CodigoOrigen'],
                                                             $_SESSION['FormFiltro']['CodigoDestino'],
                                                             $_SESSION['FormFiltro']['FechaSalida'],
                                                             $_SESSION['FormFiltro']['CantidadPasajeros']);

                $this->vista('pages/Reservacion/reservar-seleccion', $vuelos);
            }
            else{
                   //Código
            }            
        }

        public function reservar_datos_pasajeros(){
            //Obtener los asientos disponibles
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                foreach($_POST as $clave => $valor){
                    $_SESSION['FormVueloSalida'][$clave] = $valor;
                }

                $this->vista('pages/Reservacion/reservar-pasajeros');
            }
            else{
                   //Código
            }
        }

        public function reservar_asientos(){
            unset($_SESSION['FormDatosPasajeros']);
            //Guardar los datos de los pasajeros
            $contador = 0;
            $i = 0;
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                foreach($_POST as $clave => $valor){
                    $_SESSION['FormDatosPasajeros'][$i][substr($clave, 0, -2)] = $valor;
                    $contador++;
                    if($contador%6 == 0){
                        $i++;
                    }
                }

                $asientosTurista = $this->VuelosModelo->obtenerAsientos($_SESSION['FormVueloSalida']['CodigoVuelo'], 1);
                $asientosEjecutiva = $this->VuelosModelo->obtenerAsientos($_SESSION['FormVueloSalida']['CodigoVuelo'], 2);
                $asientosOcupados = $this->VuelosModelo->obtenerAsientosOcupados($_SESSION['FormVueloSalida']['CodigoVuelo']);
                $asientosDisponibles = $this->VuelosModelo->obtenerAsientosDisponibles($_SESSION['FormVueloSalida']['CodigoVuelo'], $_SESSION['FormVueloSalida']['ClaseVuelo']);

                $asientos = ['turista' => $asientosTurista, 'ejecutiva' => $asientosEjecutiva,
                             'asientosOcupados' => $asientosOcupados, 'asientosDisponibles' => $asientosDisponibles];

                $this->vista('pages/Reservacion/reservar-asientos', $asientos);
            }
            else{
                //Código
            }
        }

        public function reservar_detalles(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $contador = 0;
                foreach($_POST as $clave => $valor){
                    $_SESSION['FormAsientos'][$contador][substr($clave, 0, -2)] = $valor;
                    $contador++;
                }

                $vuelo = $this->VuelosModelo->obtenerVuelo($_SESSION['FormVueloSalida']['CodigoVuelo']);

                $this->vista('pages/Reservacion/reservar-vuelo', $vuelo);
            }
            else{
               //Código
            }
        }

        public function reservar_vuelo(){
            $datosReservacion = [];

            for($i = 0; $i < $_SESSION['FormFiltro']['CantidadPasajeros']; $i++){
                $porciones = [];
                foreach($_SESSION['FormDatosPasajeros'][$i] as $clave => $valor){
                        $datosReservacion[$i][$clave] = $valor;
                }

                $porciones = explode("-", $_SESSION['FormAsientos'][$i]['asientoPasajero']);
                
                $datosReservacion[$i]['NumeroAsiento'] = $porciones[1];
                $datosReservacion[$i]['Fila'] = $porciones[0];

                unset($porciones);
            }

            if($this->VuelosModelo->reservarVuelo($datosReservacion, $_SESSION['FormVueloSalida']['CodigoVuelo'], $_SESSION['NumeroEmpleado'], $_SESSION['FormFiltro']['CantidadPasajeros'], $_POST['importe'])){
                $_SESSION['CantidadVentas']++;
            }
            else{
                die('Algo salió mal...');
            }
        }

        public function imprimir_ticket(){
            $vuelo = $this->VuelosModelo->obtenerVuelo($_SESSION['FormVueloSalida']['CodigoVuelo']);
            $datos = ['vuelo' => $vuelo, 'datos' => $_POST];
            $this->vista('pages/PDFs/impresion-ticket', $datos);
        }

        public function unsetear_variables(){
            if(isset($_SESSION['FormVueloSalida']))
                unset($_SESSION['FormVueloSalida']);
            if(isset($_SESSION['FormFiltro']))
                unset($_SESSION['FormFiltro']);
            if(isset($_SESSION['FormDatosPasajeros']))
                unset($_SESSION['FormDatosPasajeros']);
            if(isset($_SESSION['FormAsientos']))
                unset($_SESSION['FormAsientos']);
        }
        #endregion

        #region Check-In / Cancelacion

        public function check_in_busqueda(){
            $this->vista('pages/Check-In_Cancelacion/busqueda-reservacion');
        }

        public function Obtener_Reservacion(){
            //Obtener la información de la reservación
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $NumeroReservacion = $_POST['NumeroReservacion'];
                $Apellido = $_POST['Apellido'];
                
                $Reservacion = $this->ReservacionModelo->obtenerReservacion($NumeroReservacion, $Apellido);

                return $Reservacion;
            }
            else{
                //Código
                return 0;
            }    
        }

        public function Detalles_Reservacion(){
            $Accion = $_POST['Accion'];
            if($Accion == 1){ //CHECK-IN
                //Obtener la información de la reservación
                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    $NumeroReservacion = $_POST['NumeroReservacion'];
                    $Apellido = $_POST['Apellido'];
                    
                    $Reservacion = $this->ReservacionModelo->DetallesReservacion($NumeroReservacion, $Apellido);
                    $_SESSION['Reservacion'] = $Reservacion;

                    $this->vista('pages/Check-In_Cancelacion/check-in-reservacion', $Reservacion);
                }
            }
            else{ //CANCELACION
                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    $NumeroReservacion = $_POST['NumeroReservacion'];
                    $Apellido = $_POST['Apellido'];
                    
                    $Reservacion = $this->ReservacionModelo->DetallesReservacion($NumeroReservacion, $Apellido);

                    $this->vista('pages/Check-In_Cancelacion/cancelacion-reservacion', $Reservacion);
                }
            }

        }

        public function check_in_confirmar($NumeroReservacion){
            //Registrar presencia en el vuelo
            if($this->ReservacionModelo->registrarAsistencia($NumeroReservacion)){

            }
            else{
                die('Algo salió mal...');
            }

        }

        public function impresion_boleto(){
            $this->vista('pages/PDFs/impresion-boleto', $_SESSION['Reservacion']);
            unset($_SESSION['Reservacion']);    
        }

        public function cancelar_reservacion($NumeroReservacion){
            //Cancelar vuelo
            if($this->ReservacionModelo->cancelarReservacion($NumeroReservacion)){

            }
            else{
                die('Algo salió mal...');
            }
        }

        #endregion

        #region Administracion
        public function administracion(){
            $this->vista('pages/Administracion/administracion');
        }

        //ADMINISTRAR
        public function administrar_empleados()
        {
            $this->vista('pages/Administracion/Empleados/empleados');
        }

        public function administrar_aviones()
        {
            $this->vista('pages/Administracion/Aviones/aviones');
        }

        public function administrar_vuelos(){
            $this->vista('pages/Administracion/Vuelos/vuelos');
        }

        //EMPLEADOS
        public function BuscarEmpleados(){
            $resultado = $this->EmpleadoModelo->buscarDatos($_POST);
            echo $resultado;
        }

        public function BuscarUsuarios(){
            $resultado = $this->UsuarioModelo->buscarDatos($_POST);
            echo $resultado;
        }

        public function administrar_registro_empleado(){
                //Registrar empleado
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $datos = [
                        'Nombre'=>trim($_POST['NombreEmpleado']),
                        'Apellido'=>trim($_POST['ApellidoEmpleado']),
                        'Fecha_Nacimiento'=>trim($_POST['FechaNacimientoEmpleado']),
                        'Sexo'=>trim($_POST['sexo']),
                        'Correo'=>trim($_POST['CorreoEmpleado']),
                        'Telefono'=>trim($_POST['TelefonoEmpleado']),
                        'Puesto'=>trim($_POST['PuestoEmpleado']),
                    ];
    
                    if($this->EmpleadoModelo->RegistrarEmpleado($datos)){
                        $this->vista('pages/Administracion/Empleados/empleados');
                    }
                    else{
                        die('Algo salió mal...');
                    }
                }
                else{
                    $datos = [
                        'Nombre' => '',
                        'Apellido'=> '',
                        'Fecha_Nacimiento'=>'',
                        'Sexo' => '',
                        'Correo' => '',
                        'Telefono'=> '',
                        'Puesto'=> ''
                    ];
                    $this->vista('pages/Administracion/Empleados/empleado-registro');
                }  
        }

        public function administrar_registro_empleado_usuario(){
            //Registrar empleado
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = [
                    'nombre'=>trim($_POST['NombreUsuario']),
                    'contraseña'=>trim($_POST['Contraseña']),
                    'linkfoto'=>trim($_POST['LinkFoto']),
                    'numeroEmpleadoU'=>trim($_POST['NumeroEmpleadoU'])
                ];

                if($this->UsuarioModelo->RegistrarUsuario($datos)){
                    $this->vista('pages/Administracion/Empleados/empleados');
                }
                else{
                    die('Algo salió mal...');
                }
            }
            else{
                $datos = [
                    'nombre'=>'',
                    'contraseña'=>'',
                    'linkfoto'=>'',
                    'numeroEmpleadoU'=>''
                ];

                $datos = ['Disponibles' => $this->UsuarioModelo->empleadosSinUsuario()];

                $this->vista('pages/Administracion/Empleados/usuario-registro', $datos);
            }   
        }
        
        public function administrar_modificar_empleado($id){
            //Modificar empleado
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = [
                    'NumeroEmpleado' => $id,
                    'Nombre'=>trim($_POST['NombreEmpleado']),
                    'Apellido'=>trim($_POST['ApellidoEmpleado']),
                    'Fecha_Nacimiento'=>trim($_POST['FechaNacimientoEmpleado']),
                    'Sexo'=>trim($_POST['sexo']),
                    'Correo'=>trim($_POST['CorreoEmpleado']),
                    'Telefono'=>trim($_POST['TelefonoEmpleado']),
                    'Puesto'=>trim($_POST['PuestoEmpleado']),
                ];

                if($this->EmpleadoModelo->ModificarEmpleado($datos)){
                    $this->vista('pages/Administracion/Empleados/empleados');
                }
                else{
                    die('Algo salió mal...');
                }
            }
            else{  
                //Obtener la informacion desde el modelo
                $empleado = $this->EmpleadoModelo->obtenerEmpleado($id);
                $datos = [
                    'NumeroEmpleado' => $id,
                    'Nombre' => $empleado->Nombre,
                    'Apellido'=>$empleado->Apellido ,
                    'Fecha_Nacimiento'=>$empleado->Fecha_Nacimiento,
                    'Sexo' => $empleado->Sexo,
                    'Correo' => $empleado->Correo,
                    'Telefono'=> $empleado->Telefono,
                    'Puesto'=> $empleado->Puesto
                ];
                $this->vista('pages/Administracion/Empleados/empleado-modificar', $datos);
            } 
        }

        //AVIONES
        public function BuscarAviones(){
            $resultado = $this->AvionModelo->buscarDatos($_POST);
            echo $resultado;
        }

        //VUELOS
        public function BuscarVuelos(){
            $resultado = $this->VuelosModelo->buscarDatos($_POST);
            echo $resultado;
        }

        public function BuscarRutas(){
            $resultado = $this->RutaModelo->buscarDatos($_POST);
            echo $resultado;
        }

        public function BuscarAeropuertos(){
            $resultado = $this->AeropuertoModelo->buscarDatos($_POST);
            echo $resultado;
        }


        #endregion

        #region Cerrar Sesión

        public function cerrarSesion(){
            $this->vista('pages/cerrarSesion');
        }

        #endregion
    }
?>