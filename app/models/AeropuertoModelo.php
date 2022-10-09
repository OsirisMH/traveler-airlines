<?php
    class AeropuertoModelo{
        private $db;

        public function __construct()
        {
            $this->db = new base();
        }

        public function buscarDatos(){
            $salida = "";
            $query = 'SELECT * FROM Aeropuertos';

            if(isset($_POST['consultaAero'])){
                $Nombre = $_POST['consultaAero'];
                $query = "SELECT * FROM Aeropuertos
                          WHERE Nombre_Aeropuerto LIKE '%".$Nombre."%'";
            }

            $this->db->query($query);
            if($this->db->contarFilas() > 0){
                $salida = "<div class = 'tableFixHead'><table class = 'table table-hover table-striped fixed-table-body'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Aeropuerto</th>
                                        <th>Estado</th>
                                        <th>Ciudad</th>
                                        <th>Código IATA</th>
                                    </tr>
                                </thead> 
                                <tbody>";
                $fila = $this->db->registros();
                foreach($fila as $clave=>$valor){
                    $salida.= "<tr>
                                    <td>" . $fila[$clave]->ID_Aeropuerto . "</td>
                                    <td>" . $fila[$clave]->Nombre_Aeropuerto . "</td>
                                    <td>" . $fila[$clave]->Estado . "</td>
                                    <td>" . $fila[$clave]->Ciudad . "</td>
                                    <td>" . $fila[$clave]->Codigo_IATA . "</td>
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