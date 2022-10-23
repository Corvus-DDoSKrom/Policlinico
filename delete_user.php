<?php
session_start();
require_once 'includes/auth_validate.php';
require_once 'config/connection.php';
$id_user = $_GET['id_user'];
$sql = "DELETE FROM login where id_user = '$id_user'"; 
$result = mysqli_query($conn, $sql);
if($result){
    $_SESSION['info'] = "Usuario eliminado con éxito!";
    header('location: user');
    exit;
}else{
    echo "Error: " .$sql."<br>".mysql_error($conn);
}
mysqli_close($conn);
?>