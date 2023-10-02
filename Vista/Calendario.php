<?php
session_start();
if (isset($_SESSION['NombrePsicologo'])){
?>
<!DOCTYPE html>
<html lang="en" dir="ltr"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Issets/Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../Issets/css/calendario.css">
    <link rel="stylesheet" href="../Issets/Bootstrap/datatables.min.css">
    <link rel="stylesheet" href="../Issets/Bootstrap/bootstrap-clockpicker.css">
    <link rel="stylesheet" href="../Issets/fullcalendar/main.css">
    <link rel="stylesheet" href="../Issets/css/main.css">
    <link rel="icon" href="../Issets/images/contigovoyico.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> 
    <script src="../Issets/Bootstrap/jquery-3.6.0.min.js"></script>
    <script src="../Issets/Bootstrap/popper.min.js"></script>
    <script src="../Issets/Bootstrap/bootstrap.min.js"></script>
    <script src="../Issets/Bootstrap/datatables.min.js"></script>
    <script src="../Issets/Bootstrap/bootstrap-clockpicker.js"></script> 
    <script src="../Issets/js/moment-with-locales.js"></script>
    <script src="../Issets/fullcalendar/main.js"></script>
    <title>Calendario</title>
</head>
<body>
<div class="container-calendario">
<?php
    require_once '../Issets/views/Menu.php';
  ?> 
  <!----------- end of aside -------->
  <main >
    <?php
    require_once '../Issets/views/Info.php';
    ?> 
    <!----------- Calendario ------------------>
    <div class="container-fluid2">
      <h4 style="text-align:center">Calendario de Citas</h4>
      <div id="Calendario1"></div>
    </div>

    <!-- Formulario de Eventos -->
    <div class="modal fade" id="FormularioEventos" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a  class="close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
          <div class="modal-body">
            <input type="hidden" id="Id">
              <div class="row g-3">
                <div class="col-sm" style="display: none;">
                  <label class="form-label">Id Paciente</label>
                <div class="input-group mb-3">
                  <input type="text" id="IdPaciente" class="form-control">
                  <button type="button" class="id" id="button-addon2"><span style="font-size:2.2em" class="material-symbols-sharp idpaciente">search</span></button>
                </div>
                </div>
                <div class="col-sm">
                  <label class="form-label">Codigo Paciente</label>
                <div class="input-group mb-3">
                  <input type="text" id="codigopac" class="form-control">
                  <button type="button" class="cod" id="button-addon2"><span style="font-size:2.2em" class="material-symbols-sharp idpaciente">search</span></button>
                </div>
                </div>
                <div class="col-sm">
                  <label class="form-label">Nombre Paciente</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="NomPaciente">
                    <button type="button" class="nom" id="button-addon2"><span style="font-size:2.2em" class="material-symbols-sharp nom">search</span></button>
                  </div>
                </div>
              </div>
              <br>
              <div class="form-row">
                <div class="form-group">
                  <label for="TituloCompleto">Paciente</label>
                  <input type="text" id="TituloCompleto" name="TituloCompleto" class="form-control" >
                </div>
              </div>
              <div style="display:none" class="form-row">
			        	<label for="correo" >correo<b style="color:red">*</b></label>
			        	<input id="correo" type="text" name="correo"  readonly/>
			        </div>
              <br>
              <div class="form-row">
                <div class="form-group">
                  <label for="">Motivo de la Consulta</label>
                  <textarea id="MotivoCita"  class="form-control" style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="MotivoCita" name="MotivoCita"  required></textarea>
                </div>
              </div>
              <br>
              <div class="row g-3">
                <div class="col-sm">
                  <label class="form-label" >Estado de la cita</label>
                  <select class="form-select" id="EstadoCita" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                    <option value="Se requiere confirmacion">Se requiere confirmacion</option>
                    <option value="Confirmado">Confirmado</option>
                    <option value="Ausencia del paciente">Ausencia del paciente</option>
                  </select>
                </div>
                <div class="col-sm">
                  <label class="form-label" >Color de Cita</label>
                  <input type="color" class="form-control"value="#f38238" id="backgroundColor" name="backgroundColor" list="colorOptions">
                    <datalist id="colorOptions">
                      <option value="#b4d77b">Rojo</option>
                      <option value="#9274b3">Verde</option>
                      <option value="#f38238">Azul</option>
                    </datalist>
                </div>
              </div>
              <br>
              <div class="row g-3">
                <div class="col-sm">
                  <label class="form-label" >Fecha de Cita</label>
                  <div class="input-group" data-autoclose="true">
                    <input type="date" id="FechaInicio" name="FechaInicio" value="" class="form-control">
                  </div>
                </div>
                <div class="col-sm">
                  <label class="form-label" >Hora Cita</label>
                  <div class="input-group clockpicker" data-autoclose="true">
                    <input type="text" id="HoraInicio" name="HoraInicio" value="" class="form-control" autocomplete="off">
                  </div>
                </div>
              </div>
              <br>
              <div class="row g-3">
                <div class="col-sm">
                  <label class="form-label" >Tipo Cita</label>
  		            <select class="form-select" id="TipoCita" name="TipoCita" required>
                    <option selected>Seleccionar</option>
                    <option value="Primera Visita">Primera Visita</option>
                    <option value="Visita de control">Visita de control</option>
                  </select>
                </div>
                <div class="col-sm">
                  <label class="form-label">Duracion</label>
  		            <select class="form-select" id="DuracionCita" name="DuracionCita" required>
                    <option selected>Seleccionar</option>
                    <option value="5">5'</option>
                    <option value="10">10'</option>
                    <option value="15">15'</option>
                    <option value="20">20'</option>
                    <option value="30">30'</option>
                    <option value="40">40'</option>
                    <option value="45">45'</option>
                    <option value="50">50'</option>
                    <option value="60">60'</option>
                    <option value="90">90'</option>
                    <option value="120">120'</option>
                  </select>
                </div>
              </div>
              <br>
              <div class="row g-3">
                <div class="col-sm">
                  <label class="form-label" >Canal de Atraccion</label>
  		              <select class="form-select" id="CanalCita" name="CanalCita" required>
                      <option selected>Seleccionar</option>
                      <option value="Cita Online">Cita Online</option>
                      <option value="Marketing Directo">Marketing Directo</option>
                      <option value="Referidos">Referidos</option>
                    </select>
                </div>
                <div class="col-sm">
                  <label class="form-label" >Etiqueta</label>
  		            <select class="form-select" id="EtiquetaCita" name="EtiquetaCita" required>
                    <option selected>Seleccionar</option>
                    <option value="Consulta">Consulta</option>
                    <option value="Familia Referida">Familia Referida</option>
                    <option value="Prioridad">Prioridad</option>
                  </select>
                </div>
                <div class="input-group" style="display: none">
    	              <h3 for="IdPsicologo">IdPsicologo </h3>
    	              <input type="text" id="IdPsicologo"  name="IdPsicologo" value="<?=$_SESSION['IdPsicologo']?>" placeholder="Ingrese algun Antecedente Medico" />
    	          </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="BotonAgregar" class="btn btn-success">Agregar</button>
            <button type="button" id="BotonModificar" class="btn btn-success">Modificar</button>
            <button type="button" id="BotonBorrar" class="btn btn-success">Borrar</button>
            <button type="button" id="cancelarr" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
    </main>
    </div>



    <script src="../issets/js/Dashboard.js"></script>
    <script>
document.addEventListener("DOMContentLoaded", function(){
    $('.clockpicker').clockpicker();

    let calendario1 = new FullCalendar.Calendar(document.getElementById('Calendario1'),{
      droppable: true,
      height: 850,
      locale: 'es',
      headerToolbar:{
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      editable: true,
      events: {
    url: '../Modelo/Cita/datoseventos.php',
    method: 'GET',
    extraParams: {
      accion: 'listar',
      idPsicologo: <?=$_SESSION['IdPsicologo']?>,
    },
    failure: function() {
      alert('Error al cargar los eventos');
    }
  },
      dateClick: function(info){
        limpiarFormulario();
        $('#BotonAgregar').show();
        $('#BotonModificar').hide();
        $('#BotonBorrar').hide();

        if (info.allDay) {
          $('#FechaInicio').val(info.dateStr);
          $('#FechaFin').val(info.dateStr);
        }else{
          let fechaHora = info.dateStr.split("T");
          $('#FechaInicio').val(fechaHora[0]);
          $('#FechaFin').val(fechaHora[0]);
          $('#HoraInicio').val(fechaHora[1].substring(0,5));
        }
        $("#FormularioEventos").modal('show');
      },
      eventClick: function(info) {
        $('#BotonAgregar').hide();
        $('#BotonModificar').show();
        $('#BotonBorrar').show();
        $('#Id').val(info.event.id);
        $('#IdPaciente').val(info.event.extendedProps.idpaciente);
        $('#NomPaciente').val(info.event.textColor);
        $('#TituloCompleto').val(info.event.title);
        $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
        $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
        $('#DuracionCita').val(info.event.extendedProps.duracion);
        $('#MotivoCita').val(info.event.extendedProps.motivo);
        $('#EstadoCita').val(info.event.extendedProps.estado);
        $('#TipoCita').val(info.event.extendedProps.tipo);
        $('#CanalCita').val(info.event.extendedProps.canal);
        $('#EtiquetaCita').val(info.event.extendedProps.etiqueta);
        $('#backgroundColor').val(info.event.backgroundColor);
        $("#FormularioEventos").modal('show');
      },
      eventResize: function(info){
        $('#Id').val(info.event.id);
        $('#IdPaciente').val(info.event.extendedProps.idpaciente);
        $('#NomPaciente').val(info.event.textColor);
        $('#TituloCompleto').val(info.event.title);
        $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
        $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
        $('#DuracionCita').val(info.event.extendedProps.duracion);
        $('#MotivoCita').val(info.event.extendedProps.motivo);
        $('#EstadoCita').val(info.event.extendedProps.estado);
        $('#TipoCita').val(info.event.extendedProps.tipo);
        $('#CanalCita').val(info.event.extendedProps.canal);
        $('#EtiquetaCita').val(info.event.extendedProps.etiqueta);
        $('#backgroundColor').val(info.event.backgroundColor);
        let registro = recuperarDatosFormulario();
        modificarRegistro(registro);
      },
      eventDrop: function(info){
        $('#Id').val(info.event.id);
        $('#IdPaciente').val(info.event.extendedProps.idpaciente);
        $('#NomPaciente').val(info.event.textColor);
        $('#TituloCompleto').val(info.event.title);
        $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
        $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
        $('#DuracionCita').val(info.event.extendedProps.duracion);
        $('#MotivoCita').val(info.event.extendedProps.motivo);
        $('#EstadoCita').val(info.event.extendedProps.estado);
        $('#TipoCita').val(info.event.extendedProps.tipo);
        $('#CanalCita').val(info.event.extendedProps.canal);
        $('#EtiquetaCita').val(info.event.extendedProps.etiqueta);
        $('#backgroundColor').val(info.event.backgroundColor);
        let registro = recuperarDatosFormulario();
        modificarRegistro(registro);
      },
    });   
    calendario1.render();
    //Eventos de botones de la aplicacion
    $('#BotonAgregar').click(function() {
      let registro = recuperarDatosFormulario();
      agregarRegistro(registro);
      $('#FormularioEventos').modal('hide');
    });

    $('#BotonModificar').click(function(){
      let registro = recuperarDatosFormulario();
      modificarRegistro(registro);
      $('#FormularioEventos').modal('hide');
    });

    $('#BotonBorrar').click(function(){
      let registro = recuperarDatosFormulario();
      borrarRegistro(registro);
      $('#FormularioEventos').modal('hide');
    });


    //funciones para comunicarse con el servidor AJAX!
    function agregarRegistro(registro) {
      $.ajax({
        type: 'POST',
        url: '../Modelo/Cita/datoseventos.php?accion=agregar',
        data: registro,
        success: function(msg){
          enviarCorreo(registro);
          calendario1.refetchEvents();
        },
        error: function(error) {
          alert("Hubo un error al agregar el evento: " + error);
        }
      });
    }

    function modificarRegistro(registro){
      $.ajax({
        type: 'POST',
        url: '../Modelo/Cita/datoseventos.php?accion=modificar',
        data: registro,
        success: function(msg){
          calendario1.refetchEvents();
        },
        error: function(error) {
          alert("Hubo un error al modificar el evento: " + error);
        }
      });
    }

    function borrarRegistro(registro){
      $.ajax({
        type: 'POST',
        url: '../Modelo/Cita/datoseventos.php?accion=borrar',
        data: registro,
        success: function(msg){
          calendario1.refetchEvents();
        },
        error: function(error) {
          alert("Hubo un error al borrar el evento: " + error);
        }
      });
    }

    function enviarCorreo(registro) {
      $.ajax({
        type: 'POST',
        url: 'Fetch/enviar_correo.php',
        data: registro,
        success: function(response) {
          // Manejar la respuesta del servidor después de enviar el correo
          console.log(response);
        },
        error: function(error) {
          // Manejar el error en caso de que falle el envío del correo
          console.log("Hubo un error al enviar el correo: " + error);
        }
      });
    }
    //funciones que interactuan con el FormularioEventos

    function limpiarFormulario(){
      $('#Id').val('');
      $('#IdPaciente').val('');
      $('#Titulo').val('');
      $('#TituloCompleto').val('');
      $('#FechaInicio').val('');
      $('#DuracionCita').val('Seleccionar');
      $('#MotivoCita').val('');
      $('#EstadoCita').val('Seleccionar');
      $('#TipoCita').val('Seleccionar');
      $('#backgroundColor').val('#f38238');
      $('#CanalCita').val('Seleccionar');
      $('#EtiquetaCita').val('Seleccionar');
    }

    function recuperarDatosFormulario(){
      let registro = {
        id: $('#Id').val(),
        idpaciente: $('#IdPaciente').val(),
        titulo: $('#Titulo').val(),
        TituloCompleto: $('#TituloCompleto').val(),
        FechaInicio: $('#FechaInicio').val(),
        HoraInicio: $('#HoraInicio').val(),
        inicio: $('#FechaInicio').val() + ' ' + $('#HoraInicio').val(),
        duracion: $('#DuracionCita').val(),
        motivo: $('#MotivoCita').val(),
        idpsicologo: $('#IdPsicologo').val(),
        estado: $('#EstadoCita').val(),
        tipo: $('#TipoCita').val(),
        backgroundColor: $('#backgroundColor').val(),
        canal: $('#CanalCita').val(),
        etiqueta: $('#EtiquetaCita').val(),
        correo: $('#correo').val()
      }
      return registro;
    }
});


  //Buscador del paciente segun su id 
  $(document).ready(function() {
    $('.cod').click(function() {
      var codigopac = $('#codigopac').val();
      var idPsicologo = <?php echo $_SESSION['IdPsicologo']; ?>;

      // Realizar la solicitud AJAX al servidor
      $.ajax({
        url: 'Fetch/fetch_paciente.php', // Archivo PHP que procesa la solicitud
        method: 'POST',
        data: { codigopac: codigopac, idPsicologo: idPsicologo },
        success: function(response) {
          if (response.hasOwnProperty('error')) {
            $('#TituloCompleto').val(response.error);
            $('#IdPaciente').val('');
            $('#NomPaciente').val('');
            $('#correo').val('');
          } else {
            $('#TituloCompleto').val(response.nombre);
            $('#NomPaciente').val(response.nom);
		        $('#IdPaciente').val(response.id);
		        $('#correo').val(response.correo);
          }
        },
        error: function() {
          $('#TituloCompleto').val('Error al procesar la solicitud');
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
      url: 'Fetch/fetch_pacienteNom.php', // Archivo PHP que procesa la solicitud
      method: 'POST',
      data: { NomPaciente: NomPaciente, idPsicologo: idPsicologo },
      success: function(response) {
        if (response.hasOwnProperty('error')) {
          $('#TituloCompleto').val(response.error);
          $('#IdPaciente').val('');
          $('#codigopac').val('');
        } else {
          $('#TituloCompleto').val(response.nombre);
		      $('#IdPaciente').val(response.id);
		      $('#codigopac').val(response.codigopac);
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
    </script>
  </body>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>
