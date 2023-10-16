<?php
require_once("../../Controlador/Cita/citaControlador.php");
$obj = new usernameControlerCita();
$obj->eliminar($_GET['id']);
?>
