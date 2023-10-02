<?php
require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Controlador/Paciente/ControllerPaciente.php");
$obj = new usernameControlerPaciente();
$obj->eliminar($_GET['id']);
?>
