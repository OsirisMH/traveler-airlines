<?php
    class AvionModelo{
        private $db;

        public function __construct()
        {
            $this->db = new base();
        }

        public function buscarDatos($POST){    
            $salida = "";
            $query = 'SELECT * FROM Aviones';

            if(isset($POST['consulta'])){
                $Nombre = $POST['consulta'];
                $query = "SELECT * FROM Aviones WHERE Modelo LIKE '%".$Nombre. "%'";
            }

            $this->db->query($query);
            if($this->db->contarFilas() > 0){
                $salida = "<div class = 'tableFixHead'><table class = 'table table-hover table-striped table-fixed'>
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Modelo</th>
                                        <th>Descripción</th>
                                        <th>Capacidad</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead> 
                                <tbody>";
                $fila = $this->db->registros();
                foreach($fila as $clave=>$valor){
                    $salida.= "<tr>
                                    <td>" . $fila[$clave]->Codigo_Avion . "</td>
                                    <td>" . $fila[$clave]->Modelo . "</td>
                                    <td>" . $fila[$clave]->Descripcion . "</td>
                                    <td>" . $fila[$clave]->Capacidad . "</td>
                                    <td>" . $fila[$clave]->Estado . "</td>
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