<?php
session_start();
require_once './config/connection.php';
require './includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='ADMINISTRADOR'){
    header("location:error-403");
}
$db_consulting="SELECT*FROM doctor";
$result = mysqli_query($conn, $db_consulting);
$view = mysqli_fetch_array($result);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOCTOR</title>
    <link rel="shortcut icon" href="assets/img/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400&display=swap');
    </style>
</head>
<body>
    <!-- Menu -->
    <div class="nav-bar">
        <a class="logo" href="panel_admin"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
            <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a> <!--este apartado esta para cerrar la sesion de la cuenta ingresada -->
        </nav>
    </div>
    <div class="all-1">
        <div class="menu">
            <nav class="menuvertical-1">
                <a href="panel_admin"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                <a href="doctor"><i class="fa-solid fa-user-doctor"></i> Doctor</a>
                <a href="student"><i class="fa-solid fa-graduation-cap"></i> Alumnos</a>
                <a href="register_specialty"><i class="fa-solid fa-stethoscope"></i> Especialidades</a>
                <a href="user"><i class="fa-solid fa-user"></i> Usuario</a>
                <a href="about.html"><i class="fa-solid fa-circle-question"></i> Ayuda</a
            </nav>
        </div>

    <!-- Seccion de doctor -->
        <div class="form-5">
            <div class="form-2">
                <div class="div-users">
                    <div class="div-user">
                        <h1>DOCTOR</h1>
                    </div>
                    <div class="div-add-user">
                        <a class="myButton" href="register_doctor"><i class="fa-solid fa-plus"></i> Añadir doctor</a>
                    </div>
                </div>
                
                <!--Datos del doctor -->
                <fieldset class="form-4">
                    <table class="blueTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">APELLIDO</th>
                                <th scope="col">E-MAIL</th>
                                <th scope="col">TELÉFONO</th>
                                <th scope="col">DIRECCIÓN</th>
                                <th scope="col">ACCIÓN</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                        <td colspan="7">
                        <div class="links"><a href="#">&laquo;</a> <a class="active" href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">&raquo;</a></div>
                        </td>
                        </tr>
                        </tfoot>
                        <tbody id="datos">
                            
                            <?php /* Recorre los datos de la tabla de la base de datos*/
                            foreach($result as $row){
                            ?>
                            <tr>
                                <td><?php echo $row['id_doctor']; ?></td>
                                <td style="text-transform:uppercase;"><?php echo $row['name_doctor']; ?></td>
                                <td style="text-transform:uppercase;"><?php echo $row['surname_doctor'];?></td>
                                <td><?php echo $row['email_doctor'];?></td>
                                <td><?php echo $row['phone_doctor'];?></td>
                                <td><?php echo $row['direction_doctor'];?></td>
                                <td>
                                    <a href="edit_doctor?id_doctor=<?php echo $row['id_doctor'];?>"><i class="myButton-edit fa-solid fa-pen-to-square"></i></a><!--este apartado sirve para  editar doctor -->
                                    <a href="delete_doctor.php?id_doctor=<?php echo $row['id_doctor'];?>" onclick="return confirm('Estás seguro que deseas eliminar el registro?');"><i class="myButton-del fa-solid fa-trash"></i></a><!--Este apartado sirve para  eliminar doctor -->
                                </td>
                            </tr>
                            <?php 
                            }
                            /*Fin del recorrido de datos*/
                            mysqli_free_result($result);
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                </br>
            </div>
        </div>
    </div>
</body>
</html>
