<?php
class userModelPaciente
{
    private $PDO;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Contigo-Voy/conexion/conexion.php");
        $con = new conexion();
        $this->PDO = $con->conexion();
    }

    // Genera codigo paciente 
    private function generarCodigoPaciente($IdPaciente)
    {
        $prefijo = 'PA';
        $idPacienteFormateado = str_pad($IdPaciente, 4, '0', STR_PAD_LEFT);
        $codigoPaciente = $prefijo . $idPacienteFormateado;
        return $codigoPaciente;
    }

    // Guardar un nuevo paciente con el código generado automáticamente
    public function GuardarPaciente($NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad, $GradoInstruccion, $Ocupacion, $EstadoCivil, $Genero, $Telefono, $Email, $Direccion, $AntecedentesMedicos, $IdPsicologo, $MedicamentosPrescritos, $IdProvincia, $IdDepartamento, $IdDistrito)
    {
        $statement = $this->PDO->prepare("INSERT INTO Paciente(NomPaciente, ApPaterno, ApMaterno, Dni, FechaNacimiento, Edad,
         GradoInstruccion, Ocupacion, EstadoCivil, Genero, Telefono, Email, Direccion, AntecedentesMedicos, IdPsicologo, MedicamentosPrescritos,IdProvincia,IdDepartamento,IdDistrito) 
         VALUES(:NomPaciente, :ApPaterno, :ApMaterno, :Dni, :FechaNacimiento, :Edad, :GradoInstruccion, 
         :Ocupacion, :EstadoCivil, :Genero, :Telefono, :Email, :Direccion, :AntecedentesMedicos, :IdPsicologo, :MedicamentosPrescritos,:IdProvincia,:IdDepartamento,:IdDistrito)");

        $statement->bindParam(":NomPaciente", $NomPaciente);
        $statement->bindParam(":ApPaterno", $ApPaterno);
        $statement->bindParam(":ApMaterno", $ApMaterno);
        $statement->bindParam(":Dni", $Dni);
        $statement->bindParam(":FechaNacimiento", $FechaNacimiento);
        $statement->bindParam(":Edad", $Edad);
        $statement->bindParam(":GradoInstruccion", $GradoInstruccion);
        $statement->bindParam(":Ocupacion", $Ocupacion);
        $statement->bindParam(":EstadoCivil", $EstadoCivil);
        $statement->bindParam(":Genero", $Genero);
        $statement->bindParam(":Telefono", $Telefono);
        $statement->bindParam(":Email", $Email);
        $statement->bindParam(":Direccion", $Direccion);
        $statement->bindParam(":AntecedentesMedicos", $AntecedentesMedicos);
        $statement->bindParam(":IdPsicologo", $IdPsicologo);
        $statement->bindParam(":MedicamentosPrescritos", $MedicamentosPrescritos);
        $statement->bindParam(":IdProvincia", $IdProvincia);
        $statement->bindParam(":IdDepartamento", $IdDepartamento);
        $statement->bindParam(":IdDistrito", $IdDistrito);

        $id = ($statement->execute()) ? $this->PDO->lastInsertId() : false;

        if ($id !== false) {
            // Genera el código del paciente utilizando el IdPaciente
            $codigoPaciente = $this->generarCodigoPaciente($id);

            // Actualiza la columna CodigoPaciente en la base de datos con el código generado
            $this->actualizarCodigoPaciente($id, $codigoPaciente);
        }

        return $id;
    }

    // Método para actualizar el código del paciente en la base de datos
    private function actualizarCodigoPaciente($IdPaciente, $codigoPaciente)
    {
        $statement = $this->PDO->prepare("UPDATE Paciente SET codigopac = :codigoPaciente WHERE IdPaciente = :IdPaciente");
        $statement->bindParam(":IdPaciente", $IdPaciente);
        $statement->bindParam(":codigoPaciente", $codigoPaciente);
        return $statement->execute();
    }



    // Mostrar datos del paciente seleccionado 
    public function show($IdPaciente)
    {
        $statement = $this->PDO->prepare("SELECT p.IdPaciente,p.codigopac, p.NomPaciente, p.ApPaterno, p.ApMaterno, p.Dni, p.FechaNacimiento, p.Edad, p.GradoInstruccion, p.Ocupacion, p.EstadoCivil,p.Genero, p.Telefono,
         p.Email, p.Direccion, p.AntecedentesMedicos, p.IdPsicologo, p.MedicamentosPrescritos, de.name, di.name, pr.name 
         FROM paciente p 
         inner join departamento de on de.id = p.IdDepartamento
         inner join distrito di on di.id = p.IdDistrito
         inner join provincia pr on pr.id = p.IdProvincia
        where p.IdPaciente = :IdPaciente limit 1");
        $statement->bindParam(":IdPaciente", $IdPaciente);
        return ($statement->execute()) ? $statement->fetch() : false;
    }
    // Ver datos del paciente 
    public function ver($IdPsicologo)
    {
        $statement = $this->PDO->prepare("SELECT * FROM Paciente WHERE IdPsicologo = :IdPsicologo ");
        $statement->bindValue(':IdPsicologo', $IdPsicologo);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }
    // Mostrar datos del paciente seleccionado 
    public function getAllPatients($IdPsicologo)
    {
        $statement = $this->PDO->prepare("SELECT p.IdPaciente ,p.*, af.*
        FROM paciente p
        LEFT JOIN areafamiliar af ON p.IdPaciente = af.IdPaciente
        WHERE p.IdPsicologo = :IdPsicologo");
        $statement->bindValue(":IdPsicologo", $IdPsicologo);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }



    // Mostrar datos del paciente seleccionado 
    public function getAllAtencPatients($IdPsicologo)
    {
        $query = "SELECT p.*, ate.*, c.FechaInicioCita
                  FROM paciente p
                  LEFT JOIN atencionpaciente ate ON p.IdPaciente = ate.IdPaciente
                  LEFT JOIN cita c ON p.IdPaciente = c.IdPaciente
                  WHERE p.IdPsicologo = :IdPsicologo";

        $statement = $this->PDO->prepare($query);
        $statement->bindParam(":IdPsicologo", $IdPsicologo);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    // Elimianr paciente seleccionado
    public function eliminar($IdPaciente)
    {
        $statement = $this->PDO->prepare("DELETE FROM Paciente WHERE IdPaciente=:id;");
        $statement->bindParam(":id", $IdPaciente);
        return ($statement->execute()) ? true : false;
    }

    // Modificar paciente
    public function modificarPaciente($IdPaciente, $NomPaciente, $ApPaterno, $ApMaterno, $Dni, $FechaNacimiento, $Edad, $GradoInstruccion, $Ocupacion, $EstadoCivil, $Genero, $Telefono, $Email, $Direccion, $AntecedentesMedicos, $MedicamentosPrescritos, $IdProvincia, $IdDepartamento, $IdDistrito)
    {
        $statement = $this->PDO->prepare("UPDATE Paciente SET NomPaciente=:NomPaciente, ApPaterno=:ApPaterno, ApMaterno=:ApMaterno,
        Dni=:Dni,FechaNacimiento=:FechaNacimiento,Edad=:Edad, GradoInstruccion=:GradoInstruccion, Ocupacion=:Ocupacion, EstadoCivil=:EstadoCivil, Genero=:Genero,
        Telefono=:Telefono, Email=:Email, Direccion=:Direccion, AntecedentesMedicos=:AntecedentesMedicos, MedicamentosPrescritos=:MedicamentosPrescritos,
        IdProvincia=:IdProvincia, IdDepartamento=:IdDepartamento, IdDistrito=:IdDistrito WHERE IdPaciente=:IdPaciente");
        $statement->bindParam(":IdPaciente", $IdPaciente);
        $statement->bindParam(":NomPaciente", $NomPaciente);
        $statement->bindParam(":ApPaterno", $ApPaterno);
        $statement->bindParam(":ApMaterno", $ApMaterno);
        $statement->bindParam(":Dni", $Dni);
        $statement->bindParam(":FechaNacimiento", $FechaNacimiento);
        $statement->bindParam(":Edad", $Edad);
        $statement->bindParam(":GradoInstruccion", $GradoInstruccion);
        $statement->bindParam(":Ocupacion", $Ocupacion);
        $statement->bindParam(":EstadoCivil", $EstadoCivil);
        $statement->bindParam(":Genero", $Genero);
        $statement->bindParam(":Telefono", $Telefono);
        $statement->bindParam(":Email", $Email);
        $statement->bindParam(":Direccion", $Direccion);
        $statement->bindParam(":AntecedentesMedicos", $AntecedentesMedicos);
        $statement->bindParam(":MedicamentosPrescritos", $MedicamentosPrescritos);
        $statement->bindParam(":IdProvincia", $IdProvincia);
        $statement->bindParam(":IdDepartamento", $IdDepartamento);
        $statement->bindParam(":IdDistrito", $IdDistrito);

        return ($statement->execute()) ? $this->PDO->lastInsertId() : false;
    }

    // Mostrar pacientes recientes
    public function MostrarPacientesRecientes($idPsicologo)
    {
        $statement = $this->PDO->prepare("SELECT NomPaciente, ApMaterno, ApPaterno, Edad,codigopac, FechaRegistro FROM paciente 
        WHERE IdPsicologo = :idPsicologo
        ORDER BY IdPaciente DESC LIMIT 4");
        $statement->bindParam(":idPsicologo", $idPsicologo);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }

    // Mostrar Departamentos 
    public function MostrarDepartamento()
    {
        $statement = $this->PDO->prepare("SELECT * FROM departamento");
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }

    // Mostrar datos del psicologo
    public function DatosPsicologo($idPsicologo)
    {
        $statement = $this->PDO->prepare("SELECT * FROM psicologo 
        where IdPsicologo = :idPsicologo");
        $statement->bindParam(":idPsicologo", $idPsicologo);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }

    // =================== Area Familiar ================================= //

    // Guardar datos familiares segun el paciente
    //cambios
    public function insertarAreaFamiliar($IdPaciente, $NomPadre, $EstadoPadre, $NomMadre, $EstadoMadre, $NomApoderado, $EstadoApoderado, $CantHermanos, $CantHijos, $IntegracionFamiliar, $HistorialFamiliar)
    {
        // Check if the patient already exists
        $existingPatient = $this->PDO->prepare("SELECT IdPaciente FROM AreaFamiliar WHERE IdPaciente = :IdPaciente");
        $existingPatient->bindParam(":IdPaciente", $IdPaciente);
        $existingPatient->execute();

        if ($existingPatient->rowCount() > 0) {
            // Patient already exists, update the record
            $statement = $this->PDO->prepare("UPDATE AreaFamiliar SET
                NomPadre = :NomPadre,
                EstadoPadre = :EstadoPadre,
                NomMadre = :NomMadre,
                EstadoMadre = :EstadoMadre,
                NomApoderado = :NomApoderado,
                EstadoApoderado = :EstadoApoderado,
                CantHermanos = :CantHermanos,
                CantHijos = :CantHijos,
                IntegracionFamiliar = :IntegracionFamiliar,
                HistorialFamiliar = :HistorialFamiliar
                WHERE IdPaciente = :IdPaciente");

            // Bind parameters
            $statement->bindParam(":NomPadre", $NomPadre);
            $statement->bindParam(":EstadoPadre", $EstadoPadre);
            $statement->bindParam(":NomMadre", $NomMadre);
            $statement->bindParam(":EstadoMadre", $EstadoMadre);
            $statement->bindParam(":NomApoderado", $NomApoderado);
            $statement->bindParam(":EstadoApoderado", $EstadoApoderado);
            $statement->bindParam(":CantHermanos", $CantHermanos);
            $statement->bindParam(":CantHijos", $CantHijos);
            $statement->bindParam(":IntegracionFamiliar", $IntegracionFamiliar);
            $statement->bindParam(":HistorialFamiliar", $HistorialFamiliar);
            $statement->bindParam(":IdPaciente", $IdPaciente);

            return $statement->execute();
        } else {
            // Patient doesn't exist, insert a new record
            $statement = $this->PDO->prepare("INSERT INTO AreaFamiliar (IdPaciente, NomPadre, EstadoPadre, NomMadre, EstadoMadre, NomApoderado, EstadoApoderado, CantHermanos, CantHijos, IntegracionFamiliar, HistorialFamiliar) VALUES (:IdPaciente, :NomPadre, :EstadoPadre, :NomMadre, :EstadoMadre, :NomApoderado, :EstadoApoderado, :CantHermanos, :CantHijos, :IntegracionFamiliar, :HistorialFamiliar)");

            // Bind parameters
            $statement->bindParam(":IdPaciente", $IdPaciente);
            $statement->bindParam(":NomPadre", $NomPadre);
            $statement->bindParam(":EstadoPadre", $EstadoPadre);
            $statement->bindParam(":NomMadre", $NomMadre);
            $statement->bindParam(":EstadoMadre", $EstadoMadre);
            $statement->bindParam(":NomApoderado", $NomApoderado);
            $statement->bindParam(":EstadoApoderado", $EstadoApoderado);
            $statement->bindParam(":CantHermanos", $CantHermanos);
            $statement->bindParam(":CantHijos", $CantHijos);
            $statement->bindParam(":IntegracionFamiliar", $IntegracionFamiliar);
            $statement->bindParam(":HistorialFamiliar", $HistorialFamiliar);

            return $statement->execute();
        }
    }
    // Mpdoficar datos familiares
    public function ModificarAreaFamiliar($IdFamiliar, $NomPadre, $EstadoPadre, $NomMadre, $EstadoMadre, $NomApoderado, $EstadoApoderado, $CantHermanos, $CantHijos, $IntegracionFamiliar, $HistorialFamiliar)
    {

        $statement = $this->PDO->prepare("UPDATE AreaFamiliar SET NomPadre=:NomPadre,EstadoPadre=:EstadoPadre, NomMadre=:NomMadre, EstadoMadre=:EstadoMadre,NomApoderado=:NomApoderado, EstadoApoderado=:EstadoApoderado, CantHermanos=:CantHermanos, CantHijos=:CantHijos, IntegracionFamiliar=:IntegracionFamiliar, HistorialFamiliar=:HistorialFamiliar WHERE IdFamiliar=:IdFamiliar");
        $statement->bindParam(":IdFamiliar", $IdFamiliar);
        $statement->bindParam(":NomPadre", $NomPadre);
        $statement->bindParam(":EstadoPadre", $EstadoPadre);
        $statement->bindParam(":NomMadre", $NomMadre);
        $statement->bindParam(":EstadoMadre", $EstadoMadre);
        $statement->bindParam(":NomApoderado", $NomApoderado);
        $statement->bindParam(":EstadoApoderado", $EstadoApoderado);
        $statement->bindParam(":CantHermanos", $CantHermanos);
        $statement->bindParam(":CantHijos", $CantHijos);
        $statement->bindParam(":IntegracionFamiliar", $IntegracionFamiliar);
        $statement->bindParam(":HistorialFamiliar", $HistorialFamiliar);

        return ($statement->execute()) ? $this->PDO->lastInsertId() : false;
    }

    // ====================== Atencion al Paciente =========================== //

    // Guardar la atencion del paciente
    public function insertarAtencPaciente($IdPaciente, $IdEnfermedad, $MotivoConsulta, $FormaContacto, $Diagnostico, $Tratamiento, $Observacion, $UltimosObjetivos)
    {
        $IdPaciente = $_POST['IdPaciente'];
        $IdEnfermedad = $_POST['IdEnfermedad'];
        $MotivoConsulta = $_POST['MotivoConsulta'];
        $FormaContacto = $_POST['FormaContacto'];
        $Diagnostico = $_POST['Diagnostico'];
        $Tratamiento = $_POST['Tratamiento'];
        $Observacion = $_POST['Observacion'];
        $UltimosObjetivos = $_POST['UltimosObjetivos'];
        $statement = $this->PDO->prepare("INSERT INTO AtencionPaciente(IdPaciente, IdEnfermedad, MotivoConsulta,FormaContacto, Diagnostico, Tratamiento, Observacion,UltimosObjetivos) VALUES(:IdPaciente, :IdEnfermedad, :MotivoConsulta, :FormaContacto, :Diagnostico, :Tratamiento, :Observacion, :UltimosObjetivos)");
        $array = array($IdPaciente, $IdEnfermedad, $MotivoConsulta, $FormaContacto, $Diagnostico, $Tratamiento, $Observacion, $UltimosObjetivos);
        $statement->bindParam(":IdPaciente", $IdPaciente);
        $statement->bindParam(":IdEnfermedad", $IdEnfermedad);
        $statement->bindParam(":MotivoConsulta", $MotivoConsulta);
        $statement->bindParam(":FormaContacto", $FormaContacto);
        $statement->bindParam(":Diagnostico", $Diagnostico);
        $statement->bindParam(":Tratamiento", $Tratamiento);
        $statement->bindParam(":Observacion", $Observacion);
        $statement->bindParam(":UltimosObjetivos", $UltimosObjetivos);

        return ($statement->execute()) ? $this->PDO->lastInsertId() : false;
    }

    // Modificar datos seleccionados de la atencion al paciente
    public function modificarAtencPaciente($IdAtencion, $MotivoConsulta, $FormaContacto, $Diagnostico, $Tratamiento, $Observacion, $UltimosObjetivos)
    {

        $statement = $this->PDO->prepare("UPDATE AtencionPaciente SET MotivoConsulta=:MotivoConsulta,FormaContacto=:FormaContacto,Diagnostico=:Diagnostico, Tratamiento=:Tratamiento, Observacion=:Observacion, UltimosObjetivos=:UltimosObjetivos WHERE IdAtencion=:IdAtencion");
        $statement->bindParam(":IdAtencion", $IdAtencion);
        $statement->bindParam(":MotivoConsulta", $MotivoConsulta);
        $statement->bindParam(":FormaContacto", $FormaContacto);
        $statement->bindParam(":Diagnostico", $Diagnostico);
        $statement->bindParam(":Tratamiento", $Tratamiento);
        $statement->bindParam(":Observacion", $Observacion);
        $statement->bindParam(":UltimosObjetivos", $UltimosObjetivos);

        return ($statement->execute()) ? $this->PDO->lastInsertId() : false;
    }

    // Mostrar datos completos de el paciente
    public function showAtenc($IdPaciente)
    {
        $statement = $this->PDO->prepare("SELECT ap.IdAtencion,ap.IdPaciente,ap.IdEnfermedad,e.Clasificacion,p.NomPaciente,ap.MotivoConsulta,ap.FormaContacto,ap.Diagnostico,ap.Tratamiento,ap.Observacion,ap.UltimosObjetivos
        FROM AtencionPaciente ap
        JOIN Enfermedad e ON ap.IdEnfermedad = e.IdEnfermedad
        JOIN Paciente p ON ap.IdPaciente = p.IdPaciente
        WHERE p.IdPaciente = :IdPaciente
        ORDER BY ap.FechaRegistro DESC
        LIMIT 1 ");
        $statement->bindParam(":IdPaciente", $IdPaciente);
        return ($statement->execute()) ? $statement->fetch() : false;
    }
    public function showAtenco($IdPaciente)
    {
        $statement = $this->PDO->prepare("SELECT ap.IdAtencion, ap.IdPaciente, ap.IdEnfermedad, e.Clasificacion, 
        CONCAT(p.NomPaciente, ' ', p.ApPaterno, ' ', p.ApMaterno) AS NombreCompleto, p.Edad, p.MedicamentosPrescritos, 
        ap.MotivoConsulta, ap.FormaContacto, ap.Diagnostico, ap.Tratamiento, ap.Observacion, ap.UltimosObjetivos

        FROM AtencionPaciente ap
        JOIN Enfermedad e ON ap.IdEnfermedad = e.IdEnfermedad
        JOIN Paciente p ON ap.IdPaciente = p.IdPaciente
        WHERE p.IdPaciente = :IdPaciente
        ORDER BY ap.FechaRegistro DESC
        LIMIT 1 ");
        $statement->bindParam(":IdPaciente", $IdPaciente);
        return ($statement->execute()) ? $statement->fetch() : false;
    }
}
