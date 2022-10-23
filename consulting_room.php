<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='RECEPCIONISTA'){
    header("location:error-403");
}
$db_consulting="SELECT*FROM doctor";
$result = mysqli_query($conn, $db_consulting);
$db_consulting_2="SELECT*FROM specialty";
$result_2 = mysqli_query($conn, $db_consulting_2);
mysqli_close($conn);
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
    <title>CONSULTORIO</title>
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
        <div class="menu">
            <nav class="menuvertical-1">
                <a href="reception_panel"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                <a href="agenda"><i class="fa-solid fa-calendar-days"></i> Agenda</a> 
                <a href="consulting_room"><i class="fa-solid fa-hospital"></i> Consultorio</a> 
                <a href="about.php"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
                <!--este apartado esta para abrir el menu de ayuda -->
            </nav>
        </div>
        <!-- Empieza area: CREAR CONSULTORIO -->
        <div class="form-5">
            <div class="form-2">
                <h1>AGREGAR CONSULTORIO</h1>
                <form method="POST" action="shedule.php">
                    <fieldset class="form-4">
                        <div class="form-left">
                            <div>
                                <label for="numcomsultorio">NÚMERO DE CONSULTORIO</label>
                                <br>
                                <input class="controls-2" type="text"  name="username" id="username" required>
                            </div>
                            <div>
                                <label for="doctor">Doctor</label>
                                </br>
                                <select class="controls-2" style="text-transform:uppercase;" name="doctor" id="id_doctor">Doctor
                                <?php
                                while ($row = mysqli_fetch_array($result)){
                                    $id_doctor = $row['id_doctor'];
                                    $name_doctor = $row['name_doctor'];
                                    $surname_doctor = $row['surname_doctor'];
                                ?>
                                    <option value="<?php echo $id_doctor; ?>"><?php echo("$name_doctor $surname_doctor"); ?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div>
                                <label for="specialty">ESPECIALIDAD</label>
                                </br>
                                <select class="controls-2" name="specialty" id="specialty">ESPECIALIDAD
                                <?php
                                while ($row = mysqli_fetch_array($result_2)){
                                    $id_specialty = $row['id_specialty'];
                                    $specialty = $row['specialty'];
                                ?>
                                    <option value="<?php echo $id_specialty; ?>"><?php echo $specialty; ?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div>
                                <label for="fecha">FECHA</label>
                                <br>
                                <input class="controls-2" type="text" name="date_start" id="fecha">
                            </div>
                            <div>
                                <label for="hora">HORA</label>
                                <br>
                                <input class="controls-2" type="time" name="hora" id="hora">
                            </div>
                        </div>      
                    </fieldset>
                    <br>
                    <div>
                        <button class="myButton" type="submit" name="agendar">Agregar consultorio</button>
                        <button class="myButton" type="reset">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>