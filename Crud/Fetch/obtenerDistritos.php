<?php
require("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
$con = new conexion();
$conn = $con->conexion();

// obtener_provincias.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $provinciaId = $_POST['provinciaId'];

    // Realizar la consulta SQL para obtener las provincias del departamento seleccionado
    $statement = $conn->prepare("SELECT * FROM distrito WHERE provincia_id = :provinciaId");
    $statement->bindParam(':provinciaId', $provinciaId);
    $statement->execute();
    $provincias = $statement->fetchAll();

    echo json_encode($provincias);
}
?>