<?php
    class ReservacionModelo{
        private $db;
        private $cantidad;

        public function __construct()
        {
            $this->db = new base();
            $this->cantidad = $this->setCantidad();
        }

        //PROPIEDADES
        public function setCantidad(){
            $this->db->query('SELECT * FROM reservaciones');
            return $this->db->contarFilas();
        }

        public function getCantidad(){
            return $this->cantidad;
        }

        //MÉTODOS
        public function registrarAsistencia($NumeroReservacion){
            $this->db->query('UPDATE reservaciones SET Asistencia= \'CONFIRMADA\' WHERE Numero_Reservacion = :NumeroReservacion');
            $this->db->bind('NumeroReservacion', $NumeroReservacion);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function cancelarReservacion($NumeroReservacion){
            $this->db->query('CALL CancelarVuelo (:NumeroReservacion)');
            $this->db->bind('NumeroReservacion', $NumeroReservacion);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function obtenerReservacion($NumeroReservacion, $Apellido){
            $this->db->query('call ObtenerReservacion(:NumeroReservacion, :Apellido);');
            $this->db->bind('NumeroReservacion', $NumeroReservacion);
            $this->db->bind('Apellido', $Apellido);
            $resultados = $this->db->arrayRegistros();

            echo json_encode($resultados);
        }
        
        public function DetallesReservacion($NumeroReservacion, $Apellido){
            $this->db->query('call ObtenerReservacion(:NumeroReservacion, :Apellido);');
            $this->db->bind('NumeroReservacion', $NumeroReservacion);
            $this->db->bind('Apellido', $Apellido);
            $resultados = $this->db->unRegistro();

            return $resultados;
        }

        public function DatosReservacion($NumeroReservacion){
            $this->db->query('SELECT * FROM Reservaciones WHERE Numero_Reservacion = :NumeroReservacion');
            $this->db->bind('NumeroReservacion', $NumeroReservacion);
            $resultados = $this->db->arrayRegistros();

            echo json_encode($resultados);
        }

    }
?>