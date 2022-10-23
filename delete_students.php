<?php
session_start();
require_once 'includes/auth_validate.php';
require_once 'config/connection.php';
$id_alumno = $_GET['id_alumno'];
$sql = "DELETE FROM alumno where id_alumno = '$id_alumno'"; 
$result = mysqli_query($conn, $sql);
if($result){
    $_SESSION['info'] = "Usuario eliminado con éxito!";
    header('location: student');
    exit;
}else{
    echo "Error: " .$sql."<br>".mysql_error($conn);
}
mysqli_close($conn);
?>