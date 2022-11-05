<?php
session_start();  
require_once './config/connection.php';
require './includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='ADMINISTRADOR'){
    header("location:error-403");
}
$db_consulting="SELECT*FROM login INNER JOIN privilege ON login.id_privilege = privilege.id_privilege";
$result=mysqli_query($conn, $db_consulting);
$view=mysqli_fetch_array($result);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUARIOS</title>
    <link rel="shortcut icon" href="assets/img/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400&display=swap');
    </style>
</head>
<body>
     <!--Este es el inicio del menu horizontal -->
    <div class="nav-bar">
        <a class="logo" href="panel_admin"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
                <a href="panel_admin"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                <!--este apartado esta para abrir los usuarios registrados -->
                <a href="doctor"><i class="fa-solid fa-user-doctor"></i> Doctor</a>
                <!--este apartado esta para abrir los profesionales encargados -->
                <a href="student"><i class="fa-solid fa-graduation-cap"></i> Alumnos</a>
                <!--este apartado esta para abrir los usuarios registrados -->
                <a href="specialty"><i class="fa-solid fa-stethoscope"></i> Especialidades</a>
                <!--este apartado esta para abrir la lista de las especialidades -->
                <a href="user"><i class="fa-solid fa-user"></i> Usuario</a> 
                <!--este apartado esta para abrir los usuarios registrados -->
                <a href="about.html"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
                <!--este apartado esta para abrir el menu de ayuda -->
                <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a> <!--este apartado esta para cerrar la sesion de la cuenta ingresada -->
        </nav>
    </div>    
    <div class="all-1">
   
        </div>
        <div class="form-5">
            <div class="form-2">
                <div class="div-users">
                    <div class="div-user">
                        <h1>USUARIOS</h1>
                    </div>
                    <div class="div-add-user">
                        <a class="myButton" href="register_user"><i class="fa-solid fa-plus"></i> Añadir nuevo usuario</a>
                    </div>
                </div>
                <fieldset class="form-4">
                    <table class="blueTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th><!--Este apartado sirve para mostrar el id del USER -->
                                <th scope="col">NOMBRE</th><!--Este apartado sirve para mostrar el nombre del USER -->
                                <th scope="col">PRIVILEGIO</th><!--Este apartado sirve para mostrar el PRIVILIGIO del USER -->
                                <th scope="col">ACCIÓN</th><!--Este apartado sirve para realizar la accion de modificar o eliminar USER -->
                            </tr>
                        </thead>
                        <tbody id="datos">
                            <?php  /* Este codigo recorre los datos de la tabla de la base de datos*/
                            foreach($result as $row){
                            ?>
                            <tr>
                                <td><?php echo $row['id_user']; ?></td>
                                <td style="text-transform:uppercase;"><?php echo $row['username']; ?></td>
                                <td><?php echo $row['privilege']; ?></td>
                                <td>
                                    <a href="edit_user?id_user=<?php echo $row['id_user'];?>"><i class="myButton-edit fa-solid fa-pen-to-square"></i></a><!--este apartado sirve para  editar USERS -->
                                    <a href="delete_user.php?id_user=<?php echo $row['id_user'];?>" onclick="return confirm('Estás seguro que deseas eliminar el registro?');"><i class="myButton-del fa-solid fa-trash"></i></a><!--Este apartado sirve para  eliminar USERS -->
                                </td>
                            </tr>
                            <?php 
                            }  /*Fin del recorrido de datos*/
                            mysqli_free_result($result);
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                 <!--Fin de la tabla en donde se visualiza los datos del USER -->
                </br>
            </div>
        </div>
    </div>
</body>
</html>