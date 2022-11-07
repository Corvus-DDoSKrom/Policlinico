<?php
    session_start();
    require 'includes/auth_validate.php';
    header('Content-Type: application/json');
    $pdo=new PDO("mysql:dbname=policlinico;host=localhost","root","");
    $accion= (isset($_GET['accion']))?$_GET['accion']:'leer';
    $id_user2 = $_SESSION['id_doctor'];
    switch($accion){
        case 'agregar':
            //AGREGAR
            $sentenciaSQL = $pdo->prepare("INSERT INTO 
            eventos(id_patient,companion,color,textColor,start,end,id_doctor,id_specialty)
            VALUES(:id_patient,:companion,:color,:textColor,:start,:end,:id_doctor,:id_specialty)");
            
            $respuesta = $sentenciaSQL->execute(array(
                "id_patient" => $_POST['id_patient'],
                "companion" => $_POST['companion'],
                "color" => $_POST['color'],
                "textColor" => $_POST['textColor'],
                "start" => $_POST['start'],
                "end" => $_POST['end'],
                "id_doctor" => $_POST['id_doctor'],
                "id_specialty" => $_POST['id_specialty']
            ));
            echo json_encode($respuesta);
        break;
        default:
            //Seleccionar los eventos del calendario
            $sentenciaSQL= $pdo->prepare("SELECT*FROM eventos INNER JOIN specialty ON eventos.id_specialty = specialty.id_specialty WHERE id_doctor='$id_user2' AND estado='1'");
            $sentenciaSQL->execute();
            $resultado= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
        break;    
    }
?>