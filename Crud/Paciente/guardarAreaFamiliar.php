<?php
require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Controlador/Paciente/ControllerPaciente.php");
$obj = new usernameControlerPaciente();
$obj->guardarAreaFamiliar($_POST['IdPaciente'], $_POST['NomPadre'],$_POST['EstadoPadre'], $_POST['NomMadre'],$_POST['EstadoMadre'],$_POST['NomApoderado'],$_POST['EstadoApoderado'], $_POST['CantHermanos'], $_POST['CantHijos'], $_POST['IntegracionFamiliar'], $_POST['HistorialFamiliar']);

?>
