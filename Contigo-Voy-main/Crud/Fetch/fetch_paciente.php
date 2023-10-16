<?php
require("C:/xampp/htdocs/Contigo-Voy/conexion/conexion.php");
$con = new conexion();
$conn = $con->conexion();

$codigopac = $_POST['codigopac'];
$idPsicologo = $_POST['idPsicologo']; // Obtener el valor del IdPsicologo

$sql = "SELECT NomPaciente, ApPaterno, ApMaterno, Email, Telefono, IdPaciente 
        From paciente
        WHERE codigopac = :codigopac
        AND IdPsicologo = :idPsicologo"; // Agregar la condición para el IdPsicologo

$stmt = $conn->prepare($sql);
$stmt->bindParam(':codigopac', $codigopac);
$stmt->bindParam(':idPsicologo', $idPsicologo); // Bindear el parámetro IdPsicologo
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  $IdPaciente = $row['IdPaciente'];
  $nombrePaciente = $row['NomPaciente'];
  $ApPaterno = $row['ApPaterno'];
  $ApMaterno = $row['ApMaterno'];
  $correo = $row['Email'];
  $telefono = $row['Telefono'];
  $response = array('nombre' => $nombrePaciente." ".$ApMaterno." ".$ApPaterno,'id' => $IdPaciente,'correo'=> $correo,'telefono'=> $telefono,'nom'=>$nombrePaciente);
} else {
  $response = array('error' => 'No existe ese paciente');
}

header('Content-Type: application/json');
echo json_encode($response);
?>

