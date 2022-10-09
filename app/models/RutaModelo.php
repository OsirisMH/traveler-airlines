<?php
    class RutaModelo{
        private $db;

        public function __construct()
        {
            $this->db = new base();
        }

        public function buscarDatos(){
            $salida = "";
            $query = 'SELECT R.Codigo_Ruta,
                             A1.Ciudad AS Origen,
                             A1.Nombre_Aeropuerto AS OrigenA,
                             A2.Ciudad AS Destino,
                             A2.Nombre_Aeropuerto AS DestinoA,
                             R.Duracion_Aprox AS Duracion
                      FROM Rutas R INNER JOIN Aeropuertos A1 ON R.Origen = A1.ID_Aeropuerto
                                   INNER JOIN Aeropuertos A2 ON R.Destino = A2.ID_Aeropuerto';

            if(isset($_POST['consultaRuta'])){
                $Nombre = $_POST['consultaRuta'];
                $query = "SELECT R.Codigo_Ruta,
                                 A1.Ciudad AS Origen,
                                 A1.Nombre_Aeropuerto AS OrigenA,
                                 A2.Ciudad AS Destino,
                                 A2.Nombre_Aeropuerto AS DestinoA,
                                 R.Duracion_Aprox AS Duracion
                          FROM Rutas R INNER JOIN Aeropuertos A1 ON R.Origen = A1.ID_Aeropuerto
                                       INNER JOIN Aeropuertos A2 ON R.Destino = A2.ID_Aeropuerto
                          WHERE A1.Ciudad LIKE '%".$Nombre."%' || A1.Ciudad LIKE '%".$Nombre."%'";
            }

            $this->db->query($query);
            if($this->db->contarFilas() > 0){
                $salida = "<div class = 'tableFixHead'><table class = 'table table-hover table-striped fixed-table-body'>
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Ciudad Origen</th>
                                        <th>Aeropuerto</th>
                                        <th>Ciudad Destino</th>
                                        <th>Aeropuerto</th>
                                        <th>Duración (Min.)</th>
                                    </tr>
                                </thead> 
                                <tbody>";
                $fila = $this->db->registros();
                foreach($fila as $clave=>$valor){
                    $salida.= "<tr>
                                    <td>" . $fila[$clave]->Codigo_Ruta . "</td>
                                    <td>" . $fila[$clave]->Origen . "</td>
                                    <td>" . $fila[$clave]->OrigenA . "</td>
                                    <td>" . $fila[$clave]->Destino . "</td>
                                    <td>" . $fila[$clave]->DestinoA . "</td>
                                    <td>" . $fila[$clave]->Duracion . "</td>
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