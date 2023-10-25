<?php
class UserModelCita{
    private $PDO;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Contigo-Voy/conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();
    }
    
    // Guardar datos de la cita
    public function insertarCita($IdPaciente, $MotivoCita, $EstadoCita, $FechaInicioCita, $DuracionCita,$FechaFinCita, $TipoCita, $ColorFondo, $IdPsicologo, $CanalCita, $EtiquetaCita) {
        $statement = $this->PDO->prepare("INSERT INTO cita (IdPaciente, MotivoCita, EstadoCita, FechaInicioCita, DuracionCita, FechaFinCita, TipoCita, ColorFondo, IdPsicologo, CanalCita, EtiquetaCita) 
                                        VALUES (:IdPaciente, :MotivoCita, :EstadoCita, :FechaInicioCita, :DuracionCita,:FechaFinCita, :TipoCita, :ColorFondo, :IdPsicologo, :CanalCita, :EtiquetaCita)");
        $statement->bindParam(":IdPaciente", $IdPaciente);
        $statement->bindParam(":MotivoCita", $MotivoCita);
        $statement->bindParam(":EstadoCita", $EstadoCita);
        $statement->bindParam(":FechaInicioCita", $FechaInicioCita);
        $statement->bindParam(":DuracionCita", $DuracionCita);
        $statement->bindParam(":FechaFinCita", $FechaFinCita);
        $statement->bindParam(":TipoCita", $TipoCita);
        $statement->bindParam(":ColorFondo", $ColorFondo);
        $statement->bindParam(":IdPsicologo", $IdPsicologo);
        $statement->bindParam(":CanalCita", $CanalCita);
        $statement->bindParam(":EtiquetaCita", $EtiquetaCita);
    
        return ($statement->execute()) ? $this->PDO->lastInsertId() : false;
    }
    
    // Para ver datos completos de la cita
    public function ver($idUsuario){
        $statement=$this->PDO->prepare("SELECT c.IdCita,p.NomPaciente,c.MotivoCita,c.EstadoCita,c.FechaInicioCita,c.Duracioncita,c.TipoCita,c.ColorFondo,ps.NombrePsicologo,c.CanalCita,c.EtiquetaCita,p.codigopac FROM cita c
                                        INNER JOIN paciente p on c.IdPaciente=p.IdPaciente
                                        INNER JOIN psicologo ps on c.IdPsicologo=ps.IdPsicologo
                                        WHERE c.IdPsicologo = :idUsuario");
        $statement->bindValue(':idUsuario', $idUsuario);
        return($statement->execute())? $statement->fetchaLL():false;

    }

    // Eliminar cita seleccionada 
    public function eliminar($id){
        $statement=$this->PDO->prepare("DELETE FROM cita WHERE IdCita=:id;");
        $statement->bindParam(":id",$id);
        return($statement->execute())? true:false;
        
    }

    // Mostrar datos de cita seleccionada
    public function show($id){
        $statement=$this->PDO->prepare("SELECT c.IdCita,p.NomPaciente,p.Email,p.Telefono,c.EstadoCita,c.MotivoCita,c.FechaInicioCita,c.Duracioncita,c.TipoCita,c.ColorFondo,ps.NombrePsicologo,c.CanalCita,c.EtiquetaCita,c.FechaRegistro FROM cita c
                                       INNER JOIN psicologo ps on c.IdPsicologo=ps.IdPsicologo
                                       INNER JOIN paciente p on c.IdPaciente=p.IdPaciente
                                       where IdCita=:id limit 1");
        $statement->bindParam(":id",$id);
        return($statement->execute())? $statement->fetch():false;

    }

    // Mostrar citas segun la fecha actual
    public function showByFecha($id){
        $statement=$this->PDO->prepare("SELECT c.IdCita,p.NomPaciente,c.MotivoCita,c.EstadoCita,c.FechaInicioCita,c.Duracioncita,c.TipoCita,c.ColorFondo,ps.NombrePsicologo,c.CanalCita,c.EtiquetaCita,p.codigopac FROM cita c
                                       INNER JOIN psicologo ps on c.IdPsicologo=ps.IdPsicologo
                                       INNER JOIN paciente p on c.IdPaciente=p.IdPaciente
                                       where c.IdPsicologo = :idUsua
                                       AND WEEK(c.FechaRegistro)=WEEK(NOW())");
        $statement->bindParam(":idUsua",$id);
        return($statement->execute())? $statement->fetchaLL():false;

    }

    // Modificar cita completa
    public function modificarCita($IdCita,$FechaInicio, $EstadoCita,$MotivoCita,$Duracioncita,$TipoCita,$CanalCita,$EtiquetaCita ,$ColorFondo) {
      
        $statement = $this->PDO->prepare("UPDATE cita SET FechaInicioCita=:FechaInicioCita,EstadoCita=:EstadoCita,MotivoCita=:MotivoCita,Duracioncita=:Duracioncita,TipoCita=:TipoCita,CanalCita=:CanalCita,EtiquetaCita=:EtiquetaCita,ColorFondo=:ColorFondo WHERE IdCita=:IdCita");
        $statement->bindParam(":IdCita",$IdCita);
        $statement->bindParam(":FechaInicioCita",$FechaInicio);
        $statement->bindParam(":EstadoCita",$EstadoCita);
        $statement->bindParam(":MotivoCita",$MotivoCita);
        $statement->bindParam(":Duracioncita",$Duracioncita);
        $statement->bindParam(":TipoCita",$TipoCita);
        $statement->bindParam(":CanalCita",$CanalCita);
        $statement->bindParam(":EtiquetaCita",$EtiquetaCita);
        $statement->bindParam(":ColorFondo",$ColorFondo);
    
        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }

    // Contar el total de citas
    public function contarRegistrosEnCitas($id) {
        $statement=$this->PDO->prepare("SELECT COUNT(*) as total FROM cita WHERE IdPsicologo = :idPsicologo");
        $statement->bindParam(":idPsicologo",$id, PDO::PARAM_INT);
        $result = $statement->execute();
    
        if ($result) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $total_registros = $row["total"];
            return $total_registros;
        } else {
            return 0;
        }
    }

    // Contar el total de citas confirmadas
    public function contarCitasConfirmadas($id) {
        $statement=$this->PDO->prepare("SELECT COUNT(*) as total FROM cita WHERE IdPsicologo = :idPsicologo AND EstadoCita = 'Confirmado'");
        $statement->bindParam(":idPsicologo",$id, PDO::PARAM_INT);
        $result = $statement->execute();
    
        if ($result) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $total_registros = $row["total"];
            return $total_registros;
        } else {
            return 0;
        }
    }

    // Contar el total de pacientes
    public function contarRegistrosEnPacientes($id) {
        $statement=$this->PDO->prepare("SELECT COUNT(*) as total FROM paciente WHERE IdPsicologo = :idPsicologo");
        $statement->bindParam(":idPsicologo",$id, PDO::PARAM_INT);
        $result = $statement->execute();
    
        if ($result) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $total_registros = $row["total"];
            return $total_registros;
        } else {
            return 0;
        }
    }

    // Contar el total de pacientes de la fecha actual
    public function contarPacientesConFechaActual($id) {
        $fechaActual = date("Y-m-d");
        $statement=$this->PDO->prepare("SELECT COUNT(*) as total FROM paciente WHERE IdPsicologo = :idPsicologo AND DATE(FechaRegistro) = :fechaActual");
        $statement->bindParam(":idPsicologo",$id,PDO::PARAM_INT);
        $statement->bindParam(":fechaActual",$fechaActual,PDO::PARAM_STR);
        $result = $statement->execute();
    
        if ($result) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $total_registros = $row["total"];
            return $total_registros;
        } else {
            return 0;
        }
    }

    // Contar el total de citas de la fecha actual
    public function obtenerFechasCitasConFechaActual($id) {
        $fechaActual = date("Y-m-d");
        $statement=$this->PDO->prepare("SELECT FechaRegistro FROM cita WHERE IdPsicologo = :idPsicologo AND DATE(FechaRegistro) = :fechaActual");
        $statement->bindParam(":idPsicologo",$id,PDO::PARAM_INT);
        $statement->bindParam(":fechaActual",$fechaActual,PDO::PARAM_STR);
        $result = $statement->execute();
    
        if ($result) {
            $fechas = array();
    
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $fechas[] = $row["FechaRegistro"];
            }
    
            return $fechas;
        } else {
            return array();
        }
    }

    // Contar el total de citas de la hora actual
    public function obtenerHorasCitasConFechaActual($id) {
        $fechaActual = date("Y-m-d");
        $statement=$this->PDO->prepare("SELECT DATE_FORMAT(FechaRegistro, '%H:%i') as HoraMinutos FROM cita WHERE IdPsicologo = :idPsicologo AND DATE(FechaRegistro) = :fechaActual");
        $statement->bindParam(":idPsicologo",$id, PDO::PARAM_INT);
        $statement->bindParam(":fechaActual",$fechaActual, PDO::PARAM_STR);
        $result = $statement->execute();
    
        if ($result) {
            $fechas = array();
    
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $fechas[] = $row["FechaRegistro"];
            }
    
            return $fechas;
        } else {
            return array(); // Devolver un arreglo vacío si no se encontraron citas
        }
    }
    
    // Contar las citas con el nombre de pacientes y las horas
    public function obtenerCitasConNombrePacienteHoraMinutos($id) {
        $fechaActual = date("Y-m-d");
        $statement=$this->PDO->prepare("SELECT paciente.IdPaciente, paciente.NomPaciente, DATE_FORMAT(cita.FechaRegistro, '%H:%i') as HoraMinutos
                FROM cita
                INNER JOIN paciente ON cita.IdPaciente = paciente.IdPaciente
                WHERE cita.IdPsicologo = :idPsicologo AND DATE(cita.FechaRegistro) = :fechaActual");
        $statement->bindParam(":idPsicologo",$id, PDO::PARAM_INT);
        $statement->bindParam(":fechaActual",$fechaActual, PDO::PARAM_STR);
        $result = $statement->execute();
    
        if ($result) {
            $citas = array();
    
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $citas[] = $row;
            }
    
            return $citas;
        } else {
            return array(); // Devolver un arreglo vacío si no se encontraron citas
        }
    }
    //FUNCION PRA MEJORAR EL ORDEN DE LOS REGISTROS CITA
    public function obtenerCitasConNombrePacienteHoraMinutos2($id) {
        $fechaActual = date("Y-m-d");
        $statement = $this->PDO->prepare("SELECT paciente.IdPaciente, paciente.NomPaciente, 
            DATE_FORMAT(
                CASE
                    WHEN TIME(cita.FechaInicioCita) = '00:00:00' THEN TIME(cita.FechaRegistro)
                    ELSE TIME(cita.FechaInicioCita)
                END,
                '%H:%i'
            ) as HoraMinutos
            FROM cita
            INNER JOIN paciente ON cita.IdPaciente = paciente.IdPaciente
            WHERE cita.IdPsicologo = :idPsicologo AND DATE(cita.FechaInicioCita) = :fechaActual");
        $statement->bindParam(":idPsicologo", $id, PDO::PARAM_INT);
        $statement->bindParam(":fechaActual", $fechaActual, PDO::PARAM_STR);
        $result = $statement->execute();
    
        if ($result) {
            $citas = array();
    
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $citas[] = $row;
            }
    
            return $citas;
        } else {
            return array(); // Devolver un arreglo vacío si no se encontraron citas
        }
    }
     //Funcion para contar lel tipo de Atraccion:
     public function contarCitasConfirmadasConCanal($id) {
        $statement = $this->PDO->prepare("SELECT COUNT(*) as total FROM cita WHERE IdPsicologo = :idPsicologo  AND CanalCita = 'Cita Online'");
        $statement->bindParam(":idPsicologo", $id, PDO::PARAM_INT);
        $result = $statement->execute();
    
        if ($result) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $total_registros = $row["total"];
            return $total_registros;
        } else {
            return 0;
        }
    }

    public function contarCitasConfirmadasConCanal2($id) {
        $statement = $this->PDO->prepare("SELECT COUNT(*) as total FROM cita WHERE IdPsicologo = :idPsicologo  AND CanalCita = 'Marketing Directo'");
        $statement->bindParam(":idPsicologo", $id, PDO::PARAM_INT);
        $result = $statement->execute();
    
        if ($result) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $total_registros = $row["total"];
            return $total_registros;
        } else {
            return 0;
        }
    }

    
    public function contarCitasConfirmadasConCanal3($id) {
        $statement = $this->PDO->prepare("SELECT COUNT(*) as total FROM cita WHERE IdPsicologo = :idPsicologo  AND CanalCita = 'Referidos'");
        $statement->bindParam(":idPsicologo", $id, PDO::PARAM_INT);
        $result = $statement->execute();
    
        if ($result) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $total_registros = $row["total"];
            return $total_registros;
        } else {
            return 0;
        }
    }
    public function contarPacientesUltimoMes($id) {
        $fechaActual = date("Y-m-d");
        $fechaHaceUnMes = date("Y-m-d", strtotime("-1 month"));
        $statement=$this->PDO->prepare("SELECT COUNT(*) as total FROM paciente WHERE IdPsicologo = :idPsicologo AND DATE(FechaRegistro) BETWEEN :fechaHaceUnMes AND :fechaActual");
        $statement->bindParam(":idPsicologo",$id,PDO::PARAM_INT);
        $statement->bindParam(":fechaHaceUnMes", $fechaHaceUnMes,PDO::PARAM_STR);
        $statement->bindParam(":fechaActual",$fechaActual,PDO::PARAM_STR);
        $result = $statement->execute();

        if ($result) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $total_registros = $row["total"];
            return $total_registros;
        } else {
            return 0;
        }
    }

}
