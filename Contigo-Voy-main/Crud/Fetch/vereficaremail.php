

<?php
require("C:/xampp/htdocs/Contigo-Voy/Conexion/conexion.php");
$con=new conexion();
$conn=$con->conexion();

$Email = $_REQUEST['Email'];
$jsonData = array();
$selectQuery = "SELECT Email FROM paciente WHERE Email=:email";
$stmt = $conn->prepare($selectQuery);
$stmt->bindParam(':email', $Email);
$stmt->execute();
$totalCliente = $stmt->rowCount();
  if( $totalCliente <= 0 ){
    $jsonData['success'] = 0;
    $jsonData['message'] = '';
} else{
    //Si hay datos entonces retornas algo
    $jsonData['success'] = 1;
    $jsonData['message'] = '<p style="color:red;">Ya existe alguien este Email</p>';
  }

//Mostrando mi respuesta en formato Json
header('Content-type: application/json; charset=utf-8');
echo json_encode( $jsonData );
?>