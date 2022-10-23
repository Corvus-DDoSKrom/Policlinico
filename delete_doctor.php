<?php
session_start();
require_once 'includes/auth_validate.php';
require_once 'config/connection.php';
$id_doctor = $_GET['id_doctor'];
$sql = "DELETE FROM doctor where id_doctor = '$id_doctor'"; 
$result = mysqli_query($conn, $sql);
if($result){
    $_SESSION['info'] = "Doctor/a eliminada con éxito!";
    header('location: doctor');
    exit;
}else{
    echo "Error: " .$sql."<br>".mysql_error($conn);
}
mysqli_close($conn);
?>