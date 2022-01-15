<?php 
    include_once '../model/Form/FormModel.php';

    class FormController{

        var $obj;

        public function __construct(){
            $this->obj = new FormModel();
        }

        public function home(){
            $sql = 'SELECT e.nombre, e.email, e.sexo, a.nombre as area, e.boletin
                    FROM empleado as e, areas as a
                    WHERE e.area_id = a.id';
            $ejecutar = $this->obj->query($sql);
            
            include_once '../view/form/listar_empleados.php';
        }

        public function create(){
            include_once '../view/form/crear_empleado.php';
        }

        public function insert(){
            $data = array();

            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $sexo = $_POST['sexo'];
            $area_id  = $_POST['area_id'];
            $boletin = $_POST['boletin'];
            $descripcion = $_POST['descripcion'];

            //Insertar empleado
            $id = $this->obj->autoIncrement('empleado','id');
            $sql = "INSERT INTO empleado VALUES(
                $id, '$nombre', '$email', '$sexo', $area_id, $boletin, '$descripcion'
            )";
            $ejecutar = $this->obj->query($sql);
            //Insertar roles

            $rol_id = $_POST['rol_id'];
            foreach ($rol_id as $rol) {
                $sql_rol = "INSERT INTO empleado_rol VALUES(
                    $id, $rol
                )";
                $ejecutar_rol = $this->obj->query($sql_rol);
            }

            if($ejecutar){
                $data['success'] = 'true';
                $data['message'] = 'Todo correcto.';
                echo json_encode($data);
            }
        }
    }

?>