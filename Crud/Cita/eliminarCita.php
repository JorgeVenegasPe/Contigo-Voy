<?php
require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/Controlador/Cita/citaControlador.php");
$obj = new usernameControlerCita();
$obj->eliminar($_GET['id']);
?>
