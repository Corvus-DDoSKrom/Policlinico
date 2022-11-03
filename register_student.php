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
    <title>REGISTRAR ALUMNO</title>
    <link rel="shortcut icon" href="assets/img/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400&display=swap');
    </style>
</head>
<body>
    <!-- Este es el inicio del menu horizontal-->
    <div class="nav-bar">
        <a class="logo" href="panel_admin"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
               <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a> <!--este apartado esta para cerrar la sesion de la cuenta ingresada -->
               <a href="panel_admin"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                <!--este apartado esta para abrir los usuarios registrados -->
                <a href="doctor"><i class="fa-solid fa-user-doctor"></i> Doctor</a>
                <!--este apartado esta para abrir los profesionales encargados -->
                <a href="student"><i class="fa-solid fa-graduation-cap"></i> Alumnos</a>
                <!--este apartado esta para abrir los alumnos registrados -->
                <a href="register_specialty"><i class="fa-solid fa-stethoscope"></i> Especialidades</a>
                <!--este apartado esta para abrir la lista de las especialidades -->
                <a href="user"><i class="fa-solid fa-user"></i> Usuario</a> 
                <!--este apartado esta para abrir los usuarios registrados -->
                <a href="about.html"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
                <!--este apartado esta para abrir el menu de ayuda -->
        </nav>
    </div> 
    <div class="all-1">
    
        <!--Fin del menú vertical-->
        <!--Iinicio del panel de registro de alumnos -->
        <div class="form-5">
            <div class="form-2">
                <h1>REGISTRO DE ALUMNOS</h1> 
                <form method="POST" action="register_student.php">
                    <fieldset class="form-4">
                        <div class="form-left">
                            <div>
                                <label for="nombre">NOMBRE:</label>
                                <br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="nombre" id="nombre" required> <!--este apartado esta para registrar el nombre del alumno -->
                            </div>
                            <div>
                                <label for="apellido">APELLIDO</label>
                                <br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="apellido" id="apellido"> <!--este apartado esta para registrar el apellido del alumno -->
                            </div>
                            <div>
                                <label for="cedula">CEDULA</label>
                                <br>
                                <input class="controls-2" type="number" name="cedula" id="cedula"> <!--este apartado esta para registrar el documento de identidad del alumno -->
                            </div>
                            <div>
                                <label for="matricula">N° MATRICULA</label>
                                <br>
                                <input class="controls-2" type="text" name="matricula" id="matricula"> <!--este apartado esta para registrar la matricula del alumno -->
                            </div>
                            <div>
                                <label for="seccion">SECCION</label>
                                <br>
                                <input  class="controls-2" type="text" style="text-transform:uppercase;" name="seccion" id="seccion"> <!--este apartado esta para registrar la seccion en donde registrado el alumno -->
                            </div>
                        </div>                 
                    </fieldset>
                    <br>
                    <button class="myButton" type="submit">Guardar</button> <!--este apartado esta para guardar los cambios realizados en la casillas anteriores -->
                    <button class="myButton" type="reset">Cancelar</button> <!--este apartado esta para cancelar los cambios realizados en la casillas anteriores -->
                </form>
            </div>
        </div>
    </div>
    <!--Inicio del codigo para registrar alumnos -->
    <?php
    require 'config/connection.php';
    /* Aqui comienza la validacion de datos */
    if(isset($_POST['nombre'])){
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $cedula = $_POST["cedula"];
        $matricula = $_POST["matricula"];
        $seccion = $_POST["seccion"];
    /*Fin de la validacion de datos*/
        $db_consulting="SELECT*FROM alumno where matricula='$matricula'"; 
        $result = mysqli_query($conn, $db_consulting);
        $row = mysqli_num_rows($result);
        $view = mysqli_fetch_array($conn, $db_consulting);
        if($row==0){/* Este codigo sirve para verificar si todos los datos son correctos*/
            $sql = "INSERT INTO alumno (nombre_alumno, apellido_alumno, cedula_alumno, matricula, seccion) VALUES ('$nombre', '$apellido', '$cedula', '$matricula', '$seccion')";
            $result = mysqli_query($conn, $sql);
            if($result){/*si todo esta correcto procede a guardar en la base de datos*/
                    echo "<script> alert('Alumno $nombre $apellido registrado');window.location= 'register_student.php' </script>";
            }else {
                    echo "Error: " .$sql."<br>".mysql_error($conn);/*si no, se imprime en pantalla el mensaje de error*/
            }
        
        }else{
                    echo "<script> alert('No puedes registrar a este alumno con matricula: $matricula');window.location= 'register_student' </script>";
        }
    }/*Fin de validacion de datos*/
        mysqli_close($conn);
    ?>
</body>
</html>