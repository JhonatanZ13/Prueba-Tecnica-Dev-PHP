<?php
include_once '../view/partials/navbar.php';
?>

<div class="container">
    <h4 class="display-5">Lista de empleados</h4>
    <br>
    <div class="row">
        <div class="col-sm-12 mb-3">
            <button class="btn btn-primary float-end"><i class="fas fa-user-plus"></i> Crear</button>
        </div>
    </div>
    <table class="table table-striped">
    <thead>
        <tr>
            <th><i class="fas fa-user"></i> Nombre</th>
            <th><i class="fas fa-at"></i> Email</th>
            <th><i class="fas fa-venus-mars"></i> Sexo</th>
            <th><i class="fas fa-briefcase"></i> Area</th>
            <th><i class="fas fa-envelope"></i> Boletin</th>
            <th>Modificar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($data = mysqli_fetch_assoc($ejecutar)) {
               echo "<tr>";
               echo "<td>".$data['nombre']."</td>";
               echo "<td>".$data['email']."</td>";
               echo "<td>";
                    echo $data['sexo'] == "M" ? "Masculino" : "Femenino";
               echo "</td>";
               echo "<td>".$data['area']."</td>";
               echo "<td>";
                echo $data['boletin'] == 1 ? "Si" : "No";
                echo "</td>";
               echo "<td><button class='btn'><i class='fas fa-edit'></i></button></td>";
               echo "<td><button class='btn'><i class='fas fa-trash-alt'></i></button></td>";
               echo "</tr>";
            }
        ?>
        
    </tbody>
    </table>
</div>
