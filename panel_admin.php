<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='ADMINISTRADOR'){
    header("location:error-403");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANEL DE ADMINISTRADOR</title>
    <link rel="shortcut icon" href="assets/img/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400&display=swap');
    </style>
</head>
<body>
    <div class="nav-bar">
        <a class="logo" href="panel_admin"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
            <a href="panel_admin"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
            <!--este apartado esta para abrir los usuarios registrados -->
            <a href="doctor"><i class="fa-solid fa-user-doctor"></i> Doctor</a>
            <!--este apartado esta para abrir los profesionales encargados -->
            <a href="student"><i class="fa-solid fa-graduation-cap"></i> Alumnos</a>
            <!--este apartado esta para abrir los usuarios registrados -->
            <a href="specialty"><i class="fa-solid fa-stethoscope"></i> Especialidad</a>
            <!--este apartado esta para abrir la lista de las especialidades -->
            <a href="user"><i class="fa-solid fa-user"></i> Usuario</a> 
            <!--este apartado esta para abrir los usuarios registrados -->
            <a href="about.php"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
            <!--este apartado esta para abrir el menu de ayuda -->
            <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a> <!--este apartado esta para cerrar la sesion de la cuenta ingresada -->
        </nav>
    </div>
    <div class="all-1">
        <div class="form-5">
            <div class="form-2">
                <div class="div-users">
                    <div class="div-user">
                        <h1>Panel de ADMINISTRADOR</h1>
                    </div>
                </div>
                <fieldset>
                    
                </fielset>
            </div>
        </div>
    </div>
</body>
</html>