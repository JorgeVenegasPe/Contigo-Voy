<?php
require_once("../../Controlador/Paciente/ControllerPaciente.php");
$obj = new usernameControlerPaciente();
$obj->eliminar($_GET['id']);
?>
