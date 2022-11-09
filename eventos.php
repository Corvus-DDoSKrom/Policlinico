<?php
    header('Content-Type: application/json');
    $pdo=new PDO("mysql:dbname=policlinico;host=localhost","root","");
    $accion= (isset($_GET['accion']))?$_GET['accion']:'leer';
    switch($accion){
        case 'agregar':
            //AGREGAR
            $sentenciaSQL = $pdo->prepare("INSERT INTO 
            eventos(id_patient,companion,color,textColor,start,end,id_doctor,id_specialty,estado)
            VALUES(:id_patient,:companion,:color,:textColor,:start,:end,:id_doctor,:id_specialty,:estado)");
            
            $respuesta = $sentenciaSQL->execute(array(
                "id_patient" => $_POST['id_patient'],
                "companion" => $_POST['companion'],
                "color" => $_POST['color'],
                "textColor" => $_POST['textColor'],
                "start" => $_POST['start'],
                "end" => $_POST['end'],
                "id_doctor" => $_POST['id_doctor'],
                "id_specialty" => $_POST['id_specialty'],
                "estado" => $_POST['estado']
            ));
            echo json_encode($respuesta);
        break;
        case 'modificar':
            //Instruccion modificar
    
            $sentenciaSQL=$pdo->prepare("UPDATE eventos SET 
            id_patient=:id_patient,
            companion=:companion,
            color=:color,
            textColor=:textColor,
            start=:start,
            end=:end,
            id_doctor=:id_doctor,
            id_specialty=:id_specialty
            estado=:estado
            WHERE ID=:ID
            ");

            $respuesta = $sentenciaSQL->execute(array(
                "ID" => $_POST['id'],
                "id_patient" => $_POST['id_patient'],
                "companion" => $_POST['companion'],
                "color" => $_POST['color'],
                "textColor" => $_POST['textColor'],
                "start" => $_POST['start'],
                "end" => $_POST['end'],
                "id_doctor" => $_POST['id_doctor'],
                "id_specialty" => $_POST['id_specialty'],
                "estado" => $_POST['estado']
            ));
    
            echo json_encode($respuesta);
        break;
        case 'eliminar':
            $respuesta=false;
    
            if(isset($_POST['id'])){
    
                $sentenciaSQL=$pdo->prepare("DELETE FROM eventos WHERE ID=:ID");
                $respuesta= $sentenciaSQL->execute(array("ID"=>$_POST['id']));
    
            }
            echo json_encode($respuesta);
        break;
        default:
            //Seleccionar los eventos del calendario
            $sentenciaSQL= $pdo->prepare("SELECT*FROM eventos INNER JOIN specialty ON eventos.id_specialty = specialty.id_specialty");
            $sentenciaSQL->execute();
            $resultado= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
        break;    
    }
?>