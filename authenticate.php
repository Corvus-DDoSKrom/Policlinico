<?php
require_once './config/connection.php';
session_start(); 
/*Esta parte recibe los datos del index*/
$username = $_GET['username'];
$passwd = $_GET['passwd'];
/*Fin del dato de recepcion de dato*/
if(isset($_GET["buttonlogin"])){
    $db_consulting="SELECT*FROM login WHERE username='$username'"; /*este apartado verifica si el usuario y contraseña existe*/
    $result = mysqli_query($conn, $db_consulting);
    $row = mysqli_num_rows($result);
    $view = mysqli_fetch_array($result);
    $db_doctor="SELECT*FROM doctor INNER JOIN login ON doctor.id_user = login.id_user WHERE username='$username'";
    $result_doctor=mysqli_query($conn, $db_doctor);
    $row_doctor = mysqli_num_rows($result_doctor);
    $view_doctor=mysqli_fetch_array($result_doctor);
    if($row && password_verify($passwd,$view['passwd'])){ /*Verifica si el usuario y contraseña son correctos*/
        /* Inicio de verificacion de privilegios */
        if($row && $view["id_privilege"]){
            $privilege = $view["id_privilege"]; /* esta apartado registra si el usuario es administrador*/
            if($privilege==1){
                header("location:panel_admin");
                $_SESSION['user_logged_in'] = TRUE;
                $_SESSION['privilege'] = 'ADMINISTRADOR';
            }
            elseif($privilege==2){ /*este apartado registra si el usuario es docente*/
                if($row_doctor && $view_doctor['id_user']){
                    header("location:panel_doctor");
                    $_SESSION['user_logged_in'] = TRUE;
                    $_SESSION['privilege'] = 'DOCTOR';
                    $_SESSION['id_doctor'] = $view_doctor['id_doctor'];
                }
            }
            elseif($privilege==3){ /*este apartado registra si el usuario es alumno*/
                header("location:alumno_panel");
                $_SESSION['user_logged_in'] = TRUE;
                $_SESSION['privilege'] = 'ALUMNO';
            }elseif($privilege==4){ /*este apartado registra si el usuario es recepcionista*/
                header("location:panel_reception");
                $_SESSION['user_logged_in'] = TRUE;
                $_SESSION['privilege'] = 'RECEPCIONISTA';
            }
        } /* Fin de verificacion de privilegios */
    }else{ /* En caso de que la contraseña sea incorrecta mostrara en pantalla el siguiente mensaje:Usuario y/o contraseña incorrecta */
        echo "<script> alert('Usuario y/o contraseña incorrecta');
        location.href = 'login';
                    </script>";
    }
    mysqli_free_result($result);
} /* Fin de la validacion de inicio de sesion*/
mysqli_close($conn);
?>