
<?php
require("C:/xampp/htdocs/Contigo-Voy/Conexion/conexion.php");
$con=new conexion();
$conn=$con->conexion();

$Dni = $_REQUEST['Dni'];
$jsonData = array();
$selectQuery = "SELECT Dni FROM paciente WHERE Dni=:dni";
$stmt = $conn->prepare($selectQuery);
$stmt->bindParam(':dni', $Dni);
$stmt->execute();
$totalCliente = $stmt->rowCount();
  if( $totalCliente <= 0 ){
    $jsonData['success'] = 0;
    $jsonData['message'] = '';
} else{
    //Si hay datos entonces retornas algo
    $jsonData['success'] = 1;
    $jsonData['message'] = '<p style="color:red;">Ya existe alguien con este Doc. <strong>(' .$Dni.')<strong></p>';
  }

//Mostrando mi respuesta en formato Json
header('Content-type: application/json; charset=utf-8');
echo json_encode( $jsonData );
?>