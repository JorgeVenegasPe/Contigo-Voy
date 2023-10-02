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
    <link rel="stylesheet" href="../Issets/css/citas.css">
    <link rel="stylesheet" href="../Issets/css/main.css">
    <link rel="icon" href="../Issets/images/contigovoyico.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Citas</title>
</head>
<style>
    table {
    width: 100%;
    border-collapse: separate; 
    border-spacing: 0 10px; 
    max-height: 35%;
    
}
</style>
<body>
<?php
    require("../Controlador/Cita/ControllerCita.php");
    $obj=new usernameControlerCita();
    $rowscita=$obj->contarRegistrosEnCitas($_SESSION['IdPsicologo']);
    $rows=$obj->ver($_SESSION['IdPsicologo']);
?>
<div class="containerTotal">
    <?php
    require_once '../Issets/views/Menu.php';
    ?>
    <!----------- fin de aside -------->
    <main class="animate__animated animate__fadeIn">
    <?php
    require_once '../Issets/views/Info.php';
    ?>
    <h2 style="color: #49c691;">Lista de Citas</h2>
    <div class="recent-updates" style="display:flex; flex-direction: row; gap:20px; align-items: center; padding: 10px 0px 0px 10px">
        <span style="font-size: 15px;color: #6a90f1;">
        <b style="font-size: 25px;color: #6a90f1;"><?= $rowscita ?></b> pacientes </span>
        <div class="input-group">
            <input type="text" style="background-color: White;" id="myInput" placeholder="Buscar" class="input" required></input>
        </div>
        <a class="button" style="padding:10px 30px; font-size:10px;" href="RegPaciente.php">
            <span class="material-symbols-sharp">add</span>Agregar Cita
        </a>
        <button type="button" class="button-eliminar" id="eliminarSeleccionados" style="display: none;">Eliminar</button>
    </div>
        <div class="recent-citas">
            <table>
                <?php
                $rowsPerPage = 7;
                if (is_array($rows) && count($rows) > 0) {
                    $totalRows = count($rows);
                    $totalPages = ceil($totalRows / $rowsPerPage);
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $startIndex = ($currentPage - 1) * $rowsPerPage;
                    $endIndex = $startIndex + $rowsPerPage;
                }
                
                ?>
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkboxPrincipal" class="checkbox-principal"></th>
                        <th>Paciente</th>
                        <th>Codigo</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th>Fecha de Inicio</th>
                        <th>Duracion</th>
                        <th ></th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php if ($rows) :?>
                        <?php foreach ($rows as $row): ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="checkbox" id="checkbox<?=$row[0]?>" value="<?=$row[0]?>">
                                </td>
                                <td style="padding: 20px;"><?=$row[1]?></td>
                                <td><?=$row[11]?></td>
                                <td><?=$row[2]?></td>
                                <td><?=$row[3]?></td>
                                <td><?=$row[4]?></td>
                                <td style="color:green"><?=$row[5]?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="dropbtn"><span class="material-symbols-sharp">more_vert</span></button>
                                    <div class="dropdown-content">
                                        <a type="button" class="btne" onclick="openModalEliminar('<?=$row[0]?>')">
                                            <span class="material-symbols-outlined">delete</span>
                                            <p>Eliminar</p>
                                        </a>
                                        <a type="button" class="btnm" onclick="openModal('<?=$row[0]?>')">
                                            <span class="material-symbols-outlined"> edit</span>
                                            <p>Editar</p>
                                        </a>
                                    </div>
                                </td>
                                <!-- <td class="acct">
                                    <a type="button" class="btne" onclick="openModalEliminar('')">
                                        <span style="color:red" class="material-symbols-sharp">delete</span>
                                    </a>
                                </td>
                                <td class="acct">
                                    <a type="button" class="btnm" onclick="openModal('')">
                                    <span style="color:green"class="material-symbols-sharp">edit</span>
                                    </a>
                                </td>   -->
                            </tr>
                            <?php
                            $user=$obj->show($row[0]);
                            ?>
                            <!-- Modal para eliminacion -->
                            <div id="modalEliminar<?=$row[0]?>" class="modal">
                                <div class="containerModalEliminar">
                                    <a href="#" class="close" style="margin-right:20px" onclick="closeModalEliminar('<?=$row[0]?>')">&times;</a>
                                    <form class="form" style="margin-top: -10px;" autocomplete="off" method="post">
                                        <h2 class="title2" value="<?=$user[0]?>">Eliminar Cita</h2>
                                        <br>    
                                        <label class="Alertas" for="" value="<?=$user[0]?>">¿Estas seguro de eliminar esta cita?</label>

                                        <div class="input-group">
                                            <div>
                                            <br>
                                            <a class="ButtonEliminar" style="margin-left: 18em;" href="../Crud/Cita/eliminarCita.php?id=<?=$row[0]?>">Eliminar</a>
                                            </div>
                                        </div>
                                        <br>
                                    </form>
                                </div>
                            </div>
                            <!-- Modal para modificacion -->
                            <div id="modal<?=$row[0]?>" class="modal">
                                <div class="containerModal">
                                    <a href="#" class="close" onclick="closeModal('<?=$row[0]?>')">&times;</a>
                                    <form action="../Crud/Cita/ModificarCita.php"style="margin-top: -20px;"  method="post" >
                                        <h2 >Formulario Cita de <?=$row[1]?></h2>
                                        <input style="display:none" type="text" value="<?=$user['id']?>">
                                        <div class="input-group">
                                            <label style="display:none" class="labelModal" for="IdCita">IdCita</label>
                                            <input style="display:none" type="text" id="IdCita" name="IdCita" value="<?=$user['id']?>"/>
                                            <input style="display:none" type="text" id="Paciente" name="Paciente" value="<?=$row[1]?>"/>
                                        </div>
                                        <div class="input-group">
		    	                            <h3 for="MotivoCita">Motivo de la Consutla <b style="color:red">*</b></h3>
		    	                            <textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="MotivoCita" name="MotivoCita"  required><?=$user['MotivoCita']?></textarea>
		                                </div>
                                        <div class="input-group2">
  	                                        <div class="input-group" >
  		                                        <h3 for="EstadoCita">Estado de la Cita <b style="color:red">*</b></h3>
  		                                        <select class="input" id="EstadoCita" name="EstadoCita" required>
                                                    <option value="Se requiere confirmacion" <?php if ($user['EstadoCita'] === "Se requiere confirmacion") echo "selected"; ?>>Se requiere confirmacion</option>
                                                    <option value="Confirmado" <?php if ($user['EstadoCita'] === "Confirmado") echo "selected"; ?>>Confirmado</option>
                                                    <option value="Ausencia del paciente" <?php if ($user['EstadoCita'] === "Ausencia del paciente") echo "selected"; ?>>Ausencia del paciente</option>
                                                </select>
  	                                        </div>
		                                    <div style="display:none" class="input-group">
		    	                                <h3 for="correo" >correo<b style="color:red">*</b></h3>
		    	                                <input id="correo" type="text" value="<?=$user['Email']?>" name="correo"  readonly/>
		                                    </div>
                                            <div class="input-group" style="width:40%">
                                                <h3 for="ColorFondo">Color de Cita <b style="color:red">*</b></h3>
                                                <input type="color" value="#f38238" id="ColorFondo"  value="<?=$user['ColorFondo']?>" name="ColorFondo" list="colorOptions">
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
                                                <input  type="date" id="FechaInicioCita"  name="FechaInicioCita" min="<?= $fechamin ?>" value="<?=$user['FechaInicio']?>">
                                            </div>
                                            <div class="input-group" style="width:39%">
                                                <h3 for="HoraInicio">Hora de Cita <b style="color:red">*</b></h3>
                                                <input type="time" id="HoraInicio" value="<?=$user['HoraInicio']?>" name="HoraInicio" />
                                            </div>
                                        </div>
                                        <div class="input-group2">
                                            <div class="input-group" style="width:49%">
  		                                        <h3 for="TipoCita">Tipo de Cita <b style="color:red">*</b></h3>
  		                                        <select class="input" id="tipoCita" name="tipoCita">
                                                    <option value="Primera Visita" <?php if ($user['TipoCita'] === "Primera Visita") echo "selected"; ?>>Primera Visita</option>
                                                    <option value="Visita de control" <?php if ($user['TipoCita'] === "Visita de control") echo "selected"; ?>>Visita de control</option>
                                                </select>
  	                                           </div>
                                            <div class="input-group">
                                                <h3 for="DuracionCita">Duracion <b style="color:red">*</b></h3>
  		                                        <select class="input" id="DuracionCita" name="DuracionCita" required>
                                                    <option value="5" <?php if ($user['Duracioncita'] === 5) echo "selected"; ?>>5'</option>
                                                    <option value="10"<?php if ($user['Duracioncita'] === 10) echo "selected"; ?>>10'</option>
                                                    <option value="15"<?php if ($user['Duracioncita'] === 15) echo "selected"; ?>>15'</option>
                                                    <option value="20"<?php if ($user['Duracioncita'] === 20) echo "selected"; ?>>20'</option>
                                                    <option value="30"<?php if ($user['Duracioncita'] === 30) echo "selected"; ?>>30'</option>
                                                    <option value="40"<?php if ($user['Duracioncita'] === 40) echo "selected"; ?>>40'</option>
                                                    <option value="45"<?php if ($user['Duracioncita'] === 45) echo "selected"; ?>>45'</option>
                                                    <option value="50"<?php if ($user['Duracioncita'] === 50) echo "selected"; ?>>50'</option>
                                                    <option value="60"<?php if ($user['Duracioncita'] === 60) echo "selected"; ?>>60'</option>
                                                    <option value="90"<?php if ($user['Duracioncita'] === 90) echo "selected"; ?>>90'</option>
                                                    <option value="120"<?php if ($user['Duracioncita'] === 120) echo "selected"; ?>>120'</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="input-group2">
                                            <div class="input-group" style="width:58%">
  		                                        <h3 for="CanalCita">Canal de Atraccion <b style="color:red">*</b></h3>
  		                                        <select class="input" id="CanalCita" name="CanalCita" required>
                                                    <option value="Cita Online" <?php if ($user['CanalCita'] === "Cita Online") echo "selected"; ?>>Cita Online</option>
                                                    <option value="Marketing Directo" <?php if ($user['CanalCita'] === "Marketing Directo") echo "selected"; ?>>Marketing Directo</option>
                                                    <option value="Referidos" <?php if ($user['CanalCita'] === "Referidos") echo "selected"; ?>>Referidos</option>
                                                </select>
  	                                        </div>
                                            <div class="input-group" style="width:55%">
  		                                        <h3 for="EtiquetaCita">Etiqueta <b style="color:red">*</b></h3>
  		                                        <select class="input" id="EtiquetaCita" name="EtiquetaCita" required>
                                                    <option value="Consulta" <?php if ($user['EtiquetaCita'] === "Consulta") echo "selected"; ?>>Consulta</option>
                                                    <option value="Familia Referida" <?php if ($user['EtiquetaCita'] === "Familia Referida") echo "selected"; ?>>Familia Referida</option>
                                                    <option value="Prioridad" <?php if ($user['EtiquetaCita'] === "Prioridad") echo "selected"; ?>>Prioridad</option>
                                                </select>
  	                                        </div>
                                        </div>
                                        <br>
                                        <div class="button-container">
                                            <button class="button">Modificar</button>
                                        </div>
                                    </form>      
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php else:?>
                        <tr>
                            <td colspan="11">No hay registros</td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
            <div class="pagination">
                <?php
                if (isset($totalPages) && is_numeric($totalPages)) {
                    for ($page = 1; $page <= $totalPages; $page++) {
                        ?>
                        <a href="?page=<?=$page?>"><?=$page?></a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </main>
    <div id="notification" style="display: none;" class="notification">
        <p id="notification-text"></p>
        <span class="notification__progress"></span>
    </div>

</div>
<script src="../issets/js/Dashboard.js"></script>
<script>
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
  // Buscador del paciente según su id
  $(document).ready(function() {
    $('.Codigo').click(function() {
      var codigoPaciente = $('#CodigoPaciente').val();
      var idPsicologo = <?php echo $_SESSION['IdPsicologo']; ?>;

      // Realizar la solicitud AJAX al servidor
      $.ajax({
        url: 'Fetch/fetch_paciente.php', // Archivo PHP que procesa la solicitud
        method: 'POST',
        data: { codigoPaciente: codigoPaciente, idPsicologo: idPsicologo },
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
          $('#correo').val('');
          $('#telefono').val('');
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
          $('#CodigoPaciente').val('');
          $('#correo').val('');
          $('#telefono').val('');
        } else {
          $('#Paciente').val(response.nombre);
		  $('#IdPaciente').val(response.id);
		  $('#CodigoPaciente').val(response.CodigoPaciente);
		  $('#correo').val(response.correo);
		  $('#telefono').val(response.telefono);
        }
      },
      error: function() {
        $('#Paciente').val('Error al procesar la solicitud');
        $('#IdPaciente').val('');
        $('#CodigoPaciente').val('');
        $('#correo').val('');
        $('#telefono').val('');
      }
    });
  });
});
//Funciones del modal
function openModal(id) {
    document.getElementById('modal' + id).style.display = 'block';
}

function closeModal(id) {
    document.getElementById('modal' + id).style.display = 'none';
}

function openModalEliminar(id) {
    document.getElementById('modalEliminar' + id).style.display = 'block';
}

function closeModalEliminar(id) {
    document.getElementById('modalEliminar' + id).style.display = 'none';
}

//funciones de la pagina
var paginationLinks = document.getElementsByClassName('pagination')[0].getElementsByTagName('a');

for (var i = 0; i < paginationLinks.length; i++) {
    paginationLinks[i].addEventListener('click', function(event) {
        event.preventDefault();
        var page = parseInt(this.getAttribute('href').split('=')[1]);
        mostrarPagina(page);
    });
}

function mostrarPagina(page) {
    var rows = document.getElementById('myTable').getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        rows[i].style.display = 'none';
    }

    var startIndex = (page - 1) * <?=$rowsPerPage?>;
    var endIndex = startIndex + <?=$rowsPerPage?>;

    for (var i = startIndex; i < endIndex && i < rows.length; i++) {
        rows[i].style.display = 'table-row';
    }
}

mostrarPagina(1);

</script>
</body>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>




