<!-- Iniciar sesion -->
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
    <link rel="shortcut icon" href="assets/img/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400&display=swap');
    </style>
    <Title>Especializaciones</Title>
</head>
<body>

    <!-- MENU HORIZONTAL -->
    <div class="nav-bar">
        <a class="logo" href="admin_panel"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
            <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a> <!--este apartado esta para cerrar la sesion de la cuenta ingresada -->
        </nav>
    </div>
    <div class="all-1">
        <!-- MENU VERTICAL -->
        <div class="menu">
            <nav class="menuvertical-1">
                <a href="admin_panel"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                <a href="doctor"><i class="fa-solid fa-user-doctor"></i> Doctor</a>
                <a href="student"><i class="fa-solid fa-graduation-cap"></i> Alumnos</a>
                <a href="specialty"><i class="fa-solid fa-stethoscope"></i> Especialidad</a>
                <a href="user"><i class="fa-solid fa-user"></i> Usuario</a> 
                <a href="about.html"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
            </nav>
        </div>

        <!-- Empieza: REGISTRAR ESPECIALIDADES -->
        <div class="form-5">
            <div class="form-2">
                <h1>ESPECIALIDAD</h1>
                <form method="post" action="register_specialty">
                    <fieldset class="fomr-4">
                        <div class="form-left">
                            <div>
                                <label>Nombre de Especialidad</label>
                                <br>
                                <input class="controls-2" type="text" style="text-transform:uppercase;" name="title" id="title"/>
                            </div>
                        </div> 
                    </fieldset>
                    <br>
                    <button class="myButton" type="submit" name="buttonregistrar">Guardar</button>
                    <button class="myButton" type="reset">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
    <?php
        require 'config/connection.php';
        if(isset($_POST['title'])){
            $title = $_POST["title"]; 
            if(isset($_POST["buttonregistrar"])){   //Busca en la base de datos
                $db_consulting="SELECT*FROM specialty where title='$title'"; 
                $result = mysqli_query($conn, $db_consulting);
                $row = mysqli_num_rows($result);
                $view = mysqli_fetch_array($conn, $db_consulting);
                if($row==0){                        //Crea en la base de datos
                    $sql = "INSERT INTO specialty (title) VALUES ('$title')";
                    $result = mysqli_query($conn, $sql);
                    if($result){                    //Mensaje de éxito
                        echo "<script> alert('Especialidad registrada: $title');window.location= 'specialty' </script>";
                    }
                    else                            //Mensaje error
                    {
                        echo "Error: " .$sql."<br>".mysql_error($conn);
                    }
                }        
            }
            else{                                   //Mensaje no se puede crear
                    echo "<script> alert('No puedes registrar esta especialidad: $title');window.location= 'register_specialty' </script>";
            }
            mysqli_close($conn);
        }    
    ?>
</body>
</html>