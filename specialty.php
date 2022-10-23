<!-- Iniciar la sesión -->
<?php
session_start();
require_once './config/connection.php';
require './includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='ADMINISTRADOR'){
    header("location:error-403");
}
$db_consulting="SELECT*FROM specialty";
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
    <title>ESPECIALIDAD</title>
    <link rel="shortcut icon" href="assets/img/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400&display=swap');
    </style>
</head>
<body>
    <!-- MENU HORIZONTAL -->
    <div class="nav-bar">
        <a class="logo" href="panel_panel"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
            <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a>
        </nav>
    </div>
    <div class="all-1">
        <!-- MENU VERTICAL -->
        <div class="menu">
            <nav class="menuvertical-1">
                <a href="panel_admin"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                <a href="doctor"><i class="fa-solid fa-user-doctor"></i> Doctor</a>
                <a href="student"><i class="fa-solid fa-graduation-cap"></i> Alumnos</a>
                <a href="specialty"><i class="fa-solid fa-stethoscope"></i> Especialidad</a>
                <a href="user"><i class="fa-solid fa-user"></i> Usuario</a> 
                <a href="about.html"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
            </nav>
        </div>
        
        <!-- ESPECIALIDAD -->
        <div class="form-5">
            <div class="form-2">Z
                <div class="div-users">
                    <div class="div-user">
                        <h1>ESPECIALIDAD</h1>
                    </div>
                    <div class="div-add-user">
                        <a class="myButton" href="register_specialty"><i class="fa-solid fa-plus"></i> Añadir nueva especialidad</a>
                    </div>
                </div>
                <fieldset class="form-4">
                    <table class="blueTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">ESPECIALIDAD</th>
                                <th scope="col">ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody id="datos">
                            <?php
                            foreach($result as $row){
                            ?>
                            <tr>
                                <td><?php echo $row['id_specialty']; ?></td>
                                <td style="text-transform:uppercase;"><?php echo $row['title']; ?></td>
                                <td>
                                    <a href="edit_specialty?id_specialty=<?php echo $row['id_specialty'];?>"><i class="myButton-edit fa-solid fa-pen-to-square"></i></a>
                                    <a href="delete_specialty.php?id_specialty=<?php echo $row['id_specialty'];?>" onclick="return confirm('Estás seguro que deseas eliminar el registro?');"><i class="myButton-del fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php 
                            }
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