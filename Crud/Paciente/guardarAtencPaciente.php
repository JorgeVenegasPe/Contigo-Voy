<?php
require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Controlador/Paciente/ControllerPaciente.php");
$obj = new usernameControlerPaciente();
$obj->guardarAtencPac($_POST['IdPaciente'], $_POST['IdEnfermedad'], $_POST['MotivoConsulta'], $_POST['FormaContacto'], $_POST['Diagnostico'], $_POST['Tratamiento'],$_POST['Observacion'],$_POST['UltimosObjetivos']);?>
