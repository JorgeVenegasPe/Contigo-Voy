<?php
require_once("../../Controlador/Cita/ControllerCita.php");
$obj = new usernameControlerCita();
$obj->eliminar($_GET['id']);
?>
