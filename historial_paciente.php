<?php
session_start();
require 'includes/auth_validate.php'; //validacion de php
$privilege_admin = $_SESSION['privilege']; // privilegio de administrador
if($privilege_admin !='DOCTOR'){ // privilegio selecionado
    header("location:error-403");
}
$host = "localhost"; //la conexion
$basededatos = "policlinico"; // llamara a la base de datos
$usuario = "root"; // colocar usuarioo
$contraseña = "";   // colocar contraseña

$conexion = new mysqli($host, $usuario,$contraseña, $basededatos); // aqui llamara la conexion a la base de datos
if ($conexion -> connect_error){
	die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> mysqli_connect_error());
}

$tabla="";
$id_user2 = $_SESSION['name_doctor']; //inicio de secion de doctor
$query="SELECT*FROM consulta INNER JOIN patient ON consulta.id_patient = patient.id_patient INNER JOIN detalle_consulta ON consulta.id_detalle_consulta = detalle_consulta.id_detalle_consulta INNER JOIN doctor ON consulta.id_doctor = doctor.id_doctor INNER JOIN specialty ON consulta.id_specialty = specialty.id_specialty WHERE name_doctor='$id_user2' ORDER BY fecha ASC";

if(isset($_POST['consulta'])){ // tablas consulta
	$q=$conexion->real_escape_string($_POST['consulta']);
	$query="SELECT * FROM consulta INNER JOIN patient ON consulta.id_patient = patient.id_patient INNER JOIN detalle_consulta ON consulta.id_detalle_consulta = detalle_consulta.id_detalle_consulta INNER JOIN doctor ON consulta.id_doctor = doctor.id_doctor INNER JOIN specialty ON consulta.id_specialty = specialty.id_specialty WHERE 
		name_patient LIKE '%".$q."%' OR
		fecha LIKE '%".$q."%' OR
		name_doctor LIKE '%".$q."%' OR
		title LIKE '%".$q."%'";
}

$buscarConsulta=$conexion->query($query);
if ($buscarConsulta->num_rows > 0){ //ciclo para buscar las consultas
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

	while($row= $buscarConsulta->fetch_assoc()){ // un bucle para buscar consulta
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
// fin del ciclo
echo $tabla;
?>
