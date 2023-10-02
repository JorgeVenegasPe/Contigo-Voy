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
    <link rel="stylesheet" href="../issets/css/paciente.css">
    <link rel="stylesheet" href="../issets/css/main.css">
  <link rel="icon" href="../Issets/images/contigovoyico.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Datos del Paciento</title>
</head>
<body>    
<div class="containerTotal">
<?php
    require_once '../Issets/views/Menu.php';
  ?> 
  <!----------- end of aside -------->
  <main class="animate__animated animate__fadeIn"> 
    <?php
    require_once '../Issets/views/Info.php';
    ?> 
    <div class="container-form">
      <div class="recent-updates">
        <form action="../Crud/Paciente/guardarAreaFamiliar.php" method="post">
        <h4><a href="RegPaciente.php" style="float: left;"><</a>Datos Familiares</h4>
        <br>
          <div style="display:flex; flex-direction:row; gap:70px;">
			      <div class="checkout-information">
			        <div class="input-group2" >
                <div class="input-group" style="display:none">
                  <h3 for="IdPaciente">Id Paciente</h3>
                  <div style="display: flex;gap:5px;">
                    <input id="IdPaciente" type="text" name="IdPaciente" class="input" required/>
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
                  <h3 for="NomPaciente">Nombre Paciente</h3>
                  <div style="display: flex; gap:5px;">
                    <input id="NomPaciente" type="text" name="NomPaciente" class="input" />
                    <a class="search nom"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                  </div>
                </div>
              </div>
			        <div class="input-group">
			        	<h3 for="Paciente" >Paciente</h3>
			        	<input id="Paciente" type="text" name="Paciente" class="input" readonly/>
			        </div>
			        <div class="input-group">
			        	<h3 for="NomMadre" >Nombre de la Madre</h3>
			        	<input id="NomMadre" type="text" name="NomMadre" class="input" placeholder="Aqui tu Nombre de la Madre" required/>
			        </div>
			        <div class="input-group">
			        	<h3 for="EstadoMadre" >Estado de la Madre</h3>
			        	<input id="EstadoMadre" type="text" name="EstadoMadre" class="input" placeholder="Aqui tu Nombre de la Madre" required/>
			        </div>
			        <div class="input-group">
			        	<h3 for="NomPadre" >Nombre del Padre</h3>
			        	<input type="text" id="NomPadre" name="NomPadre" placeholder="Aqui tu Nombre del Padre" required/>
			        </div>
			        <div class="input-group">
			        	<h3 for="EstadoPadre" >Estado de la Padre</h3>
			        	<input type="text" id="EstadoPadre" name="EstadoPadre" placeholder="Aqui tu Nombre del Padre" required/>
			        </div>
			        <div class="input-group">
			        	<h3 for="NomApoderado" >Nombre del Apoderado</h3>
			        	<input type="text" id="NomApoderado" name="NomApoderado" placeholder="Aqui tu Nombre del Padre" required/>
			        </div>
			        <div class="input-group">
			        	<h3 for="EstadoApoderado" >Estado de la Apoderado</h3>
			        	<input type="text" id="EstadoApoderado" name="EstadoApoderado" placeholder="Aqui tu Nombre del Padre" required/>
			        </div>
            </div>
            <div class="checkout-information">
			        <div class="input-group2" >
                <div class="input-group" >
                  <h3 for="CantHijos">Cantidad de Hijos</h3>
                    <input id="CantHijos" type="number" name="CantHijos" class="input" 
                          min="0" pattern="^[0-9]+" required />
                </div>
                <div class="input-group" >
                  <h3 for="CantHermanos">Cantidad de Hermanos</h3>
                    <input id="CantHermanos" type="number" name="CantHermanos" class="input" 
                          min="0" pattern="^[0-9]+" required />
                </div>
              </div>
			        <div class="input-group">
			        	<h3 for="IntegracionFamiliar">Integracion Familiar</h3>
			        	<textarea style="resize: none;height:100px; padding: 1em 1em;font-size: 14px;" type="text" id="IntegracionFamiliar" name="IntegracionFamiliar" placeholder="Integracion Familiar" required></textarea>
			        </div>
              <div class="input-group">
			        	<h3 for="HistorialFamiliar">Historial Familiar</h3>
			        	<textarea style="resize: none;height:100px; padding: 1em 1em;font-size: 14px;" type="text" id="HistorialFamiliar" name="HistorialFamiliar" placeholder="Historial Marital" required></textarea>
			        </div>
            </div>
			    </div>
          <br>
          <div class="button-container">
            <button id="submitButton" class="button">Registrar</button>
          </div>
		    </form>
      </div>
	  </div>
  </main>
  <script src="../issets/js/Dashboard.js"></script>
  </body>
<script>
$(document).ready(function() {
    $('.codigoaa').click(function() {
      var codigopac = $('#codigopac').val();
      var idPsicologo = <?php echo $_SESSION['IdPsicologo']; ?>;

      // Realizar la solicitud AJAX al servidor
      $.ajax({
        url: 'Fetch/fetch_paciente.php', // Archivo PHP que procesa la solicitud
        method: 'POST',
        data: { codigopac: codigopac, idPsicologo: idPsicologo },
        success: function(response) {
          if (response.hasOwnProperty('error')) {
            $('#Paciente').val(response.error);
            $('#IdPaciente').val('');
            $('#NomPaciente').val('');
            $('#correo').val('');
          } else {
            $('#Paciente').val(response.nombre);
            $('#NomPaciente').val(response.nom);
		        $('#IdPaciente').val(response.id);
		        $('#correo').val(response.correo);
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
      url: 'Fetch/fetch_pacienteNom.php', // Archivo PHP que procesa la solicitud
      method: 'POST',
      data: { NomPaciente: NomPaciente, idPsicologo: idPsicologo },
      success: function(response) {
        if (response.hasOwnProperty('error')) {
          $('#Paciente').val(response.error);
          $('#IdPaciente').val('');
          $('#codigopac').val('');
        } else {
          $('#Paciente').val(response.nombre);
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
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>


