<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='ADMINISTRADOR'){
    header("location:error-403");
}
$db_consulting="SELECT*FROM login INNER JOIN privilege ON login.id_privilege = privilege.id_privilege WHERE privilege='DOCTOR'";
$result=mysqli_query($conn, $db_consulting);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400&display=swap');
    </style>
    <title>REGISTRAR DOCTOR</title>
</head>
<body>
<!-- Barra Vertical Izquierda -->
    <div class="nav-bar">
        <a class="logo" href="panel_admin"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
            <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a> <!--este apartado esta para cerrar la sesion de la cuenta ingresada -->
        </nav>
    </div>
<!-- Barra Horizontal Superior -->
    <div class="all-1">
        <div class="menu">
            <nav class="menuvertical-1">
                <a href="panel_admin"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                <!--este apartado esta para abrir los usuarios registrados -->
                <a href="doctor"><i class="fa-solid fa-user-doctor"></i> Doctor</a>
                <!--este apartado esta para abrir los profesionales encargados -->
                <a href="student"><i class="fa-solid fa-graduation-cap"></i> Alumnos</a>
                <!--este apartado esta para abrir los Alumnos registrados -->
                <a href="register_specialty"><i class="fa-solid fa-stethoscope"></i> Especialidades</a>
                <!--este apartado esta para abrir la lista de las especialidades -->
                <a href="user"><i class="fa-solid fa-user"></i> Usuario</a> 
                <!--este apartado esta para abrir los usuarios registrados -->
                <a href="about.html"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
                <!--este apartado esta para abrir el menu de ayuda -->
            </nav>
        </div>
        <!-- Área Central -->
        <div class="form-5">
            <div class="form-2">
                <h1>REGISTRAR DOCTOR</h1>
                <form action="register_doctor" method="post">
                    <fieldset class="form-4">
                        <div class="form-left">
                            <div>
                                <label for="nombre">Nombre</label>
                                <br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="name_doctor" id="name"><!--este apartado esta para registrar el documento de identidad del doctor -->
                            </div>
                            <div>
                                <label for="apellido">Apellido</label>
                                <br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="surname_doctor" id="surname"><!--este apartado esta para registrar el Apellido del Doctor -->
                            </div>
                            <div>
                                <label for="email">Email</label>
                                <br>
                                <input class="controls-2" type="email" name="email_doctor" id="email"><!--este apartado esta para registrar correo electronico del doctor -->
                            </div>
                            <div>
                                <label for="telefono">Telefono</label>
                                <br>
                                <input class="controls-2" type="text" name="phone_doctor" id="phone"><!--este apartado esta para registrar el numero de telefono del doctor -->
                            </div>
                            <div>
                                <label for="direc">Direccion</label>
                                </br>
                                <input class="controls-2" type="text" name="direction_doctor" id="doctor"><!--este apartado esta para registrar la direccion del doctor -->
                            </div>
                            <div>
                                <label for="user">USUARIO</label>
                                </br>
                                <select class="controls-2" style="text-transform:uppercase;" name="id_user">USUARIO
                                <?php
                                while ($row = mysqli_fetch_array($result)){
                                    $id_user = $row['id_user'];
                                    $username = $row['username'];
                                ?>
                                    <option value="<?php echo $id_user; ?>"><?php echo("$username"); ?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                        </div>    
                    </fieldset>
                    <br>
                    <button class="myButton" type="submit" name="buttonguardar">Guardar</button><!--este apartado esta para guardar los cambios realizados en la casillas anteriores -->
                    <button class="myButton" type="reset">Cancelar</button><!--este apartado esta para cancelar los cambios realizados en la casillas anteriores -->
                </form>
            </div>
        </div>
        <!--Fin del area central -->
    </div>

    <!--Inicio del codigo para registrar doctor -->
    <?php
    require 'config/connection.php';
    /*Validacion de datos*/
    if(isset($_POST['buttonguardar'])){
        $name_doctor = $_POST["name_doctor"];
        $surname_doctor = $_POST["surname_doctor"];
        $email_doctor = $_POST["email_doctor"];
        $phone_doctor = $_POST["phone_doctor"];
        $direction_doctor = $_POST["direction_doctor"];
        $user = $_POST["id_user"];
    /*fin de la validacion de datos*/
        $db_consulting_2="SELECT*FROM doctor where name_doctor='$name_doctor'"; 
        $result_2 = mysqli_query($conn, $db_consulting_2);
        $row = mysqli_num_rows($result_2);
        $view = mysqli_fetch_array($conn, $db_consulting_2);
        if($row==0){ /* Este codigo sirve para verificar si todos los datos son correctos*/
            $sql = "INSERT INTO doctor (id_user, name_doctor, surname_doctor, email_doctor, phone_doctor, direction_doctor) VALUES ('$user', '$name_doctor', '$surname_doctor', '$email_doctor', '$phone_doctor', '$direction_doctor')";
            $result_2 = mysqli_query($conn, $sql);
            if($result_2){/*si todo esta correcto procede a guardar en la base de datos*/
                    echo "<script> alert('Doctor/a $name_doctor $surname_doctor registrado');window.location= 'doctor' </script>";
            }else {
                    echo "Error: " .$sql."<br>".mysql_error($conn); /*si no, se imprime en pantalla el mensaje de error*/
            }
        
        }else{
                    echo "<script> alert('No puedes registrar a este Doctor/a: $name_doctor $surname_doctor');window.location= 'register_doctor' </script>";
        }
    }
        mysqli_close($conn);
    /*Fin del codigo para registrar doctor*/
    ?>
</body>
</html>