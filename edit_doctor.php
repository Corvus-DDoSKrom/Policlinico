<!-- Iniciar la sesión -->
<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='ADMINISTRADOR'){
    header("location:error-403");
}
$id_doctor = $_GET['id_doctor'];
$db_consulting="SELECT*FROM doctor Where id_doctor = '$id_doctor'";
$result = mysqli_query($conn, $db_consulting);
$view = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR DOCTOR</title>
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
        <a class="logo" href="panel_admin"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
                <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a>
                <a href="panel_admin"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                <a href="doctor"><i class="fa-solid fa-user-doctor"></i> Doctor</a>
                <a href="student"><i class="fa-solid fa-graduation-cap"></i> Alumnos</a>
                <a href="register_specialty"><i class="fa-solid fa-stethoscope"></i> Especialidades</a>
                <a href="user"><i class="fa-solid fa-user"></i> Usuario</a> 
                <a href="about.html"><i class="fa-solid fa-circle-question"></i> Ayuda</a>      
        </nav>
    </div>
    <div class="all-1">
         <!-- Empieza area: EDIT DOCTOR -->
        <div class="form-5">
            <div class="form-2">
                <h1>EDITAR DOCTOR/A</h1>
                <form action="edit_doctor" method="post">
                    <fieldset class="form-4">
                        <div class="form-left">
                            <div>
                                <label for="name-user">ID DEL DOCTOR/A</label>
                                </br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="id_doctor" id="id_doctor" value="<?php echo $_GET['id_doctor']; ?>" readonly></br>
                            </div>
                            <div>
                                <label for="nombre">Nombre</label>
                                <br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="name_doctor" id="name">
                            </div>
                            <div>
                                <label for="apellido">Apellido</label>
                                <br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="surname_doctor" id="surname">
                            </div>
                            <div>
                                <label for="email">Email</label>
                                <br>
                                <input class="controls-2" type="email" name="email_doctor" id="email">
                            </div>
                            <div>
                                <label for="telefono">Telefono</label>
                                <br>
                                <input class="controls-2" type="text" name="phone_doctor" id="phone">
                            <div>
                                <label for="direc">Direccion</label>
                                </br>
                                <input class="controls-2" type="text" name="direction_doctor" id="doctor">
                            </div>
                        </div>    
                    </fieldset>
                    <br>
                    <button class="btn-agregar-conculta" type="submit" name="buttonguardar">Guardar</button><br>
                    <button class="btn-agregar-conculta" type="reset">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- Editar doctor -->
<?php
    require 'config/connection.php';
    if(isset($_POST['name_doctor'])){                    /*Validar los datos*/
        $id_doctor = $_POST["id_doctor"];
        $name_doctor = $_POST["name_doctor"];
        $surname_doctor = $_POST["surname_doctor"];
        $email_doctor = $_POST["email_doctor"];
        $phone_doctor = $_POST["phone_doctor"];
        $direction_doctor = $_POST["direction_doctor"];
        
        if(isset($_POST["buttonguardar"])){             /*Modificar los datos*/
            $db_updating = "UPDATE doctor SET name_doctor='$name_doctor', surname_doctor='$surname_doctor', email_doctor='$email_doctor', phone_doctor='$phone_doctor', direction_doctor='$direction_doctor' WHERE id_alumno=$id_doctor";
            $result = mysqli_query($conn, $db_updating);
            if($result){                                /*Mensaje de modificado exitoso*/
                echo "<script> alert('Doctor/a modificado: $nombre $apellido');window.location= 'student' </script>";
            }
            else{                                       /*Mensaje de error*/
                echo "Error: " .$sql."<br>".mysql_error($conn);
            }
        }
        mysqli_close($conn);
    }
?>