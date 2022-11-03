<?php
//Iniciar la sesión
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
    <title>REGISTRAR USUARIO</title>
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
                <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a>
                <a href="panel_admin"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                 <a href="doctor"><i class="fa-solid fa-user-doctor"></i> Doctor</a>
                 <a href="student"><i class="fa-solid fa-graduation-cap"></i> Alumnos</a>
                 <a href="specialty"><i class="fa-solid fa-stethoscope"></i> Especialidades</a>
                <a href="users"><i class="fa-solid fa-user"></i> Usuario</a> 
                 <a href="about.html"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
        </nav>
    </div>
    <div class="all-1">
    
        
        <div class="form-5">
            <div class="form-2">
                <h1>REGISTRAR USUARIO</h1>
                <form method="post" action="register_user">
                    <fieldset class="form-4">
                        <div class="form-left">
                            <div>
                                <label for="name-user">NOMBRE DE USUARIO</label>
                                </br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="username" id="usuario"></br>
                            </div>
                            <div>
                                <label for="user-pass">CONTRASEÑA</label>
                                </br>
                                <input class="controls-2" type="password" name="passwd"></br>
                            </div>
                            <div>
                                <label for="privilegios">PRIVILEGIO</label>
                                </br>
                                <select class="controls-2" name="privilege" id="tipo_usuario">Privilegio 
                                    <option value="1">ADMINISTRADOR</option>
                                    <option value="2">DOCTOR</option>
                                    <option value="3">ALUMNO</option>
                                    <option value="4">RECEPCIONISTA</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    </br>
                    <button class="myButton" type="submit" name="buttonregistrar">REGISTRAR</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    require 'config/connection.php';

    //VERIFICACION USERNAME
    if(isset($_POST['username'])){
        $username = $_POST["username"];
        $passwd = $_POST["passwd"];
        $privilege = $_POST["privilege"];
        //Busca en la BD si existe o no el usuario
        if(isset($_POST["buttonregistrar"])){
            $db_consulting="SELECT*FROM login where username='$username'"; 
            $result = mysqli_query($conn, $db_consulting);
            $row = mysqli_num_rows($result);
            $view = mysqli_fetch_array($conn, $db_consulting);
            //REGISTRAR NUEVO USUARIO
            if($row==0){
                //Encriptación de la contraseña en BD
                $password_encrypted = password_hash($passwd, PASSWORD_BCRYPT);
                //Insertar datos del nuevo usuario a la BD
                $sql = "INSERT INTO login (username, passwd, id_privilege) VALUES ('$username', '$password_encrypted', '$privilege')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    //Usuario existente
                    echo "<script> alert('Usuario registrado: $username');window.location= 'user' </script>";
                }
                else 
                {
                    echo "Error: " .$sql."<br>".mysql_error($conn);
                }
            }
            
            //
            else{
                    echo "<script> alert('No puedes registrar a este usuario: $username');window.location= 'register_user' </script>";
            }
        }
        mysqli_close($conn);
    }
    ?>
</body>
</html>