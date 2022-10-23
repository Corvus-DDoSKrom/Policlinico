<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='RECEPCIONISTA'){
    header("location:error-403");
}
$db_consulting="SELECT*FROM patient ORDER BY name_patient ASC";
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
    <title>PACIENTE</title>
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
        <a class="logo" href="panel_reception"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
            <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a> <!--este apartado esta para cerrar la sesion de la cuenta ingresada -->
        </nav>
    </div>
    <!--Fin del menu horizontal -->
    <!--Inicio del menu vertical -->
    <div class="all-1">
        <div class="menu">
            <nav class="menuvertical-1">
                <a href="panel_reception"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                <a href="agenda"><i class="fa-solid fa-calendar-days"></i> Agenda</a>
                <a href="register_patient"><i class="fa-solid fa-person-half-dress"></i> Registrar Paciente</a>
                <a href="patient"><i class="fa-solid fa-person-half-dress"></i> Paciente</a>
                <a href="about.php"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
                <!--este apartado esta para abrir el menu de ayuda -->
            </nav>
        </div>
    <!--Fin del menu vertical -->

    <!--Inicio de la seccion de doctor -->
        <div class="form-5">
            <div class="form-2">
                <div class="div-users">
                    <div class="div-user">
                        <h1>PACIENTES</h1>
                    </div>
                    <div class="div-add-user">
                        <a class="myButton" href="register_patient"><i class="fa-solid fa-plus"></i> REGISTRAR PACIENTE</a><!--este apartado es para el boton de añadir doctores -->
                    </div>
                </div>
                <!--Inicio de la tabla en donde se visualizara los datos del doctor -->
                <fieldset class="form-4">
                    <table class="blueTable">
                        <thead>
                            <tr>
                                <th scope="col">NOMBRE</th><!--Este apartado sirve para mostrar el nombre del doctor -->
                                <th scope="col">APELLIDO</th><!--Este apartado sirve para mostrar el Apellido del doctor -->
                                <th scope="col">CEDULA</th><!--Este apartado sirve para mostrar la cedula de identidad del doctor -->
                                <th scope="col">TELÉFONO</th><!--Este apartado sirve para mostrar la matricula del doctor -->
                                <th scope="col">FECHA DE NACIMIENTO</th><!--Este apartado sirve para mostrar la seccion en donde se encuentra el doctor -->
                                <th scope="col">NACIONALIDAD</th><!--Este apartado sirve para realizar la accion de modificar o eliminar doctores -->
                                <th scope="col">RESIDENCIA</th><!--Este apartado sirve para mostrar el nombre del doctor -->
                                <th scope="col">ESTADO CIVIL</th><!--Este apartado sirve para mostrar el nombre del doctor -->
                                <th scope="col">EDAD</th><!--Este apartado sirve para mostrar el nombre del doctor -->
                                <th scope="col">SEXO</th><!--Este apartado sirve para mostrar el nombre del doctor -->
                                <th scope="col">ACCIÓN</th><!--Este apartado sirve para mostrar el nombre del doctor -->
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                        <td colspan="11">
                        <div class="links"><a href="#">&laquo;</a> <a class="active" href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">&raquo;</a></div>
                        </td>
                        </tr>
                        </tfoot>
                        <tbody id="datos">
                            <?php /* Este codigo recorre los datos de la tabla de la base de datos*/
                            foreach($result as $row){
                            ?>
                            <tr>
                                <td><?php echo $row['name_patient']; ?></td>
                                <td><?php echo $row['surname_patient'];?></td>
                                <td><?php echo $row['ci_patient'];?></td>
                                <td><?php echo $row['phone_patient'];?></td>
                                <td><?php echo $row['date_of_birth'];?></td>
                                <td><?php echo $row['nationality'];?></td>
                                <td><?php echo $row['residence'];?></td>
                                <td><?php echo $row['marital_status'];?></td>
                                <td><?php echo $row['age'];?></td>
                                <td><?php echo $row['sex'];?></td>
                                <td>
                                    <a href="edit_patient.php?id_patient=<?php echo $row['id_patient'];?>"><i class="myButton-edit fa-solid fa-pen-to-square"></i></a><!--este apartado sirve para  editar doctor -->
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
                <!--Fin de la tabla en donde se visualiza los datos del doctor -->
                </br>
            </div>
        </div>
        <!--Fin de la seccion de doctor -->
    </div>
</body>
</html>