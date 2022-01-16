<?php
    include_once '../model/MasterModel.php';

    class FormModel extends MasterModel{

        public function getAreas(){
            $sql = 'SELECT * FROM `areas`';
            $consulta = $this->query($sql);
            return $consulta;
        }

        public function getRoles(){
            $sql = 'SELECT * FROM `roles`';
            $consulta = $this->query($sql);
            return $consulta;
        }

        public function getRolesEmpleado($id){
            $roles = $this->getRoles();
            
            while ($rol = mysqli_fetch_assoc($roles)) {
                $sql_rol = "SELECT * FROM empleado_rol WHERE empleado_id = $id AND rol_id = ".$rol['id'];
                $ejec = $this->query($sql_rol);
                if(mysqli_num_rows($ejec) > 0){
                    echo '<div class="form-check">';
                    echo '<input checked class="form-check-input" type="checkbox" value="' . $rol['id'] . '" name="rol_id[]">';
                    echo '<label class="form-check-label" for="">';
                    echo $rol['nombre'];
                    echo '</label>';
                    echo '</div>';
                }else{
                    echo '<div class="form-check">';
                    echo '<input class="form-check-input" type="checkbox" value="' . $rol['id'] . '" name="rol_id[]">';
                    echo '<label class="form-check-label" for="">';
                    echo $rol['nombre'];
                    echo '</label>';
                    echo '</div>';
                }
            }
        }
    }
    
?>