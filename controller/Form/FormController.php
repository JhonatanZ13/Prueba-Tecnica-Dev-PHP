<?php 
    include_once '../model/Form/FormModel.php';

    class FormController{

        var $obj;

        public function __construct(){
            $this->obj = new FormModel();
        }

        public function home(){
            $sql = 'SELECT e.id, e.nombre, e.email, e.sexo, a.nombre as area, e.boletin
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

            if(isset($_POST['nombre']) && $_POST['nombre'] != ''){
                $nombre = $_POST['nombre'];
            }else{
                array_push($data, ['message' => 'Por favor, ingrese el nombre.']);
            }

            if(isset($_POST['email']) && $_POST['email'] != ''){
                $email = $_POST['email'];
            }else{
                array_push($data, ['message' => 'Por favor, ingrese el email.']);
            }

            if(isset($_POST['sexo']) && $_POST['sexo'] != ''){
                $sexo = $_POST['sexo'];
            }else{
                array_push($data, ['message' => 'Por favor, elije tu sexo.']);
            }
            
            if(isset($_POST['area_id']) && $_POST['area_id'] != ''){
                $area_id  = $_POST['area_id'];
            }else{
                array_push($data, ['message' => 'Por favor, elija una area.']);
            }

            if(isset($_POST['boletin']) && $_POST['boletin'] != ''){
                $boletin = $_POST['boletin'];
            }else{
                $boletin = 0;
            }
            if(isset($_POST['descripcion']) && $_POST['descripcion'] != ''){
                $descripcion = $_POST['descripcion'];
            }else{
                array_push($data, ['message' => 'Por favor, escriba una breve descripcion.']);
            }

            if(count($data) > 0){
                echo json_encode($data);
                return;
            }
            

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
                array_push($data, ['message' => 'Todo correcto', 'success' => 'true']);
                echo json_encode($data);
            }else{
                array_push($data, ['message' => 'Algo salio mal']);
                echo json_encode($data);
            }
        }

        public function edit(){
            $id = $_GET['id'];
            $sql = "SELECT * FROM empleado WHERE id = $id";
            $ejecutar =  $this->obj->query($sql);

            
            include_once '../view/form/editar_empleado.php';
        }

        public function update(){
            $data = array();
            $id = $_POST['id'];
            if(isset($_POST['nombre']) && $_POST['nombre'] != ''){
                $nombre = $_POST['nombre'];
            }else{
                array_push($data, ['message' => 'Por favor, ingrese el nombre.']);
            }

            if(isset($_POST['email']) && $_POST['email'] != ''){
                $email = $_POST['email'];
            }else{
                array_push($data, ['message' => 'Por favor, ingrese el email.']);
            }

            if(isset($_POST['sexo']) && $_POST['sexo'] != ''){
                $sexo = $_POST['sexo'];
            }else{
                array_push($data, ['message' => 'Por favor, elije tu sexo.']);
            }
            
            if(isset($_POST['area_id']) && $_POST['area_id'] != ''){
                $area_id  = $_POST['area_id'];
            }else{
                array_push($data, ['message' => 'Por favor, elija una area.']);
            }

            if(isset($_POST['boletin']) && $_POST['boletin'] != ''){
                $boletin = $_POST['boletin'];
            }else{
                $boletin = 0;
            }
            if(isset($_POST['descripcion']) && $_POST['descripcion'] != ''){
                $descripcion = $_POST['descripcion'];
            }else{
                array_push($data, ['message' => 'Por favor, escriba una breve descripcion.']);
            }

            if(count($data) > 0){
                echo json_encode($data);
                return;
            }
            

            //Update empleado
            $sql = "UPDATE empleado SET
               nombre = '$nombre', 
               email = '$email', 
               sexo = '$sexo', 
               area_id = $area_id, 
               boletin = $boletin, 
               descripcion = '$descripcion'
               WHERE id = $id
            ";
            $update = $this->obj->query($sql);
            //Insertar roles
            $sql_delete = "DELETE FROM empleado_rol WHERE empleado_id = $id";
            $borrar = $this->obj->query($sql_delete);
            $rol_id = $_POST['rol_id'];
            foreach ($rol_id as $rol) {
                $sql_rol = "INSERT INTO empleado_rol VALUES(
                    $id, $rol
            )";
                $ejecutar_rol = $this->obj->query($sql_rol);
            }

            if($update){
                array_push($data, ['message' => 'Se actualizaron los datos correctamente']);
                echo json_encode($data);
            }else{
                array_push($data, ['message' => 'Algo salio mal']);
                echo json_encode($data);
            }
        }

        public function delete(){
            $id = $_GET['id'];
            $sql = "DELETE FROM empleado WHERE id = $id";
            $ejecutar =  $this->obj->query($sql);

            $sql = "DELETE FROM empleado_roles WHERE empleado_id = $id";
            $ejecutar =  $this->obj->query($sql);

            redirect(getUrl('Form','Form','home'));
        }
    }

?>