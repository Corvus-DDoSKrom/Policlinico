<?php
require_once './config/connection.php';
session_start(); 
/*Esta parte recibe los datos del index*/
$username = $_POST["username"];
$passwd = $_POST["passwd"];
/*Fin del dato de recepcion de dato*/
if(isset($_POST["buttonlogin"])){
    $db_consulting="SELECT*FROM login where username='$username'"; /*este apartado verifica si el usuario y contraseña existe*/
    $result = mysqli_query($conn, $db_consulting);
    $row = mysqli_num_rows($result);
    $view = mysqli_fetch_array($result);
    if($row && password_verify($passwd,$view['passwd'])){ /*Verifica si el usuario y contraseña son correctos*/
        /* Inicio de verificacion de privilegios */
        if($row && $view["privilege"]){
            $privilege = $view["privilege"]; /* esta apartado registra si el usuario es administrador*/
            if($privilege==1){
                header("location:admin_panel");
                $_SESSION['user_logged_in'] = TRUE;
                $_SESSION['privilege'] = 'ADMINISTRADOR';
            }
            elseif($privilege==2){ /*este apartado registra si el usuario es docente*/
                header("location:doctor_panel");
                $_SESSION['user_logged_in'] = TRUE;
                $_SESSION['privilege'] = 'DOCENTE';
            }
            elseif($privilege==3){ /*este apartado registra si el usuario es alumno*/
                header("location:alumno_panel");
                $_SESSION['user_logged_in'] = TRUE;
                $_SESSION['privilege'] = 'ALUMNO';
            }elseif($privilege==4){ /*este apartado registra si el usuario es recepcionista*/
                header("location:reception_panel");
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