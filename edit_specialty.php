<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='ADMINISTRADOR'){
    header("location:error-403");
}
$id_specialty = $_GET['id_specialty'];
$db_consulting="SELECT*FROM specialty Where id_specialty = '$id_specialty'";
$result = mysqli_query($conn, $db_consulting);
$view = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR ESPECIALIDAD</title>
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
                <a href="register_doctor"><i class="fa-solid fa-user-doctor"></i> Doctor</a>
                <!--este apartado esta para abrir los profesionales encargados -->

                <!-- <a href="student"><i class="fa-solid fa-graduation-cap"></i> Alumnos</a> -->

                <!--este apartado esta para abrir los usuarios registrados -->
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
        <!--el apartado se centra enteramente en la parte editable de las especialidades-->
        <div class="form-5">
            <div class="form-2">
                <h1>EDITAR ESPECIALIDAD</h1>
                <form method="post" action="edit_specialty">
                    <fieldset class="fomr-4">
                        <div class="form-left">
                            <div>
                                <input type="hidden" class="controls-2" style="text-transform:uppercase;" name="id_specialty" id="id_specialty" value="<?php echo $_GET['id_specialty']; ?>" readonly></br>
                            </div>
                            <div>
                                <label>Nombre de Especialidad</label>
                                <br>
                                <!--este apartado esta para poner el nombre de la especialidad -->
                                <input class="controls-2" type="text" name="specialty" id="specialty" value="<?php echo $view['title']; ?>"/>
                            </div>
                        </div> 
                    </fieldset>
                    <br>
                    <button class="myButton" type="submit" name="buttonguardar">Guardar</button>
                    <button class="myButton" type="reset">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<!--este apartado esta para salvar los apartados registrados en correlacion de la especialidad con los correspondientes botones designados-->
<?php
    if(isset($_POST['specialty'])){
        $id_specialty = $_POST["id_specialty"];
        $specialty = $_POST["specialty"];
        if(isset($_POST["buttonguardar"])){
            $db_updating = "UPDATE specialty SET specialty='$specialty' WHERE id_specialty=$id_specialty";
            $result = mysqli_query($conn, $db_updating);
            /*este apartado esta centrado en que si la especialidad es modificada pueda ser guardada, en caso contrario marcar el error correspondiente*/
            if($result){
                echo "<script> alert('Especialidad modificada: $specialty');window.location= 'specialty' </script>";
            }
            else 
            {
                echo "Error: " .$sql."<br>".mysql_error($conn);
            }
        }
        mysqli_close($conn);
    }
?>