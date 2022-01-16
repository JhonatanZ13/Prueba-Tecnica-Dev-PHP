<?php
include_once '../view/partials/navbar.php';
?>
<div class="container">
    <h4 class="display-5">Editar empleado</h4>
    <div class="alert alert-primary" role="alert">
        Los campos con asteriscos (*) son obligatorios.
    </div>
<?php while ($data = mysqli_fetch_assoc($ejecutar)) { ?>
    <form action="<?php echo getUrl('Form', 'Form', 'update', false, 'ajax') ?>" method="POST" id="form">
    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
        <div class="container">
            <div class="row mb-3">
                <label for="nombre" class="col-sm-2 col-form-label fw-bold text-end">Nombre completo *</label>
                <div class="col-sm-10">
                    <input type="text" value="<?php echo $data['nombre'] ?>" class="form-control" name="nombre" id="nombre">
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label fw-bold text-end">Correo electronico *</label>
                <div class="col-sm-10">
                    <input type="email" value="<?php echo $data['email'] ?>" class="form-control" name="email" id="email">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label fw-bold text-end">Sexo *</label>
                <div class="col-sm-10">
                    <?php
                    $checkM = '';
                    $checkF = '';
                    if($data['sexo'] == 'M'){
                        $checkM = 'checked';
                    }else{
                        $checkF = 'checked';
                    } 
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" <?php echo $checkM ?> type="radio" name="sexo" value="M" id="masculino">
                        <label class="form-check-label" for="masculino">
                            Masculino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" <?php echo $checkF ?> type="radio" name="sexo" value="F" id="femenino">
                        <label class="form-check-label" for="femenino">
                            Femenino
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="area" class="col-sm-2 col-form-label fw-bold text-end">Area *</label>
                <div class="col-sm-10">
                    <select name="area_id" id="area" class="form-select">
                        <?php
                        $areas = $this->obj->getAreas();
                        while ($area = mysqli_fetch_assoc($areas)) {
                            if($area['id'] == $data['area_id']){
                                echo '<option selected="selected" value="' . $area['id'] . '">' . $area['nombre'] . '</option>';
                            }else{
                                echo '<option value="' . $area['id'] . '">' . $area['nombre'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="descripcion" class="col-sm-2 col-form-label fw-bold text-end">Descripcion *</label>
                <div class="col-sm-10">
                    <textarea name="descripcion" id="descripcion" class="form-control"><?php echo $data['descripcion'] ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label fw-bold text-end"></label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <?php
                        $checkB = '';
                        if($data['boletin'] == 1){
                            $checkB = 'checked';
                        }
                        ?>
                        <input class="form-check-input" <?php echo $checkB ?> type="checkbox" value="1" name="boletin" id="boletin">
                        <label class="form-check-label" for="boletin">
                            Deseo recibir el boletin informativo
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label fw-bold text-end">Roles *</label>
                <div class="col-sm-10">
                    <?php
                        $rol_empleado = $this->obj->getRolesEmpleado($data['id']);
                    ?>
                    <div class="alert alert-danger d-none" role="alert" id="alert">
                        Debe seleccionar al menos 1 rol
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="alert alert-danger d-none" role="alert" id="alert-errors">
                    Por favor, corrija los errores y vuelva a intentarlo.
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
    <div class="toast align-items-center position-absolute top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" id="toast">
        <div class="d-flex">
            <div class="toast-body" id="toast_body">
                
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>