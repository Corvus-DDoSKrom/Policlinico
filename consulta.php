<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='DOCTOR'){
    header("location:error-403");
}
$id_patient1 = $_GET['id_patient'];
$db_consulting="SELECT*FROM patient WHERE id_patient = '$id_patient1'";
$result = mysqli_query($conn, $db_consulting);
$view = mysqli_fetch_array($result);
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
                        <h1>CONSULTA</h1>
                    </div>
                </div>
                <fieldset class="form-4">
                    <div class="form-left">
                        <div>
                            <h2>DATOS DEL PACIENTE</h2>
                            <label for="nombre">NOMBRE</label> <!--NOMBRE DEL PACIENTE-->
                            <br>
                            <input class="controls-2" type="text" name="name_patient" id="nombre" value="<?php echo $view['name_patient']; ?>" disabled=»disabled>
                        </div> <!--FIN DE NOMBRE PACIENTE-->
                        <div>
                            <label for="apellido">APELLIDO</label> <!--APELLIDO DEL PACIENTE-->
                            <br>
                            <input class="controls-2" type="text" name="surname_patient" id="apellido" value="<?php echo $view['surname_patient']; ?>" disabled=»disabled>
                        </div> <!--FIN APELLIDO DELM PACIENTE-->
                        <div>
                            <label for="cedula">CEDULA</label> <!--CEDULA DEL PACIENTE-->
                            <br>
                            <input class="controls-2" type="number" name="ci_patient" id="cedula" value="<?php echo $view['ci_patient']; ?>" disabled=»disabled>
                        </div> <!--FIN DE CEDULA PACIENTE-->
                        <div>
                            <label for="age">EDAD</label> <!--CEDULA DEL PACIENTE-->
                            <br>
                            <input class="controls-2" type="text" name="age" id="age" value="<?php echo $view['age']; ?>" disabled>
                        </div>
                        <div>
                            <label for="sex">SEXO</label> <!--CEDULA DEL PACIENTE-->
                            <br>
                            <input class="controls-2" type="text" style="text-transform:uppercase;" name="sex" id="sex" value="<?php echo $view['sex']; ?>" disabled>
                        </div>
                        <div>
                            <label for="motivo">MOTIVO DE CONSULTA</label> <!--TELEFONO DEL PACIENTE-->
                            <br>
                            <input class="controls-2" type="text" name="motivo_consulta" id="motivo">
                        </div> <!--FIN TELEFONO DEL PACIENTE-->
                        <div>
                            <label for="antecedentes">ANTECEDENTE DE ENFERMEDAD</label>
                            <br>
                            <input class="controls-2" type="text" name="antecedente_consulta" id="antecedente">
                        </div> <!--FIN ANTECEDENTE DE PACIENTE-->
                        <div>
                            <h2>EXÁMEN FÍSICO</h2>
                            <label for="peso">PESO</label>
                            <br>
                            <input class="controls-2" type="text" name="peso_consulta" id="peso">
                        </div> <!--FIN PESO DE PACIENTE-->
                        <div>
                            <label for="altura">ALTURA</label>
                            <br>
                            <input class="controls-2" type="text" name="altura_consulta" id="altura">
                        </div> <!--FIN ALTURA DE PACIENTE-->
                    </div>
                    <div class="form-right">
                        <div>
                            <h2>SIGNOS VITALES</h2>
                            <label for="presion">PRESIÓN ARTERIAL</label>
                            <br>
                            <input class="controls-2" type="text" name="presion_consulta" id="presion">
                        </div> <!--FIN PRESION DE PACIENTE-->
                        <div>
                            <label for="respiracion">RESPIRACIÓN</label>
                            <br>
                            <input class="controls-2" type="text" name="respiracion_consulta" id="respiracion">
                        </div> <!--FIN RESPIRACION DE PACIENTE-->
                        <div>
                            <label for="pulso">PULSO</label>
                            <br>
                            <input class="controls-2" type="text" name="pulso_consulta" id="pulso">
                        </div> <!--FIN PULSO DE PACIENTE-->
                        <div>
                            <label for="temperatura">TEMPERATURA</label>
                            <br>
                            <input class="controls-2" type="text" name="temperatura_consulta" id="temperatura">
                        </div> <!--FIN TEMPERATURA DE PACIENTE-->
                        <div>
                            <h2>MEDIDA AUXILIAR DE DIAGNOSTICO</h2>
                            <label for="auxiliar">DIAGNOSTICO AUXILIAR</label>
                            <br>
                            <input class="controls-2" type="text" name="auxiliar_consulta" id="auxiliar">
                        </div> <!--FIN AUXILIAR DE PACIENTE-->
                        <div>
                            <label for="impresion">IMPRESION DE DIAGNOSTICO</label>
                            <br>
                            <input class="controls-2" type="text" name="impresion_consulta" id="impresion">
                        </div> <!--FIN IMPRESION DE PACIENTE-->
                        <div>
                            <label for="tratamiento">TRATAMIENTO</label>
                            <br>
                            <input class="controls-2" type="text" name="tratamiento_consulta" id="tratamiento">
                        </div> <!--FIN TRATAMIENTO DE PACIENTE-->
                        <div>
                            <label for="cie10">CIE10</label>
                            <br>
                            <input class="controls-2" type="text" name="cei10_consulta" id="cie10">
                        </div> <!--FIN TRATAMIENTO DE PACIENTE-->
                        <div>
                            <label for="proxima">PROXIMA CONSULTA</label>
                            <br>
                            <input class="controls-2" type="text" name="proxima_consulta" id="proxima">
                        </div> <!--FIN PROXIMA CONSULTA DE PACIENTE-->
                    </div>
                </fielset>
            </div>
        </div>
    </div>
</body>
</html>