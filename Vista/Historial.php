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
    <link href="../issets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="stylesheet" href="../issets/css/historial.css">    
    <link rel="stylesheet" href="../issets/css/main.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Datos de Paciente</title>
</head>
<body>
<?php
require_once("../Controlador/Paciente/ControllerPaciente.php");
    $Pac=new usernameControlerPaciente();
    $patients=$Pac->showCompletoAtencion($_SESSION['IdPsicologo']);    
?>
<div class="containerTotal">
<?php
    require_once '../issets/views/Menu.php';
  ?> 
  <!----------- end of aside -------->
  <main class="animate_animated animate_fadeIn">
    <?php
    require_once '../issets/views/Info.php';
    ?> 
    
    <h2 style="color: #49c691;">Historial de Pacientes</h2>
    <div class="recent-updates" style="display:flex; flex-direction: row; gap:20px; align-items: center; padding: 10px 0px 0px 10px">
        <div class="input-group">
  	        <input type="text" placeholder="Buscar paciente"  class="input" required></input>
        </div>
        <a class="button" href="RegPaciente.php">
           Agregar Paciente  <span class="material-symbols-sharp">add</span>
        </a>
    </div>
   
    <div class="container-paciente-tabla">      
        <div class="before-details">
        <table>
            <?php if (!empty($patients)) : ?>
                <?php foreach ($patients as $index => $patient) : ?>
                    <tbody>
                        <tr <?php if ($index === 0) echo 'class="primera-fila"'; ?>>
                            <td>
                                <a style="cursor:pointer"
                                    class="show-info"
                                    data-patient-id="<?=$patient[0]?>"
                                    data-nombres="<?= $patient['NomPaciente'] ?> <?= $patient['ApPaterno'] ?> <?= $patient['ApMaterno']?>"
                                    data-edad="<?=$patient['Edad']?>"
                                    data-diagnostico="<?=$patient['Diagnostico']?>"
                                    data-tratamiento="<?=$patient['Tratamiento']?>"
                                    data-medicamentosprescritos="<?=$patient['MedicamentosPrescritos']?>"
                                    data-FechaInicioCita="<?=$patient['FechaInicioCita']?>">
                                    <p style="cursor: pointer;" class="nombre-paciente"><?=$patient['NomPaciente']?> <?=$patient['ApPaterno']?></p>
                                    <p><?=$patient['Diagnostico']?> / <?=$patient['MotivoConsulta']?></p> 
                                </a>
                            </td>
                            <td ><?=$patient['FechaInicioCita']?></td>
                            <td class="additional-column"></td>
                        </tr>
                    </tbody>
                <?php endforeach;?>             
            <?php endif;?>
        </table>
        </div>
        <div class="details">
        <div class="patient-details">
                    
        </div>

        </div>
    </div>
</main>
</div>
<script src="../issets/js/Dashboard.js"></script>
<script>

// Obtén una referencia al elemento con la clase "details"
const detailsContainer = document.querySelector('.details');

// Agrega un event listener al nombre del paciente
const nombrePaciente = document.querySelector('.nombre-paciente');
nombrePaciente.addEventListener('click', function () {
    // Agrega una clase "open" al contenedor de detalles
    detailsContainer.classList.add('open');
});



// Agrega un event listener a todas las filas de la tabla
var tableRows = document.querySelectorAll('table tr');
tableRows.forEach(function (row) {
    // Encuentra el primer TD dentro de la fila
    var firstColumn = row.querySelector('td:first-child');

    // Verifica si se encontró el primer TD
    if (firstColumn) {
        firstColumn.addEventListener('click', function () {
            // Remueve la clase 'selected' de todas las filas
            tableRows.forEach(function (r) {
                r.classList.remove('selected');
                
                // Cambia el color del texto del contenido de las palabras de la fila actual a su color original
                var textElements = r.querySelectorAll('*');
                textElements.forEach(function (el) {
                    el.style.color = 'black'; // Cambia 'black' al color original deseado
                });
            });

            // Agrega la clase 'selected' a la fila actual
            row.classList.add('selected');

            // Cambia el color del texto del contenido de las palabras de la fila actual a blanco
            var textElements = row.querySelectorAll('*');
            textElements.forEach(function (el) {
                el.style.color = 'white';
            });
        });
    }
});

const showInfoLinks = document.querySelectorAll('.show-info');
const additionalColumns = document.querySelectorAll('.additional-column');
const containerpacientetabla = document.querySelector('.container-paciente-tabla');
const patientDetails = document.querySelector('.patient-details');
let currentPatientId = null; // Variable para rastrear el paciente actual

showInfoLinks.forEach(link => {
    link.addEventListener('click', () => {
        // Obtener el ID del paciente desde el atributo data
        const patientId = link.getAttribute('data-patient-id');

            // Ocultar las columnas adicionales
            additionalColumns.forEach(column => {
                column.classList.add('hidden');
                containerpacientetabla.classList.add('active');
            });

            // Obtener los datos del paciente
            const nombres = link.getAttribute('data-nombres');
            const edad = link.getAttribute('data-edad');
            const diagnostico = link.getAttribute('data-diagnostico');
            const tratamiento = link.getAttribute('data-tratamiento');
            const medicamentosprescritos = link.getAttribute('data-medicamentosprescritos');

            const FechaInicioCita = link.getAttribute('FechaInicioCita');
            // Crear el contenido de los detalles del paciente
            const patientInfoHTML = `
            
            <div style="display:grid; flex-direction:row; gap:10px;">
                <div class="checkout-information">
                    <div class="top-group">
                        <div class="name">
                            <h2 class="visual2">${nombres}</h2>                        
                            <p class="arriba">${edad} años, ${FechaInicioCita || 'Aun no hay cita'}</p>
                            <button type="button" class="green-button" id="butto">Ver Historial Medico</button>                            
                        </div>
                        <div class="date">
                            <h2>20/07</h2>
                            <p>Próxima Consulta</p>
                        </div>
                    </div>
                    <div class="ci-input-group">
                        <h2 class="arriba" for="#">Diagnostico </h2>
                        <p class="abajo">${diagnostico || 'Aun no hay cita'}</p>
                    </div>
                    <div class="ci-input-group">
                        <h2 class="arriba" for="#">Tratamiento </h2>
                        <p class="abajo">${tratamiento || 'Aun no hay cita'}</p>
                    </div>
                    <div class="ci-input-group">
                        <h2 class="arriba" for="#">Medicamentos </h2>
                        <p class="abajo">${medicamentosprescritos || 'Aun no hay cita'}</p>
                    </div>
                    <div class="ci-input-group">
                        <h2 class="arriba" for="#">Primera cita </h2>
                        <p class="abajo">${FechaInicioCita || 'Aun no hay cita'}</p>
                    </div>
                    <div class="BUT">
                        <button type="button" class="green-button" id="button2">Nueva Entrada</button>
                    </div>
                </div>
            </div>
            `;

            // Mostrar la información en el elemento .patient-details
            patientDetails.innerHTML = patientInfoHTML;

            // Mostrar el cuadro de detalles
            patientDetails.style.display = 'block';

            currentPatientId = patientId; // Actualizar el ID del paciente actual
        
    });
});
</script>
</body>
</html>
<?php
}else{
  header("Location: ../index.php");
}
?>