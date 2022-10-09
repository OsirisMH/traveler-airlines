<?php
    class EmpleadoModelo{
        private $db;

        public function __construct()
        {
            $this->db = new base();
        }

        public function buscarDatos($POST){    
            $salida = "";
            $query = 'SELECT * FROM Empleados';

            if(isset($POST['consulta'])){
                $Nombre = $POST['consulta'];
                $query = "SELECT * FROM Empleados WHERE Nombre LIKE '%".$Nombre. "%'";
            }

            $this->db->query($query);
            if($this->db->contarFilas() > 0){
                $salida = "<table class = 'table table-hover table-striped' id = 'tabla-empleados'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Fecha de nacimiento</th>
                                        <th>Sexo</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <th>Puesto</th>
                                        <th>Vigencia</th>
                                    </tr>
                                </thead> 
                                <tbody>";
                $fila = $this->db->registros();
                foreach($fila as $clave=>$valor){
                    $salida.= "<tr>
                                    <td>" . $fila[$clave]->Numero_Empleado . "</td>
                                    <td>" . $fila[$clave]->Nombre . "</td>
                                    <td>" . $fila[$clave]->Apellido . "</td>
                                    <td>" . $fila[$clave]->Fecha_Nacimiento . "</td>
                                    <td>" . $fila[$clave]->Sexo . "</td>
                                    <td>" . $fila[$clave]->Correo . "</td>
                                    <td>" . $fila[$clave]->Telefono . "</td>
                                    <td>" . $fila[$clave]->Puesto . "</td>
                                    <td>" . $fila[$clave]->Vigencia . "</td>
                                </tr>";
                }

                $salida.= "</tbody></table>";
            }
            else{
                $salida.= "No se encontraron registros...";
            }

            echo $salida;
        }
        
        public function RegistrarEmpleado($datos){
            $this->db->query('INSERT INTO Empleados (Numero_Empleado, Nombre,Apellido,Fecha_Nacimiento,Sexo,Correo,Telefono,Puesto,Vigencia) VALUES(NULL,:nombre,:apellido,:fecha_nacimiento,:sexo,:correo,:telefono,:puesto, \'ACTIVO\')');

            //vincular valores
            $this->db->bind(':nombre',$datos['Nombre']);
            $this->db->bind(':apellido',$datos['Apellido']);
            $this->db->bind(':fecha_nacimiento',$datos['Fecha_Nacimiento']);
            $this->db->bind(':sexo',$datos['Sexo']);
            $this->db->bind(':correo',$datos['Correo']);
            $this->db->bind(':telefono',$datos['Telefono']);
            $this->db->bind(':puesto',$datos['Puesto']);

            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
        

        public function obtenerEmpleado($id){
            $NumeroEmpleado = $id;
            $this->db->query('SELECT * FROM Empleados WHERE Numero_Empleado = :NumeroEmpleado');
            $this->db->bind(':NumeroEmpleado', $NumeroEmpleado);
            $fila = $this->db->unRegistro();
            return $fila;
        }


        public function ModificarEmpleado($datos){
            $this->db->query('UPDATE Empleados SET Nombre = :Nombre,
                                                   Apellido = :Apellido,
                                                   Fecha_Nacimiento = :Fecha_Nacimiento,
                                                   Sexo = :Sexo,
                                                   Correo = :Correo,
                                                   Telefono = :Telefono,
                                                   Puesto = :Puesto
                              WHERE Numero_Empleado = :NumeroEmpleado');

            //vincular valores
            $this->db->bind(':Nombre',$datos['Nombre']);
            $this->db->bind(':Apellido',$datos['Apellido']);
            $this->db->bind(':Fecha_Nacimiento',$datos['Fecha_Nacimiento']);
            $this->db->bind(':Sexo',$datos['Sexo']);
            $this->db->bind(':Correo',$datos['Correo']);
            $this->db->bind(':Telefono',$datos['Telefono']);
            $this->db->bind(':Puesto',$datos['Puesto']);
            $this->db->bind('NumeroEmpleado', $datos['NumeroEmpleado']);

            //Ejecutar
            if($this->db->execute()) {
                return true;
            } 
            else{
                return false;
            }
        }

        public function DarBaja($id){
            $this->db->query('UPDATE Empleados SET Vigencia=GETDATE() WHERE Numero_Empleado=:id');
            //vincular datos
            $this->db->bind(':id', $id);
            //Ejecutar
            if($this->db->execute()) {
                return true;
            }else {
                return false;
            }
            
        }
        
    }

?>