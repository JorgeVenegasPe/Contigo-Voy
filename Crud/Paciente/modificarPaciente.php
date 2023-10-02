<?php
require_once("../../Controlador/Paciente/ControllerPaciente.php");
$obj = new usernameControlerPaciente();
$obj->modificarPaciente($_POST['IdPaciente'],$_POST['NomPaciente'], $_POST['ApPaterno'], $_POST['ApMaterno'], $_POST['Dni'], $_POST['FechaNacimiento'], $_POST['Edad'], $_POST['GradoInstruccion'], $_POST['Ocupacion'], $_POST['EstadoCivil'], $_POST['Genero'], $_POST['Telefono'], $_POST['Email'], $_POST['Direccion'], $_POST['AntecedentesMedicos'],$_POST['MedicamentosPrescritos'],$_POST['Provincia'],$_POST['Departamento'],$_POST['Distrito']);

?>
