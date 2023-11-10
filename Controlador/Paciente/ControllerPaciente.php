<?php
class usernameControlerPaciente
{
    private $model;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Contigo-Voy/Modelo/Paciente/ModelPaciente.php");
        $this->model = new UserModelPaciente();
    }

    // Guardar paciente
    public function GuardarPaciente($NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad, $GradoInstruccion, $Ocupacion, $EstadoCivil, $Genero, $Telefono, $Email, $Direccion, $AntecedentesMedicos, $IdPsicologo, $MedicamentosPrescritos, $IdProvincia, $IdDepartamento, $IdDistrito)
    {
        $id = $this->model->GuardarPaciente($NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad, $GradoInstruccion, $Ocupacion, $EstadoCivil, $Genero, $Telefono, $Email, $Direccion, $AntecedentesMedicos, $IdPsicologo, $MedicamentosPrescritos, $IdProvincia, $IdDepartamento, $IdDistrito);
        return ($id != false) ? header("Location:../../Vista/RegPaciente.php?enviado=true") : header("Location:../../Vista/RegPaciente.php?enviado=true");
    }

    // Mostrar datos del paciente
    public function ver($IdPsicologo)
    {
        return ($this->model->ver($IdPsicologo)) ?: false;
    }

    // Eliminiar paciente seleccionado
    public function eliminar($id)
    {
        return ($this->model->eliminar($id)) ?  header("Location:../../Vista/TablaPacientes.php") : header("Location:../../Vista/TablaPacientes.php");
    }

    // Mpdificar datos del paciente
    public function modificarPaciente($IdPaciente, $NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad, $GradoInstruccion, $Ocupacion, $EstadoCivil, $Genero, $Telefono, $Email, $Direccion, $AntecedentesMedicos, $MedicamentosPrescritos)
    {
        $result = $this->model->modificarPaciente($IdPaciente, $NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad, $GradoInstruccion, $Ocupacion, $EstadoCivil, $Genero, $Telefono, $Email, $Direccion, $AntecedentesMedicos, $MedicamentosPrescritos);

        if ($result !== false) {
            header("Location:../../Vista/TablaPacientes.php");
        } else {
            header("Location:../../Vista/TablaPacientes.php");
        }
    }


    // Mostrar datos del paciente seleccionado
    public function showCompleto($IdPsicologo)
    {
        return ($this->model->getAllPatients($IdPsicologo)) ?: false;
    }

    // Mostrar datos del paciente seleccionado
    public function showCompletoAtencion($IdPsicologo)
    {
        $patients = $this->model->getAllAtencPatients($IdPsicologo);
        return $patients;
    }


    public function show($IdPaciente)
    {
        return ($this->model->show($IdPaciente) != false) ? $this->model->show($IdPaciente) : header("Location:../../Vista/Historial.php");
    }
    // Mostrar 4 paciente reciente 
    public function MostrarPacientesRecientes($idPsicologo)
    {
        $pacientesRecientes = $this->model->MostrarPacientesRecientes($idPsicologo);
        if ($pacientesRecientes !== false) {
            foreach ($pacientesRecientes as &$paciente) {
                $fecha = date('Y-m-d', strtotime($paciente['FechaRegistro']));
                $hora = date('H:i:s', strtotime($paciente['FechaRegistro']));

                $paciente['Fecha'] = $fecha;
                $paciente['Hora'] = $hora;
            }
        } else {
            $pacientesRecientes = array(); // Asignar un arreglo vacío
        }

        return $pacientesRecientes;
    }

    // Mostrar departamento 
    public function MostrarDepartamento()
    {
        return ($this->model->MostrarDepartamento()) ?: false;
    }

    // Mostrar datos del psicologo
    public function DatosPsicologo($idPsicologo)
    {
        return ($this->model->DatosPsicologo($idPsicologo)) ?: false;
    }

    // ================ Area Familiar =============//

    // Guardar datos familiares del paciente
    public function guardarAreaFamiliar($IdPaciente, $NomPadre, $EstadoPadre, $NomMadre, $EstadoMadre, $NomApoderado, $EstadoApoderado, $CantHermanos, $CantHijos, $IntegracionFamiliar, $HistorialFamiliar)
    {
        $id = $this->model->insertarAreaFamiliar($IdPaciente, $NomPadre, $EstadoPadre, $NomMadre, $EstadoMadre, $NomApoderado, $EstadoApoderado, $CantHermanos, $CantHijos, $IntegracionFamiliar, $HistorialFamiliar);
        return ($id != false) ? header("Location:../../Vista/TablaPacientes.php") : header("Location:../../Vista/TablaPacientes.php");
    }

    // Modificar datos familiares del paciente
    public function ModificarAreaFamiliar($IdFamiliar, $NomPadre, $EstadoPadre, $NomMadre, $EstadoMadre, $NomApoderado, $EstadoApoderado, $CantHermanos, $CantHijos, $IntegracionFamiliar, $HistorialFamiliar)
    {
        return ($this->model->ModificarAreaFamiliar($IdFamiliar, $NomPadre, $EstadoPadre, $NomMadre, $EstadoMadre, $NomApoderado, $EstadoApoderado, $CantHermanos, $CantHijos, $IntegracionFamiliar, $HistorialFamiliar)) != false ?
            header("Location:../../Vista/TablaPacientes.php") : header("Location:../../Vista/TablaPacientes.php");
    }

    // ================ Atencion al paciente =============//

    // Guardar la atencion del paciente
    public function guardarAtencPac($IdPaciente, $IdEnfermedad, $MotivoConsulta, $FormaContacto, $Diagnostico, $Tratamiento, $Observacion, $UltimosObjetivos)
    {
        $id = $this->model->insertarAtencPaciente($IdPaciente, $IdEnfermedad, $MotivoConsulta, $FormaContacto, $Diagnostico, $Tratamiento, $Observacion, $UltimosObjetivos);
        return ($id != false) ? header("Location:../../Vista/Historial.php") : header("Location:../../Vista/Historial.php");
    }

    // Modificar datos seleccionados de la atencion al paciente
    public function modificarAtencPaciente($IdAtencion, $MotivoConsulta, $FormaContacto, $Diagnostico, $Tratamiento, $Observacion, $UltimosObjetivos)
    {
        return ($this->model->modificarAtencPaciente($IdAtencion, $MotivoConsulta, $FormaContacto, $Diagnostico, $Tratamiento, $Observacion, $UltimosObjetivos)) != false ?
            header("Location:../../Vista/Historial.php") : header("Location:../../Vista/Historial.php");
    }

    // Mostrar datos completos de el paciente
    public function showAtenc($id)
    {
        $atencion = $this->model->showAtenc($id);
        if ($atencion !== false) {
            return $atencion;
        } else {
            return null;
        }
    }
}
