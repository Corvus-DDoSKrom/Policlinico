<?php
session_start();
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='DOCTOR'){
    header("location:error-403");
}
$host = "localhost";
$basededatos = "policlinico";
$usuario = "root";
$contraseña = "";

$conexion = new mysqli($host, $usuario,$contraseña, $basededatos);
if ($conexion -> connect_error){
	die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> mysqli_connect_error());
}

$tabla="";
$id_user2 = $_SESSION['name_doctor'];
$query="SELECT*FROM consulta INNER JOIN patient ON consulta.id_patient = patient.id_patient INNER JOIN detalle_consulta ON consulta.id_detalle_consulta = detalle_consulta.id_detalle_consulta INNER JOIN doctor ON consulta.id_doctor = doctor.id_doctor INNER JOIN specialty ON consulta.id_specialty = specialty.id_specialty WHERE name_doctor='$id_user2' ORDER BY fecha ASC";

if(isset($_POST['consulta'])){
	$q=$conexion->real_escape_string($_POST['consulta']);
	$query="SELECT * FROM consulta INNER JOIN patient ON consulta.id_patient = patient.id_patient INNER JOIN detalle_consulta ON consulta.id_detalle_consulta = detalle_consulta.id_detalle_consulta INNER JOIN doctor ON consulta.id_doctor = doctor.id_doctor INNER JOIN specialty ON consulta.id_specialty = specialty.id_specialty WHERE 
		name_patient LIKE '%".$q."%' OR
		fecha LIKE '%".$q."%' OR
		name_doctor LIKE '%".$q."%' OR
		title LIKE '%".$q."%'";
}

$buscarConsulta=$conexion->query($query);
if ($buscarConsulta->num_rows > 0){
	$tabla.= 
	'<table class="blueTable">
		<thead>
			<tr>
				<th scope="col">PACIENTE</th>
				<th scope="col">FECHA</th>
				<th scope="col">DOCTOR</th>
				<th scope="col">ESPECIALIDAD</th>
				<th scope="col">ACCIÓN</th>
			</tr>
		</thead>
		';

	while($row= $buscarConsulta->fetch_assoc()){
		$tabla.=
		'<tbody id="datos">
			<tr>
				<td style="text-transform:uppercase;">'.$row['name_patient'].' '.$row['surname_patient'].'</td>
				<td>'.$row['fecha'].'</td>
				<td>'.$row['name_doctor'].'</td>
				<td>'.$row['title'].'</td>
				<td>
					<a class="myButton-histo" href="report?id_consulta='.$row['id_consulta'].'" target="_blank"><span></span>Ver historial</a>
				</td>
			</tr>
		</tbody>
		';
	}
	$tabla.='</table>';
}else{
	$tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
}

echo $tabla;
?>
