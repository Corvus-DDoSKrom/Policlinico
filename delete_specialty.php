<?php
session_start();
require_once 'includes/auth_validate.php';
require_once 'config/connection.php';
$id_specialty = $_GET['id_specialty'];
$sql = "DELETE FROM specialty where id_specialty = '$id_specialty'"; 
$result = mysqli_query($conn, $sql);
if($result){
    $_SESSION['info'] = "Especialidad eliminada con éxito!";
    header('location: specialty');
    exit;
}else{
    echo "Error: " .$sql."<br>".mysql_error($conn);
}
mysqli_close($conn);
?>