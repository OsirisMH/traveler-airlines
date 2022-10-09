<?php
    class UsuarioModelo{
        private $db;

        public function __construct()
        {
            $this->db = new base();
        }

        public function buscarDatos(){
            $salida = "";
            $query = 'SELECT U.ID_Usuario,
                             CONCAT(E.Nombre, \' \', E.Apellido) AS Empleado,
                             U.Nombre_Usuario,
                             U.Contraseña,
                             U.Link_Foto
                      FROM Usuarios U INNER JOIN Empleados E ON U.Numero_Empleado_U = E.Numero_Empleado';

            if(isset($_POST['consultaUsuario'])){
                $Nombre = $_POST['consultaUsuario'];
                $query = "SELECT U.ID_Usuario,
                                 CONCAT(E.Nombre, ' ', E.Apellido) AS Empleado,
                                 U.Nombre_Usuario,
                                 U.Contraseña,
                                 U.Link_Foto
                          FROM Usuarios U INNER JOIN Empleados E ON U.Numero_Empleado_U = E.Numero_Empleado
                          WHERE CONCAT(E.Nombre, ' ', E.Apellido) LIKE '%".$Nombre."%'";
            }

            $this->db->query($query);
            if($this->db->contarFilas() > 0){
                $salida = "<table class = 'table table-hover table-striped fixed-table-body'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Empleado</th>
                                        <th>Nombre de Usuario</th>
                                        <th>Contraseña</th>
                                        <th>Foto de perfil</th>
                                    </tr>
                                </thead> 
                                <tbody>";
                $fila = $this->db->registros();
                foreach($fila as $clave=>$valor){
                    $salida.= "<tr>
                                    <td>" . $fila[$clave]->ID_Usuario . "</td>
                                    <td>" . $fila[$clave]->Empleado . "</td>
                                    <td>" . $fila[$clave]->Nombre_Usuario . "</td>
                                    <td>" . $fila[$clave]->Contraseña . "</td>
                                    <td><img src ='" . $fila[$clave]->Link_Foto . "' width = '30'></td>
                                </tr>";
                }

                $salida.= "</tbody></table>";
            }
            else{
                $salida.= "No se encontraron registros...";
            }

            echo $salida;
        }

        public function empleadosSinUsuario(){
            $this->db->query('SELECT E.Numero_Empleado,
                              CONCAT(E.Nombre, " ", E.Apellido) as Nombre
                              FROM Empleados E
                              LEFT JOIN Usuarios U
                                ON U.Numero_Empleado_U = E.Numero_Empleado
                              WHERE U.Numero_Empleado_U IS NULL');
            $resultados = $this->db->arrayAllRegistros();
            return $resultados;
        }

        public function obtenerContraseña($id) {
            $this->db->query('SELECT Contraseña FROM Usuarios WHERE Numero_Empleado_U = :id');
            $this->db->bind(':id', $id);
            $fila = $this->db->arrayRegistros();
            
            echo json_encode($fila);
        }
        
        public function RegistrarUsuario($datos){
            $this->db->query("INSERT INTO `usuarios` (`ID_Usuario`, `Nombre_Usuario`, `Contraseña`, `Link_Foto`, `Numero_Empleado_U`) VALUES (NULL, :nombre, :contrasena, :linkfoto, :numeroEmpleadoU)");

            //vincular valores
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':contrasena',$datos['contraseña']);
            $this->db->bind(':linkfoto',$datos['linkfoto']);
            $this->db->bind(':numeroEmpleadoU',$datos['numeroEmpleadoU']);

            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function ModificarUsuario($datos) {
            $this->db->query('UPDATE usuarios SET Nombre_Usuario = :nombre,Contraseña=:contraseña , Link_Foto = :linkfoto,Numero_Empleado_U=:numeroEmpleadoU WHERE ID_Usuario=:id');
        
            //Vincular valores
            $this->db->bind(':nombre',$datos['Nombre_Usuario']);
            $this->db->bind(':contraseña',$datos['Contraseña']);
            $this->db->bind(':linkfoto',$datos['Link_Foto']);
            $this->db->bind(':numeroEmpleadoU',$datos['EmpleadoU']);
        
            //Ejecutar
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function BorrarUsuarios($datos) {
            $this->db->query('DELETE FROM Usuarios Where id_Usuario=id');
        
            //Vincular valores
            $this->db->bind(':id', $datos['id_Usuario']);
            
            //Ejecutar
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
?>