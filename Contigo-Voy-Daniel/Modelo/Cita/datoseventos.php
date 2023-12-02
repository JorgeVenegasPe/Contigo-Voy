<?php
header('Content-Type: application/json');

require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/conexion/conexion.php");
        $con=new conexion();
        $PDO=$con->conexion();

switch ($_GET['accion']) {

  case 'listar':
    try {
      $IdPsicologo = $_GET['idPsicologo']; 
      $query = "SELECT c.IdCita as id,
                c.IdPaciente as idpaciente,
                p.NomPaciente AS textColor, 
                CONCAT(p.NomPaciente, ' ', p.ApPaterno, ' ', p.ApMaterno) AS title,
                c.FechaInicioCita AS start,
                c.DuracionCita AS duracion,
                c.MotivoCita as motivo,
                c.EstadoCita as estado,
                c.TipoCita as tipo,
                c.ColorFondo AS backgroundColor,
                c.CanalCita as canal,
                c.EtiquetaCita as etiqueta
      FROM cita c
      INNER JOIN paciente p ON c.IdPaciente = p.IdPaciente
      WHERE c.IdPsicologo = :IdPsicologo"; 
      
      $statement = $PDO->prepare($query);
      $statement->bindParam(':IdPsicologo', $IdPsicologo, PDO::PARAM_INT);
      $statement->execute();
      
      $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($resultado);
    } catch(PDOException $e) {
      echo "Error al listar citas: " . $e->getMessage();
      die();
    }
    break;
  
  case 'agregar':
    try {
      $query = "INSERT INTO cita (IdPaciente, FechaInicioCita, DuracionCita, MotivoCita, EstadoCita, IdPsicologo, TipoCita, ColorFondo, CanalCita, EtiquetaCita) VALUES
                (:IdPaciente, :FechaInicioCita, :DuracionCita, :MotivoCita, :EstadoCita, :IdPsicologo, :TipoCita, :ColorFondo, :CanalCita, :EtiquetaCita)";
      $statement =$PDO->prepare($query);
      $statement->bindParam(':IdPaciente', $_POST['idpaciente']);
      $statement->bindParam(':FechaInicioCita', $_POST['inicio']);
      $statement->bindParam(':DuracionCita', $_POST['duracion']);
      $statement->bindParam(':MotivoCita', $_POST['motivo']);
      $statement->bindParam(':EstadoCita', $_POST['estado']);
      $statement->bindParam(':IdPsicologo', $_POST['idpsicologo']);
      $statement->bindParam(':TipoCita', $_POST['tipo']);
      $statement->bindParam(':ColorFondo', $_POST['backgroundColor']);
      $statement->bindParam(':CanalCita', $_POST['canal']);
      $statement->bindParam(':EtiquetaCita', $_POST['etiqueta']);
      $statement->execute();
      echo json_encode(true);
    } catch(PDOException $e) {
      echo "Error al agregar cita: " . $e->getMessage();
      die();
    }
    break;

  case 'modificar':
    try {
      $query = "UPDATE cita SET 
                FechaInicioCita = :FechaInicioCita,
                DuracionCita = :DuracionCita,
                MotivoCita = :MotivoCita,
                EstadoCita = :EstadoCita,
                TipoCita = :TipoCita,
                ColorFondo = :ColorFondo,
                CanalCita = :CanalCita,
                EtiquetaCita = :EtiquetaCita
                WHERE IdCita = :IdCita";
      $statement =$PDO->prepare($query);
      $statement->bindParam(':FechaInicioCita', $_POST['inicio']);
      $statement->bindParam(':DuracionCita', $_POST['duracion']);
      $statement->bindParam(':MotivoCita', $_POST['motivo']);
      $statement->bindParam(':EstadoCita', $_POST['estado']);
      $statement->bindParam(':TipoCita', $_POST['tipo']);
      $statement->bindParam(':ColorFondo', $_POST['backgroundColor']);
      $statement->bindParam(':CanalCita', $_POST['canal']);
      $statement->bindParam(':EtiquetaCita', $_POST['etiqueta']);
      $statement->bindParam(':IdCita', $_POST['id']);
      $statement->execute();
      echo json_encode(true);
    } catch(PDOException $e) {
      echo "Error al modificar cita: " . $e->getMessage();
      die();
    }
    break;

  case 'borrar':
    try {
      $query = "DELETE FROM cita WHERE IdCita = :IdCita";
      $statement = $PDO->prepare($query);
      $statement->bindParam(':IdCita', $_POST['id']);
      $statement->execute();
      echo json_encode(true);
    } catch(PDOException $e) {
      echo "Error al borrar cita: " . $e->getMessage();
      die();
    }
    break;
}

?>
