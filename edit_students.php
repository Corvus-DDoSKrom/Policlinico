<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='ADMINISTRADOR'){
    header("location:error-403");
}
$id_alumno = $_GET['id_alumno'];
$db_consulting="SELECT*FROM alumno Where id_alumno = '$id_alumno'";
$result = mysqli_query($conn, $db_consulting);
$view = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR ALUMNOS</title>
    <link rel="shortcut icon" href="assets/img/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400&display=swap');
    </style>
</head>
<body>
    <!--Inicio de la creacion del menu horizontal -->
    <div class="nav-bar">
        <a class="logo" href="panel_admin"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
            <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a> <!--este apartado esta para cerrar la sesion de la cuenta ingresada -->
        </nav>
    </div>
    <!--Fin del menu horizontal -->
    <!--Inicio de la creacion del menu vertical -->
    <div class="all-1">
        <div class="menu">
            <nav class="menuvertical-1">
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
        <!--Fin del menu vertical -->
        <!--Este es el inicio del panel de registro de alumnos -->
        <div class="form-5">
            <div class="form-2">
                <h1>EDITAR ALUMNOS</h1> 
                <form method="POST" action="edit_student">
                    <fieldset class="form-4">
                        <div class="form-left">
                            <div>
                                <label for="name-user">ID DEL ALUMNO</label>
                                </br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="id_alumno" id="id_alumno" value="<?php echo $_GET['id_alumno']; ?>" readonly></br>
                            </div>
                            <div>
                                <label for="nombre">NOMBRE:</label>
                                <br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="nombre" id="nombre" required value="<?php echo $view['nombre_alumno']; ?>"> <!--este apartado esta para registrar el nombre del alumno -->
                            </div>
                            <div>
                                <label for="apellido">APELLIDO</label>
                                <br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="apellido" id="apellido" value="<?php echo $view['apellido_alumno']; ?>"> <!--este apartado esta para registrar el apellido del alumno -->
                            </div>
                            <div>
                                <label for="cedula">CEDULA</label>
                                <br>
                                <input class="controls-2" type="number" name="cedula" id="cedula" value="<?php echo $view['cedula_alumno']; ?>"> <!--este apartado esta para registrar el documento de identidad del alumno -->
                            </div>
                            <div>
                                <label for="matricula">N° MATRICULA</label>
                                <br>
                                <input class="controls-2" type="text" name="matricula" id="matricula" value="<?php echo $view['matricula']; ?>"> <!--este apartado esta para registrar la matricula del alumno -->
                            </div>
                            <div>
                                <label for="seccion">SECCION</label>
                                <br>
                                <input  class="controls-2" type="text" style="text-transform:uppercase;" name="seccion" id="seccion" value="<?php echo $view['seccion']; ?>"> <!--este apartado esta para registrar la seccion del alumno -->
                            </div>
                        </div>                 
                    </fieldset>
                    <br>
                    <button class="myButton" type="submit" name="buttonguardar">Guardar</button> <!--este apartado esta para guardar los cambios realizados en la casillas anteriores -->
                    <button class="myButton" type="reset">Cancelar</button> <!--este apartado esta para cancelar los cambios realizados en la casillas anteriores -->
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<!--Inicio del codigo para editar alumnos -->
<?php
    if(isset($_POST['nombre'])){
        /*este apartado sirve para validar los datos*/
        $id_alumno = $_POST["id_alumno"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $cedula = $_POST["cedula"];
        $matricula = $_POST["matricula"];
        $seccion = $_POST["seccion"];
        /*Fin de validacion de datos*/
        
        /*Inicio de la sentencia para modificar los datos*/
        if(isset($_POST["buttonguardar"])){
            $db_updating = "UPDATE alumno SET nombre_alumno='$nombre', apellido_alumno='$apellido', cedula_alumno='$cedula', matricula='$matricula', seccion='$seccion' WHERE id_alumno=$id_alumno";
            $result = mysqli_query($conn, $db_updating);
            if($result){
                echo "<script> alert('Alumno modificado: $nombre $apellido');window.location= 'student' </script>";/*este apartado sirve para mostrar un mensaje una vez modificado*/
            }
            else 
            {
                echo "Error: " .$sql."<br>".mysql_error($conn);
            }
        }
        mysqli_close($conn);
    }/*--Fin de la sentencia para modificar los datos */
?>
<!--Fin del codigo para editar alumnos -->