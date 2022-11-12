<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='DOCTOR'){
    header("location:error-403");
}
$id_consulta = $_GET['id_consulta'];
$db_consulting="SELECT*FROM consulta INNER JOIN patient ON consulta.id_patient = patient.id_patient INNER JOIN detalle_consulta ON consulta.id_detalle_consulta = detalle_consulta.id_detalle_consulta INNER JOIN doctor ON consulta.id_doctor = doctor.id_doctor INNER JOIN specialty ON consulta.id_specialty = specialty.id_specialty WHERE id_consulta = '$id_consulta'";
$result = mysqli_query($conn, $db_consulting);
$view = mysqli_fetch_array($result);
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HISTORIAL</title>
    <link rel="shortcut icon" href="assets/img/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="http://localhost/policlinico/assets/css/report.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400&display=swap');
    </style>
</head>
<body>
    <p class="titulo">HISTORIAL</p>
    <p class="tam-label-p">Fecha de consulta: <?php echo $view['fecha']; ?></p>
    <p class="tam-label-p">Especialidad: <?php echo $view['title']; ?></p>
    <fieldset class="form-9">
        <div>
            <h2>DATOS DEL PACIENTE</h2>
        </div>
        <div>
            <label class="tam-label" for="nombre">NOMBRE</label>
            <br>
            <input class="controls-9" type="text" name="name_patient" id="nombre" value="<?php echo $view['name_patient']; ?>">
        </div>
        <div>
            <label class="tam-label" for="apellido">APELLIDO</label>
            <br>
            <input class="controls-9" type="text" name="surname_patient" id="apellido" value="<?php echo $view['surname_patient']; ?>">
        </div>
        <div>
            <label class="tam-label" for="cedula">CEDULA</label>
            <br>
            <input class="controls-9" type="text" name="ci_patient" id="cedula" value="<?php echo $view['ci_patient']; ?>">
        </div>
        <div>
            <label class="tam-label" for="age">EDAD</label>
            <br>
            <input class="controls-9" type="text" name="age" id="age" value="<?php echo $view['age']; ?>">
        </div>
        <div>
            <label class="tam-label" for="sex">SEXO</label>
            <br>
            <input class="controls-9" type="text" style="text-transform:uppercase;" name="sex" id="sex" value="<?php echo $view['sex']; ?>">
        </div>
        </fieldset>
        <fieldset class="form-9">
        <div>
            <div>
                <h2>EXÁMEN FÍSICO - SIGNOS VITALES</h2>
            </div>
        </div>
        <div>
            <label class="tam-label" for="peso">PESO</label>
            <br>
            <input class="controls-9" type="text" name="peso_consulta" value="<?php echo $view['peso_consulta']; ?>">
        </div>
        <div>
            <label class="tam-label" for="altura">ALTURA</label>
            <br>
            <input class="controls-9" type="text" name="altura_consulta" value="<?php echo $view['altura_consulta']; ?>">
        </div>
        <div>
            <label class="tam-label" for="presion">PRESIÓN A.</label>
            <br>
            <input class="controls-9" type="text" name="presion_consulta" value="<?php echo $view['presion_consulta']; ?>">
        </div>
        <div>
            <label class="tam-label" for="respiracion">RESPIRACIÓN</label>
            <br>
            <input class="controls-9" type="text" name="respiracion_consulta" value="<?php echo $view['respiracion_consulta']; ?>">
        </div>
        <div>
            <label class="tam-label" for="pulso">FREC. C.</label>
            <br>
            <input class="controls-9" type="text" name="pulso_consulta" value="<?php echo $view['pulso_consulta']; ?>">
        </div>
        <div>
            <label class="tam-label" for="temperatura">TEMPERATURA</label>
            <br>
            <input class="controls-9" type="text" name="temperatura_consulta" value="<?php echo $view['temperatura_consulta']; ?>">
        </div>
    </fieldset>
    <fieldset class="form-9">
        <div>
            <h2>HISTORIAL DEL PACIENTE</h2>
            <label class="tam-label" for="motivo">MOTIVO DE CONSULTA</label>
            <br>
            <textarea rows="4" class="controls-11" style="resize: none;" name="motivo_consulta"><?php echo $view['motivo_consulta']; ?></textarea>
        </div>
        <div>
            <label class="tam-label" for="antecedentes">ANTECEDENTE DE ENFERMEDAD ACTUAL</label>
            <br>
            <textarea rows="4" class="controls-11" style="resize: none;" name="antecedente_consulta"><?php echo $view['antecedente_consulta']; ?></textarea>
        </div>
        <div>
            <label class="tam-label" for="diagnostico">DIAGNOSTICO</label>
            <br>
            <textarea rows="4" class="controls-11" style="resize: none;" name="diagnostico"><?php echo $view['diagnostico']; ?></textarea>
        </div>
        </fieldset>
        <fieldset class="form-9">
        <div>
            <h2>MEDIO AUXILIAR DE DIAGNOSTICO</h2>
            <label class="tam-label" for="auxiliar">DIAGNOSTICO AUXILIAR</label>
            <br>
            <textarea rows="4" class="controls-11" style="resize: none;" name="auxiliar_consulta"><?php echo $view['auxiliar_consulta']; ?></textarea>
        </div>
        <div>
            <label class="tam-label" for="impresion">IMPRESION DE DIAGNOSTICO</label>
            <br>
            <textarea rows="4" class="controls-11" style="resize: none;" name="impresion_consulta"><?php echo $view['impresion_consulta']; ?></textarea>
        </div>
        <div>
            <label class="tam-label" for="tratamiento">TRATAMIENTO</label>
            <br>
            <textarea rows="4" class="controls-11" style="resize: none;" name="tratamiento_consulta"><?php echo $view['tratamiento_consulta']; ?></textarea>
        </div>
        <div>
            <label class="tam-label" for="cie10">CIE10</label>
            <br>
            <input class="controls-9" type="text" name="cie10_consulta" value="<?php echo $view['cie10_consulta']; ?>">
        </div>
        <div>
            <label class="tam-label" for="proxima">PROXIMA CONSULTA</label>
            <br>
            <input class="controls-9" type="text" name="proxima_consulta" value="<?php echo $view['proxima_consulta']; ?>">
        </div>
    </fieldset>
</body>
</html>
<?php
$html = ob_get_clean();

require_once 'assets/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadhtml($html);

$dompdf->setPaper('A4');

$dompdf->render();
$dompdf->stream("historial.pdf", array("Attachment" => false));

?>