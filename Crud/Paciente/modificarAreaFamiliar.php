<?php
require_once("../../Controlador/Paciente/ControllerPaciente.php");
$obj = new usernameControlerPaciente();
$obj->ModificarAreaFamiliar($_POST['IdFamiliar'], $_POST['NomPadre'], $_POST['EstadoPadre'], $_POST['NomMadre'], $_POST['EstadoMadre'], $_POST['NomApoderado'], $_POST['EstadoApoderado'], $_POST['CantHermanos'], $_POST['CantHijos'], $_POST['IntegracionFamiliar'], $_POST['HistorialFamiliar']);

?>
