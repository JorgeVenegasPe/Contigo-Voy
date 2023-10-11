<?php
session_start();
if (isset($_SESSION['NombrePsicologo'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="stylesheet" href="../issets/css/main.css">
    <link rel="stylesheet" href="../issets/css/citas.css">
    <link rel="icon" href="../Issets/images/contigovoyico.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Citas</title>
</head>
<body>
<div class="container">
    <?php
    require_once '../Issets/views/Menu.php';
    ?>
    <!----------- fin de aside -------->
  <main class="animate__animated animate__fadeIn">
    <?php
    require_once '../Issets/views/Info.php';
    require("../Controlador/Cita/ControllerCita.php");
    $obj=new usernameControlerCita();
    $rows=$obj->ver($_SESSION['IdPsicologo']);
    ?>
    <div>
        <form action="../Crud/Cita/guardarCita.php" method="post">
        <h4><a href="TablaCitas.php" style="float: left;color: #6B93F3;"><</a>Citas</h4>
        <br>
        <div class="checkout-information">
              <div class="input-group2">
                  <div class="input-group" style="display:none">
                  <h3 for="IdPaciente">Id Paciente <b style="color:red">*</b></h3>
                      <div style="display: flex; gap:5px;"> 
                          <input id="IdPaciente" type="text" name="IdPaciente"  required/>
                          <a class="search id"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                      </div>
                  </div>
                  <div class="input-group">
                    <h3 for="codigopac">Codigo Paciente <b style="color:red">*</b></h3>
                      <div style="display: flex; gap:5px;"> 
                          <input id="codigopac" type="text" name="codigopac" class="input" />
                          <a class="search codigoaa"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                      </div>
                  </div>
                  <div class="input-group">
                  <h3 for="NomPaciente">Nombre Paciente <b style="color:red">*</b></h3>
                      <div style="display: flex; gap:5px;">
                          <input id="NomPaciente" type="text" name="NomPaciente"  required/>
                          <a class="search nom"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                      </div>
                  </div>
              </div>
	            <div class="input-group" >
	    	        <h3 for="Paciente" >Paciente <b style="color:red">*</b></h3>
	    	        <input id="Paciente" type="text" name="Paciente"  readonly/>
	            </div>
	            <div style="display:none" class="input-group">
	    	        <h3 for="correo" >correo<b style="color:red">*</b></h3>
	    	        <input id="correo" type="text" name="correo"  readonly/>
	            </div>
	            <div  style="display:none" class="input-group">
	    	        <h3 for="telefono" >telefono<b style="color:red">*</b></h3>
	    	        <input id="telefono" type="text" name="telefono"  readonly/>
	            </div>
	            <div class="input-group">
	    	        <h3 for="MotivoCita">Motivo de la Consutla <b style="color:red">*</b></h3>
	    	        <textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="MotivoCita" name="MotivoCita"  required></textarea>
	            </div>
              <div class="input-group2">
                <div class="input-group" >
                  <h3 for="EstadoCita">Estado de la Cita <b style="color:red">*</b></h3>
                  <select style="width:136%" class="input" id="EstadoCita" name="EstadoCita"required>
                        <option value="">Seleccione un Estado</option>
                        <option value="Se requiere confirmacion">Se requiere confirmacion</option>
                        <option value="Confirmado">Confirmado</option>
                        <option value="Ausencia del paciente">Ausencia del paciente</option>
                    </select>
                </div>
                <div class="input-group" style="width:50%; margin-left: 65px;">
                    <h3 for="ColorFondo">Color de Cita <b style="color:red">*</b></h3>
                    <input type="color" value="#f38238" id="ColorFondo" name="ColorFondo" list="colorOptions">
                        <datalist id="colorOptions">
                          <option value="#b4d77b">Rojo</option>
                          <option value="#9274b3">Verde</option>
                          <option value="#f38238">Azul</option>
                        </datalist>
                </div>
              </div>
                <?php
                    /* FECHA LIMITE  */
                    date_default_timezone_set('America/Lima');
                    $fechamin = date("Y-m-d")
                ?>
                <div class="input-group2">
                    <div class="input-group" style="width:49%">
                        <h3 for="FechaInicioCita">Fecha de Cita<b style="color:red">*</b></h3>
                        <input  type="date" id="FechaInicioCita" name="FechaInicioCita" min="<?= $fechamin ?>" value="<?= $fechamin ?>">
                    </div>
                    <div class="input-group" style="width:49%">
                        <h3 for="HoraInicio">Hora de Cita <b style="color:red">*</b></h3>
                        <input type="time" id="HoraInicio" name="HoraInicio" />
                    </div>
                </div>
                <div class="input-group2">
                    <div class="input-group" style="width:49%">
                      <h3 for="TipoCita">Tipo de Cita <b style="color:red">*</b></h3>
                      <select class="input" id="TipoCita" name="TipoCita" required>
                            <option value="">Seleccione un Tipo </option>
                            <option value="Primera Visita">Primera Visita</option>
                            <option value="Visita de control">Visita de control</option>
                        </select>
                       </div>
                    <div class="input-group">
                        <h3 style="margin-left: 65px;" for="DuracionCita">Duracion <b style="color:red">*</b></h3>
                      <select style="margin-left: 65px; width:100px;" class="input" id="DuracionCita" name="DuracionCita" required>
                            <option value="5'">5'</option>
                            <option value="10'">10'</option>
                            <option value="15'">15'</option>
                            <option value="20'">20'</option>
                            <option value="30'">30'</option>
                            <option value="40'">40'</option>
                            <option value="45'">45'</option>
                            <option value="50'">50'</option>
                            <option value="60'">60'</option>
                            <option value="90'">90'</option>
                            <option value="120'">120'</option>
                        </select>
                    </div>
                </div>
	              <div class="input-group" style="display: none;">
	    	          <h3 for="FechaFin" >FechaFin <b style="color:red">*</b></h3>
	    	          <input id="FechaFin" type="text" name="FechaFin"  readonly/>
	              </div>
                <div class="input-group2">
                    <div class="input-group" style="width:58%">
                      <h3 for="CanalCita">Canal de Atraccion <b style="color:red">*</b></h3>
                      <select class="input" id="CanalCita" name="CanalCita" required>
                            <option value="">Seleccione una Atraccion</option>
                            <option value="Cita Online">Cita Online</option>
                            <option value="Marketing Directo">Marketing Directo</option>
                            <option value="Referidos">Referidos</option>
                        </select>
                    </div>
                    <div class="input-group" style="width:55%">
                      <h3 for="EtiquetaCita">Etiqueta <b style="color:red">*</b></h3>
                      <select class="input" id="EtiquetaCita" name="EtiquetaCita" required>
                            <option value="">Seleccione una Etiqueta</option>
                            <option value="Consulta">Consulta</option>
                            <option value="Familia Referida">Familia Referida</option>
                            <option value="Prioridad">Prioridad</option>
                        </select>
                    </div>
                </div>
                <div class="input-group" style="display: none">
                  <h3 for="IdPsicologo">IdPsicologo </h3>
                  <input type="text" id="IdPsicologo"  name="IdPsicologo" value="<?=$_SESSION['IdPsicologo']?>" placeholder="Ingrese algun Antecedente Medico" />
                </div>
              <br>
        </div>
            <br>
        <div class="button-container">
          <button id="submitButton" class="button">Finalizar</button>
        </div>
      </form>
    </div>
  </main>  
  <div id="notification" style="display: none;" class="notification">
      <p id="notification-text"></p>
      <span class="notification__progress"></span>
  </div>
</div>
<script src="../issets/js/Dashboard.js"></script>
<script>
//Buscador del paciente segun su id 
$(document).ready(function() {
    $('.codigoaa').click(function() {
      var codigopac = $('#codigopac').val();
      var idPsicologo = <?php echo $_SESSION['IdPsicologo']; ?>;

      // Realizar la solicitud AJAX al servidor
      $.ajax({
        url: '../Crud/Fetch/fetch_paciente.php', // Archivo PHP que procesa la solicitud
        method: 'POST',
        data: { codigopac: codigopac, idPsicologo: idPsicologo },
        success: function(response) {
          if (response.hasOwnProperty('error')) {
            $('#Paciente').val(response.error);
            $('#IdPaciente').val('');
            $('#NomPaciente').val('');
            $('#correo').val('');
            $('#telefono').val('');
          } else {
            $('#Paciente').val(response.nombre);
            $('#NomPaciente').val(response.nom);
		        $('#IdPaciente').val(response.id);
		        $('#correo').val(response.correo);
            $('#telefono').val(response.telefono);
          }
        },
        error: function() {
          $('#Paciente').val('Error al procesar la solicitud');
          $('#NomPaciente').val('');
          $('#IdPaciente').val('');
        }
      });
    });
  });

// Buscador paciente segun su nombre 
$(document).ready(function() {
  $('.nom').click(function() {
    var NomPaciente = $('#NomPaciente').val();
    var idPsicologo = <?php echo $_SESSION['IdPsicologo']; ?>;

    // Realizar la solicitud AJAX al servidor
    $.ajax({
      url: '../Crud/Fetch/fetch_pacienteNom.php', // Archivo PHP que procesa la solicitud
      method: 'POST',
      data: { NomPaciente: NomPaciente, idPsicologo: idPsicologo },
      success: function(response) {
        if (response.hasOwnProperty('error')) {
          $('#Paciente').val(response.error);
          $('#IdPaciente').val('');
          $('#codigopac').val('');
          $('#correo').val('');
          $('#telefono').val('');
        } else {
          $('#Paciente').val(response.nombre);
		      $('#IdPaciente').val(response.id);
		      $('#codigopac').val(response.codigopac);
          $('#correo').val(response.correo);
          $('#telefono').val(response.telefono);
        }
      },
      error: function() {
        $('#Paciente').val('Error al procesar la solicitud');
        $('#IdPaciente').val('');
        $('#codigopac').val('');
      }
    });
  });
});

        // Obtener elementos del formulario
    var fechaInicioInput = document.getElementById('FechaInicioCita');
    var horaInicioInput = document.getElementById('HoraInicio');
    var duracionInput = document.getElementById('DuracionCita');
    var fechaFinInput = document.getElementById('FechaFin');

    // Escuchar eventos de cambio en los campos relevantes
    fechaInicioInput.addEventListener('change', calcularFechaFin);
    horaInicioInput.addEventListener('change', calcularFechaFin);
    duracionInput.addEventListener('change', calcularFechaFin);

    // Función para calcular la fecha y hora de finalización
    function calcularFechaFin() {
        var fechaInicio = new Date(fechaInicioInput.value + 'T' + horaInicioInput.value);
        var duracion = parseInt(duracionInput.value);

        // Convertir la duración a milisegundos
        var duracionMs = duracion * 60000;

        // Calcular la fecha y hora de finalización
        var fechaFin = new Date(fechaInicio.getTime() + duracionMs);

        // Formatear la fecha y hora de finalización
        var fechaFinFormatted = formatDate(fechaFin) + ' ' + formatTime(fechaFin);

        fechaFinInput.value = fechaFinFormatted;
    }

    // Función para formatear la fecha en formato "YYYY-MM-DD"
    function formatDate(date) {
        var year = date.getFullYear();
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var day = String(date.getDate()).padStart(2, '0');
        return year + '-' + month + '-' + day;
    }

    // Función para formatear la hora en formato "HH:MM"
    function formatTime(date) {
        var hours = String(date.getHours()).padStart(2, '0');
        var minutes = String(date.getMinutes()).padStart(2, '0');
        return hours + ':' + minutes;
    }

    window.addEventListener('DOMContentLoaded', (event) => {
    const notification = document.getElementById('notification');
    const notificationText = document.getElementById('notification-text');

    const urlParams = new URLSearchParams(window.location.search);
    const enviado = urlParams.get('enviado');

    if (enviado === 'true') {
        notification.style.display = 'block';
        notificationText.textContent = 'Enviado Correctamente ✔️';
        history.replaceState(null, null, window.location.pathname);
    }
});
</script>
</body>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>
