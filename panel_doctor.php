<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
$id_user2 = $_SESSION['id'];
if($privilege_admin !='DOCTOR'){
    header("location:error-403");
}
$db_consulting="SELECT*FROM eventos INNER JOIN patient ON eventos.id_patient = patient.id_patient INNER JOIN specialty ON eventos.id_specialty = specialty.id_specialty WHERE id_doctor='$id_user2'";
$result = mysqli_query($conn, $db_consulting);
$view=mysqli_fetch_array($result);
$db_consulting_2="SELECT*FROM doctor";
$result_2=mysqli_query($conn, $db_consulting_2);
$view_2=mysqli_fetch_array($result_2);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANEL DE DOCTOR</title>
    <link rel="shortcut icon" href="assets/img/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400&display=swap');
    </style>
</head>
<body>
    <div class="nav-bar">
        <a class="logo" href="panel_doctor"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
            <a href="panel_doctor"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
            <a href="agenda_doctor"><i class="fa-solid fa-calendar-days"></i> Agenda</a>
            <a href="register_patient"><i class="fa-solid fa-person-half-dress"></i> Registrar Paciente</a>
            <a href="query"><i class="fa-solid fa-person-half-dress"></i> Consulta</a>
            <a href="about.php"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
            <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a> <!--este apartado esta para cerrar la sesion de la cuenta ingresada -->
        </nav>
    </div>
    <div class="all-1">
        <div class="form-5">
            <div class="form-2">
                <div class="div-users">
                    <div class="div-user">
                        <h1>Pacientes</h1>
                    </div>
                </div>
                <fieldset class="form-4">
                    <table class="blueTable">
                        <thead>
                            <tr>
                                <th scope="col">PACIENTES</th><!--Este apartado sirve para mostrar el id del USER -->
                            </tr>
                        </thead>
                        <tbody id="datos">
                            <?php
                            if($id_user2 == $view['id_doctor']){
                                foreach($result as $row){
                            ?>
                            <tr>
                                <td><a href="#" class="myButton_patient"><?php echo $row['name_patient']; echo" "; echo $row['surname_patient']; echo" "; echo $row['title'];?></a></td>
                            </tr>
                            <?php
                                }
                            }
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