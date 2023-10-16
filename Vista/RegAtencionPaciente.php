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
<style>

  @media (max-width: 1704px) {
  .checkout-information {
      background: #8FBBC8;
      width: 48%;
      height: 100%;
      border-radius: var(--card-border-radius);
      padding: var(--card-padding);
      box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: all 300ms ease;
  }


  .checkout-information, .input-group {
      display: flex;
      flex-direction: column;
      gap: 3px;
  }
  form {
    margin-top: -2%;
}
.button-container {
    display: flex;
    gap: 20px;
    justify-content: flex-end;
    margin-top: -3%;
}
}
</style>
<body>    
<div class="container">
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
        <form action="../Crud/Paciente/guardarAtencPaciente.php" method="post">
        <h4><a href="RegPaciente.php" style="float: left;color: #6B93F3;"><</a>Atencion al Paciente</h4>
        <br>
        <div style="display:flex; flex-direction:row; gap:70px;">
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
              <div class="input-group" >
                <h3 for="NomPaciente">Nombre Paciente </h3>
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
            <div class="input-group2">
              <div class="input-group">
         	      <h3 for="MotivoConsulta">Motivo de la Consulta</h3>
				        <input id="MotivoConsulta" type="text" name="MotivoConsulta" class="input" required/>
              </div>
              <div class="input-group">
				        <h3 for="FormaContacto">Forma de Contacto</h3>
				        <input id="FormaContacto" type="text" name="FormaContacto" class="input" required/>
				      </div>
            </div>
            <div class="input-group">
				      	<h3 for="Diagnostico">Diagnostico</h3>
				      	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="Diagnostico" name="Diagnostico" placeholder="Ingrese su diagnostico" required></textarea>
				    </div>
            <div class="input-group">
				      	<h3 for="Tratamiento">Tratamiento</h3>
				      	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="Tratamiento" name="Tratamiento" placeholder="Tratamiento" required></textarea>
				    </div>
          </div>
          <div class="checkout-information">
            <div class="input-group">
				      	<h3 for="Observacion">Observacion</h3>
				      	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="Observacion" name="Observacion" placeholder="Observacion" required></textarea>
				    </div>
            <div class="input-group">
				      	<h3 for="UltimosObjetivos">Ultimos Objetivo / Objetivo alcanzado </h3>
				      	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="UltimosObjetivos" name="UltimosObjetivos" placeholder="Observacion" required></textarea>
				    </div>
            <div class="input-group2">
              <div class="input-group" >
                <h3 for="dsm5 ">DSM5</h3>
                <div style="display: flex;gap:5px;">
                  <input id="dsm5" type="text" name="dsm5" class="input" />
                    <a class="search btndsm5"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                </div>
              </div>
              <div class="input-group" >
                <h3 for="cea10">CEA10</h3>
                <div style="display: flex;gap:5px;">
                  <input id="cea10"  type="text" name="cea10" class="input" />
                    <a class="search btncea10"><span style="font-size:4em" class="material-symbols-sharp">search</span></a>
                </div>
              </div>
            </div>
            <div class="input-group" style="flex-direction: column;    width: 100%;">
                <h3 for="DescripcionEnfermedad">Clasificacion</h3>
                <div style="display: flex; gap:5px;">
                  <input id="DescripcionEnfermedad" type="text" name="DescripcionEnfermedad" class="input" />
                </div>
            </div>
            <div class="input-group" style="display: none;">
					      <h3 for="IdEnfermedad" >IdEnfermedad</h3>
					      <input id="IdEnfermedad" type="text" name="IdEnfermedad" class="input" readonly/>
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
// Buscador de la dsm5
  $(document).ready(function() {
    $('.btndsm5').click(function() {
      var dsm5 = $('#dsm5').val();
      $.ajax({
        url: '../Crud/Fetch/fetch_dsm5.php',
        method: 'POST',
        data: { dsm5: dsm5 },
        success: function(response) {
          if (response.error) {
            $('#DescripcionEnfermedad').val('No existe esa enfermedad');
            $('#cea10').val('');
            $('#IdEnfermedad').val('');
          } else {
            $('#DescripcionEnfermedad').val(response.nombre);
		        $('#cea10').val(response.cea10);
		        $('#IdEnfermedad').val(response.id);
          }
        },
        error: function() {
          $('#DescripcionEnfermedad').val('Error al procesar la solicitud');
          $('#cea10').val('');
          $('#IdEnfermedad').val('');
        }
      });
    });
  });

// Buscador de la cea10
  $(document).ready(function() {
    $('.btncea10').click(function() {
      var cea10 = $('#cea10').val();
      $.ajax({
        url: '../Crud/Fetch/fetch_cea10.php',
        method: 'POST',
        data: { cea10: cea10 },
        success: function(response) {
          if (response.error) {
            $('#DescripcionEnfermedad').val('No existe esa enfermedad');
            $('#dsm5').val('');
            $('#IdEnfermedad').val('');
          } else {
            $('#DescripcionEnfermedad').val(response.nombre);
            $('#dsm5').val(response.dsm5);
		        $('#IdEnfermedad').val(response.id);
          }
        },
        error: function() {
          $('#DescripcionEnfermedad').val('Error al procesar la solicitud');
          $('#dsm5').val('');
          $('#IdEnfermedad').val('');
        }
      });
    });
  });
  
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
      url: '../Crud/Fetch/fetch_pacienteNom.php', // Archivo PHP que procesa la solicitud
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