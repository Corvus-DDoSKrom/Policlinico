<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='ADMINISTRADOR'){
    header("location:error-403");
}
$id_user = $_GET['id_user'];
$db_consulting="SELECT*FROM login WHERE id_user = '$id_user'";
$result = mysqli_query($conn, $db_consulting);
$view = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR USUARIO</title>
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
                 <a href="panel_admin"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                <!--este apartado esta para abrir los usuarios registrados -->
                <a href="doctor"><i class="fa-solid fa-user-doctor"></i> Doctor</a>
                <!--este apartado esta para abrir los profesionales encargados -->

                <!-- <a href="student"><i class="fa-solid fa-graduation-cap"></i> Alumnos</a> -->
               
                <!--este apartado esta para abrir los alumnos registrados -->
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
        <!--Este es el inicio del area central -->
        <div class="form-5">
            <div class="form-2">
                <h1>MODIFICAR USUARIO</h1>
                <form method="post" action="edit_user">
                    <fieldset class="form-4">
                        <div class="form-left">
                            <div>
                                <input type="hidden" class="controls-2" style="text-transform:uppercase;" name="id_username" id="id_usuario" value="<?php echo $_GET['id_user']; ?>" readonly></br> <!--este apartado esta para registrar el id del usuario -->
                            <div>
                                <label for="name-user">NOMBRE DE USUARIO</label>
                                </br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="username" id="usuario" value="<?php echo $view['username']; ?>"></br> <!--este apartado esta para registrar el nombre del usuario -->
                            </div>
                            <div>
                                <label for="user-pass">CONTRASEÑA</label><!--este apartado esta para registrar la contraseña del usuario -->
                                </br>
                                <input class="controls-2" type="password" name="passwd" id="passwd">
                                </br>
                            </div>
                            <!--este apartado esta para el chek in de mostrar o no la contraseña -->
                            <div class="check-div">
                                <input class="check-1" type="checkbox" onclick="view_password()" >Mostrar contraseña 
                                </br>
                            </div>
                            <!--Fin del chek in de mostrar contraseña -->

                            <!--Inicio de modificar los privilegios del usuario -->
                            <div>
                                <label for="privilegios">PRIVILEGIO</label>
                                </br>
                                <select class="controls-2" name="privilege" id="tipo_usuario">Privilegio 
                                    <option value="1">ADMINISTRADOR</option>
                                    <option value="2">DOCENTE</option>
                                    <option value="3">ALUMNO</option>
                                    <option value="4">RECEPCIONISTA</option>
                                </select>
                            </div>
                            <!--Fin de modificar los privilegios -->
                        </div>
                    </fieldset>
                    </br>
                    <button class="myButton" type="submit" name="buttonguardar">GUARDAR</button><!--este apartado esta para guardar los cambios registrados-->
                </form>
            </div>
        </div>
        <!--Fin del area central -->
    </div>
    <!--Funcion en JS para mostrar contraseña -->
    <script>
        function view_password(){
            var tipo = document.getElementById("passwd");
            if(tipo.type == "password")
            {
                tipo.type = "text";
            }
            else
            {
                tipo.type = "password";
            }
        }
	</script>
    <!--Fin de la funcion de JS para mostrar contraseña -->
</body>
</html>
<!--Inicio del codigo de modificar los datos del usuario -->
<?php
    if(isset($_POST['username'])){
        /*Validacion de datos*/
        $id_username = $_POST["id_username"];
        $username = $_POST["username"];
        $passwd = $_POST["passwd"];
        $privilege = $_POST["privilege"];
        /*Fin de validacion de datos*/
        /* Este apartado guarda la modificacion realizada*/
        if(isset($_POST["buttonguardar"])){
            $password_encrypted = password_hash($passwd, PASSWORD_BCRYPT);
            $db_updating = "UPDATE login SET username='$username', passwd='$password_encrypted', id_privilege='$privilege' WHERE id_user=$id_username";
            $result = mysqli_query($conn, $db_updating);
            if($result){
                echo "<script> alert('Usuario modificado: $username');window.location= 'user' </script>";
            }
            else /*en caso de algun error se mostrara en pantalla el siguiente mensaje: error*/
            {
                echo "Error: " .$sql."<br>".mysql_error($conn);
            }
        }
        mysqli_close($conn); 
        /* Fin del apartado de guardar la modificacion*/
    } 
/* Fin del codigo de modificar los datos del usuario*/
?>