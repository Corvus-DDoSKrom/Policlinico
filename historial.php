<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='DOCTOR'){
    header("location:error-403");
}
$id_user2 = $_SESSION['name_doctor'];
$db_consulting="SELECT*FROM consulta INNER JOIN patient ON consulta.id_patient = patient.id_patient INNER JOIN detalle_consulta ON consulta.id_detalle_consulta = detalle_consulta.id_detalle_consulta INNER JOIN doctor ON consulta.id_doctor = doctor.id_doctor INNER JOIN specialty ON consulta.id_specialty = specialty.id_specialty WHERE name_doctor='$id_user2'";
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
    <title>HISTORIAL</title>
    <link rel="shortcut icon" href="assets/img/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400&display=swap');
    </style>
</head>
<body>
    <div class="nav-bar">
        <a class="logo" href="panel_reception"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
            <a href="panel_reception"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
            <a href="agenda"><i class="fa-solid fa-calendar-days"></i> Agenda</a>
            <a href="register_patient"><i class="fa-solid fa-person-half-dress"></i> Registrar Paciente</a>
            <a href="patient"><i class="fa-solid fa-person-half-dress"></i> Paciente</a>
            <a href="about.php"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
                <!--este apartado esta para abrir el menu de ayuda -->
            <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a> <!--este apartado esta para cerrar la sesion de la cuenta ingresada -->
        </nav>
    </div>
    <div class="all-1">
        <div class="form-5">
            <div class="form-2">
                <div class="div-users">
                    <div class="div-2">
                        <div class="div-user">
                            <h1>HISTORIAL</h1>
                        </div>
                    </div>
                    <div class="div-3">
                        <div class="div-add-user">
                            <a class="myButton" href="register_user"><i class="fa-solid fa-plus"></i> Añadir nuevo usuario</a>
                        </div>
                    </div>
                </div>
                <fieldset class="form-4">
                    <table class="blueTable">
                        <thead>
                            <tr>
                                <th scope="col">PACIENTE</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">DOCTOR</th>
                                <th scope="col">ESPECIALIDAD</th>
                                <th scope="col">ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody id="datos">
                            <?php  /* Este codigo recorre los datos de la tabla de la base de datos*/
                            foreach($result as $row){
                            ?>
                            <tr>
                                <td style="text-transform:uppercase;"><?php echo $row['name_patient'],' ', $row['surname_patient']; ?></td>
                                <td><?php echo $row['fecha']; ?></td>
                                <td><?php echo $row['name_doctor']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td>
                                    <a class="myButton-histo" href="#"><span></span>Ver historial</a>
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