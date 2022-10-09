<?php
    class VuelosModelo{
        private $db;
        
        public function __construct()
        {
            $this->db = new base();
        }

        public function obtenerVuelos($origen, $destino, $fechaSalida, $pasajeros){
            $this->db->query('call vuelos_disponibles(:origen, :destino, :fechaSalida, :cantidadPasajeros)');
            $this->db->bind('origen', $origen);
            $this->db->bind('destino', $destino);
            $this->db->bind('fechaSalida', $fechaSalida);
            $this->db->bind('cantidadPasajeros', $pasajeros);
            $resultados = $this->db->registros();
            
            return $resultados;
        }

        public function obtenerVuelo($CodigoVuelo){
            $this->db->query('call ObtenerVuelo(:CodigoVuelo)');
            $this->db->bind('CodigoVuelo', $CodigoVuelo);
            $resultados = $this->db->unRegistro();
            
            return $resultados;
        }

        public function obtenerCiudades(){
            $this->db->query('SELECT ID_Aeropuerto ,CONCAT(Ciudad, \', \', Estado) AS Localidad FROM aeropuertos');
            $resultados = $this->db->registros();
            return $resultados;
        }

        public function obtenerAsientos($CodigoVuelo, $IDClase){
            $this->db->query('call ObtenerAsientos(:CodigoVuelo, :IDClase)');
            $this->db->bind('CodigoVuelo', $CodigoVuelo);
            $this->db->bind('IDClase', $IDClase);
            $resultados = $this->db->registros();
            return $resultados;
        }

        public function obtenerAsientosOcupados($CodigoVuelo){
            $this->db->query('SELECT CONCAT(ar.Fila_AR,  \'-\', ar.Numero_Asiento_AR) as asiento
                              FROM asientosreservados ar INNER JOIN vuelos v on ar.Codigo_Vuelo_AR = v.Codigo_Vuelo
                              WHERE v.Codigo_Vuelo = :CodigoVuelo');
            $this->db->bind('CodigoVuelo', $CodigoVuelo);
            $resultados = $this->db->arrayAllRegistros();
            return $resultados;
        }

        public function obtenerAsientosDisponibles($CodigoVuelo, $IDClase){
            $this->db->query('call ObtenerAsientosDisponibles(:CodigoVuelo, :IDClase)');
            $this->db->bind('CodigoVuelo', $CodigoVuelo);
            $this->db->bind('IDClase', $IDClase);
            $resultados = $this->db->registros();
            return $resultados;
        }

        public function reservarVuelo($datosReservacion, $codigoVuelo, $empleado, $cantidad, $importe){
            for($i = 0; $i < $cantidad; $i++){
                $this->db->query('call ReservarVuelo(:nombrePasajero,
                                                 :apellidoPasajero,
                                                 :fechaNacimiento,
                                                 :sexoPasajero,
                                                 :telefonoPasajero,
                                                 :correoPasajero,
                                                 :codigoVuelo,
                                                 :numeroEmpleado,
                                                 :numeroAsiento,
                                                 :fila,
                                                 :importe)');
                                                    
                $this->db->bind('nombrePasajero', $datosReservacion[$i]['NombrePasajero']);
                $this->db->bind('apellidoPasajero', $datosReservacion[$i]['ApellidoPasajero']);
                $this->db->bind('fechaNacimiento',  $datosReservacion[$i]['FechaNacimientoPasajero']);
                $this->db->bind('sexoPasajero',  $datosReservacion[$i]['sexo']);
                $this->db->bind('telefonoPasajero',  $datosReservacion[$i]['TelefonoPasajero']);
                $this->db->bind('correoPasajero',  $datosReservacion[$i]['CorreoPasajero']);
                $this->db->bind('codigoVuelo',  $codigoVuelo);
                $this->db->bind('numeroEmpleado', $empleado );
                $this->db->bind('numeroAsiento',  $datosReservacion[$i]['NumeroAsiento']);
                $this->db->bind('fila', $datosReservacion[$i]['Fila']);
                $this->db->bind('importe', $importe);

                $this->db->execute();
            }

            return true;
        }

        public function buscarDatos($POST){    
            $salida = "";
            $query = 'SELECT * FROM vw_vuelos';

            if(isset($POST['consulta'])){
                $Nombre = $POST['consulta'];
                $query = "SELECT * FROM vw_vuelos WHERE origen LIKE '%".$Nombre. "%' || destino LIKE '%".$Nombre. "%'";
            }

            $this->db->query($query);
            if($this->db->contarFilas() > 0){
                $salida = "<div class = 'tableFixHead'><table class = 'table table-hover table-striped table-fixed'>
                                <thead>
                                    <tr class = 'text-left'>
                                        <th>Código</th>
                                        <th>Ciudad de Origen</th>
                                        <th>Ciudad de Destino</th>
                                        <th>Fecha de Salida</th>
                                        <th>Fecha de Llegada</th>
                                        <th>Duración (Min.)</th>
                                        <th>Costo Turista</th>
                                        <th>Costo Ejecutiva</th>
                                        <th>Estado</th>
                                        <th>Código Avión</th>
                                        <th>Avión</th>
                                    </tr>
                                </thead> 
                                <tbody>";
                $fila = $this->db->registros();
                foreach($fila as $clave=>$valor){
                    $salida.= "<tr>
                                    <td>" . $fila[$clave]->cod_vuelo . "</td>
                                    <td>" . $fila[$clave]->origen . "</td>
                                    <td>" . $fila[$clave]->destino . "</td>
                                    <td>" . $fila[$clave]->fecha_salida . "</td>
                                    <td>" . $fila[$clave]->fecha_llegada . "</td>
                                    <td>" . $fila[$clave]->duracion . "</td>
                                    <td>" . $fila[$clave]->costo_turista . "</td>
                                    <td>" . $fila[$clave]->costo_ejecutiva . "</td>
                                    <td>" . $fila[$clave]->estado . "</td>
                                    <td class = 'text-center'>" . $fila[$clave]->Codigo_Avion . "</td>
                                    <td>" . $fila[$clave]->avion . "</td>
                                </tr>";
                }

                $salida.= "</tbody></table></div>";
            }
            else{
                $salida.= "No se encontraron registros...";
            }

            echo $salida;
        }
    }
?>