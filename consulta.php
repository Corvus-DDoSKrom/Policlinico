<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='DOCTOR'){
    header("location:error-403");
}
$id_evento = $_GET['txtID'];
$db_consulting2="SELECT*FROM eventos WHERE id = '$id_evento'";
$result3 = mysqli_query($conn, $db_consulting2);
$view2 = mysqli_fetch_array($result3);
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
    <title>CONSULTA</title>
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
            <a href="panel_doctor"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
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
                <form method="POST" action="consulta.php">
                    <fieldset class="form-4">
                        <div class="form-left">
                            <input type="hidden" id="txtID" name="id" value="<?php echo $view2['id']; ?>">
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
                                <input class="controls-2" type="text" name="motivo_consulta">
                            </div> <!--FIN TELEFONO DEL PACIENTE-->
                            <div>
                                <label for="antecedentes">ANTECEDENTE DE ENFERMEDAD</label>
                                <br>
                                <input class="controls-2" type="text" name="antecedente_consulta">
                            </div> <!--FIN ANTECEDENTE DE PACIENTE-->
                            <div>
                                <label for="diagnostico">DIAGNOSTICO</label>
                                <br>
                                <input class="controls-2" type="text" name="diagnostico">
                            </div> <!--FIN ANTECEDENTE DE PACIENTE-->
                            <div>
                                <h2>EXÁMEN FÍSICO</h2>
                                <label for="peso">PESO</label>
                                <br>
                                <input class="controls-2" type="text" name="peso_consulta">
                            </div> <!--FIN PESO DE PACIENTE-->
                            <div>
                                <label for="altura">ALTURA</label>
                                <br>
                                <input class="controls-2" type="text" name="altura_consulta">
                            </div> <!--FIN ALTURA DE PACIENTE-->
                        </div>
                        <div class="form-right">
                            <div>
                                <h2>SIGNOS VITALES</h2>
                                <label for="presion">PRESIÓN ARTERIAL</label>
                                <br>
                                <input class="controls-2" type="text" name="presion_consulta">
                            </div> <!--FIN PRESION DE PACIENTE-->
                            <div>
                                <label for="respiracion">RESPIRACIÓN</label>
                                <br>
                                <input class="controls-2" type="text" name="respiracion_consulta">
                            </div> <!--FIN RESPIRACION DE PACIENTE-->
                            <div>
                                <label for="pulso">PULSO</label>
                                <br>
                                <input class="controls-2" type="text" name="pulso_consulta">
                            </div> <!--FIN PULSO DE PACIENTE-->
                            <div>
                                <label for="temperatura">TEMPERATURA</label>
                                <br>
                                <input class="controls-2" type="text" name="temperatura_consulta">
                            </div> <!--FIN TEMPERATURA DE PACIENTE-->
                            <div>
                                <h2>MEDIDA AUXILIAR DE DIAGNOSTICO</h2>
                                <label for="auxiliar">DIAGNOSTICO AUXILIAR</label>
                                <br>
                                <input class="controls-2" type="text" name="auxiliar_consulta">
                            </div> <!--FIN AUXILIAR DE PACIENTE-->
                            <div>
                                <label for="impresion">IMPRESION DE DIAGNOSTICO</label>
                                <br>
                                <input class="controls-2" type="text" name="impresion_consulta">
                            </div> <!--FIN IMPRESION DE PACIENTE-->
                            <div>
                                <label for="tratamiento">TRATAMIENTO</label>
                                <br>
                                <input class="controls-2" type="text" name="tratamiento_consulta">
                            </div> <!--FIN TRATAMIENTO DE PACIENTE-->
                            <div>
                                <label for="cie10">CIE10</label>
                                <br>
                                <input class="controls-2" type="text" name="cie10_consulta">
                            </div> <!--FIN TRATAMIENTO DE PACIENTE-->
                            <div>
                                <label for="proxima">PROXIMA CONSULTA</label>
                                <br>
                                <input class="controls-2" type="text" name="proxima_consulta">
                            </div> <!--FIN PROXIMA CONSULTA DE PACIENTE-->
                        </div>
                    </fielset>
                    <br>
                    <button class="myButton" type="submit" name="buttonguardar">Guardar</button><!--este apartado esta para guardar los cambios realizados en la casillas anteriores -->
                    <button class="myButton" type="reset">Cancelar</button><!--este apartado esta para cancelar los cambios realizados en la casillas anteriores -->
                </form>
            </div>
        </div>
    </div>
    <?php
    require 'config/connection.php';
    /* Aqui comienza la validacion de datos */
    // Obteniendo la fecha actual del sistema con PHP
    if(isset($_POST['buttonguardar'])){
        $fecha = date('d-m-Y');
        $id = $_POST["id"];
        $motivo = $_POST["motivo_consulta"];
        $antecedente = $_POST["antecedente_consulta"];
        $diagnostico = $_POST["diagnostico"];
        $peso = $_POST["peso_consulta"];
        $altura = $_POST["altura_consulta"];
        $presion = $_POST["presion_consulta"];
        $respiracion = $_POST["respiracion_consulta"];
        $pulso = $_POST["pulso_consulta"];
        $temperatura = $_POST["temperatura_consulta"];
        $auxiliar = $_POST["auxiliar_consulta"];
        $impresion = $_POST["impresion_consulta"];
        $tratamiento = $_POST["tratamiento_consulta"];
        $cie10 = $_POST["cie10_consulta"];
        $proxima = $_POST["proxima_consulta"];
        /*Fin de la validacion de datos*/
        $sql = "INSERT INTO detalle_consulta (motivo_consulta, antecedente_consulta, diagnostico, peso_consulta, fecha, altura_consulta, presion_consulta, respiracion_consulta, pulso_consulta, temperatura_consulta, auxiliar_consulta, impresion_consulta, tratamiento_consulta, cie10_consulta, proxima_consulta) VALUES ('$motivo', '$antecedente', '$diagnostico', '$peso', '$fecha', '$altura', '$presion', '$respiracion', '$pulso', '$temperatura', '$auxiliar', '$impresion', '$tratamiento', '$cie10', '$proxima')";
        $result2 = mysqli_query($conn, $sql);
        $db_update = "UPDATE eventos SET estado='0' WHERE id = '$id'";
        $update = mysqli_query($conn, $db_update);
        if($result2){/*si todo esta correcto procede a guardar en la base de datos*/
            echo "<script> alert('Consulta guardado con éxito.');window.location= 'panel_doctor' </script>";
        }else {
                    echo "Error: " .$sql."<br>".mysql_error($conn);/*si no, se imprime en pantalla el mensaje de error*/
        }   
    }
        mysqli_close($conn);
    ?>
</body>
</html>