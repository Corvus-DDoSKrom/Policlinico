<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='RECEPCIONISTA'){
    header("location:error-403");
}
$id_patient = $_GET['id_patient'];
$db_consulting="SELECT*FROM patient Where id_patient = '$id_patient'";
$result = mysqli_query($conn, $db_consulting);
$view = mysqli_fetch_array($result);
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
    <title>EDITAR PACIENTE</title>
</head>
<body>
    <!-- MENU HORIZONTAL -->
    <div class="nav-bar">
        <a class="logo" href="panel_reception"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
                <a href="panel_reception"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                <a href="agenda"><i class="fa-solid fa-calendar-days"></i> Agenda</a>
                <a href="register_patient"><i class="fa-solid fa-person-half-dress"></i> Registrar Paciente</a>
                <a href="patient"><i class="fa-solid fa-person-half-dress"></i> Paciente</a>
                <a href="about.php"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
                <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a> <!--este apartado esta para cerrar la sesion de la cuenta ingresada -->
                <!--este apartado esta para abrir el menu de ayuda -->
        </nav>
    </div>
    <div class="all-1">
        <div class="form-5">
            <div class="form-2">
                <h1>EDITAR USUARIO</h1>
                <form method="post" action="edit_patient">
                    <fieldset class="form-4">
                        <div class="form-left">
                            <div>
                                <input type="hidden" name="id_patient" value="<?php echo $view['id_patient']; ?>">
                            </div>
                            <div>
                                <label for="nombre">NOMBRE</label>
                                <br>
                                <input class="controls-2" type="text" name="name_patient" id="nombre" value="<?php echo $view['name_patient']; ?>" required>
                            </div>
                            <div>
                                <label for="apellido">APELLIDO</label>
                                <br>
                                <input class="controls-2" type="text" name="surname_patient" id="apellido" value="<?php echo $view['surname_patient']; ?>">
                            </div>
                            <div>
                                <label for="cedula">CEDULA</label>
                                <br>
                                <input class="controls-2" type="number" name="ci_patient" id="cedula" value="<?php echo $view['ci_patient']; ?>">
                            </div>
                            <div>
                                <label for="telefono">TELEFONO</label>
                                <br>
                                <input class="controls-2" type="text" name="phone_patient" id="telefono" value="<?php echo $view['phone_patient']; ?>">
                            </div>
                            <div>
                                <label for="sexo">SEXO</label>
                                <br>
                                <label><input type=radio name="sex" value="masculido" checked> Masculino</label>
                                <label><input type=radio name="sex" value="femenino"> Femenino</label>
                            </div>
                        </div>
                        <div class="form-right">
                            <div>
                                <label for="fechanacimiento">FECHA DE NACIMIENTO</label>
                                <br>
                                <input class="controls-2" type="date" name="date_of_birth" id="fechanacimiento" value="<?php echo $view['date_of_bith']; ?>">
                            </div>
                            <div>
                                <label for="nacionalidad">NACIONALIDAD</label>
                                <br>
                                <input class="controls-2" type="text" name="nationality" id="nacionalidad" value="<?php echo $view['nationality']; ?>">
                            </div>
                            <div>
                                <label for="residencia">CIUDAD DE RESIDENCIA</label>
                                <br>
                                <input class="controls-2" type="text" name="residence" id="residencia" value="<?php echo $view['residence']; ?>">
                            </div>
                            <div>
                                <label for="estadocivil">ESTADO CIVIL</label>
                                <br>
                                <select class="controls-2" name="marital_status" id="estadocivil">
                                    <option value="soltero">Soltero/a</option>
                                    <option value="divorciado">Divorciado/a</option>
                                    <option value="casado">Casado/a</option>
                                    <option value="viudo">Viudo/a</option>
                                </select>
                            </div>
                            <div>
                                <label for="edad">EDAD</label>
                                <br>
                                <input class="controls-2" type="number" name="age" id="edad" value="<?php echo $view['age']; ?>">
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <button class="myButton" type="submit" name="buttonguardar">GUARDAR</button>
                    <button class="myButton" type="reset">CANCELAR</button>
                </form>
            </div>
        </div>
    </div>
    <!--Inicio del codigo para registrar alumnos -->
    <?php
    require 'config/connection.php';
    /* Aqui comienza la validacion de datos */
    if(isset($_POST['name_patient'])){
        $id_patient = $_POST["id_patient"];
        $name_patient = $_POST["name_patient"];
        $surname_patient = $_POST["surname_patient"];
        $ci_patient = $_POST["ci_patient"];
        $phone_patient = $_POST["phone_patient"];
        $date_of_birth = $_POST["date_of_birth"];
        $nationality = $_POST["nationality"];
        $residence = $_POST["residence"];
        $marital_status = $_POST["marital_status"];
        $age = $_POST["age"];
        $sex = $_POST["sex"];
    /*Fin de la validacion de datos*/
        if(isset($_POST["buttonguardar"])){             /*Modificar los datos*/
            $db_updating = "UPDATE patient SET name_patient='$name_patient', surname_patient='$surname_patient', ci_patient='$ci_patient', phone_patient='$phone_patient', date_of_birth='$date_of_birth', nationality='$nationality', residence='$residence', marital_status='$marital_status', age='$age', sex='$sex' WHERE id_patient=$id_patient";
            $result = mysqli_query($conn, $db_updating);
            if($result){                                /*Mensaje de modificado exitoso*/
                echo "<script> alert('Doctor/a modificado: $nombre $apellido');window.location= 'student' </script>";
            }
            else{                                       /*Mensaje de error*/
                echo "Error: " .$sql."<br>".mysql_error($conn);
            }
        }
    }/*Fin de validacion de datos*/
        mysqli_close($conn);
    ?>
</body>
</html>