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
    <title>Paciente</title>
</head>
<style>
    .izquierda {
        flex: 1;
        text-align: left;
    }
    table {
    width: 100%;
    border-collapse: separate; 
    border-spacing: 0 10px; 
    max-height: 35%;
    
}
    .derecha {
        flex: 1;
        text-align: right;
    }
    .arriba{ /*Nueva clase creada para el formulario - Hans */
    color: #89BEF5; /*Añadi un cambio de color - Hans */
    font-size: 15px;
    font-weight: bold;
}
.abajo{ /*Nueva clase creada para el formulario - Hans */
    font-size: 0.90rem;
    color: #89BEF5; /*Añadi un cambio de color - Hans */
    font-weight: normal;
    text-align: center;
}
.visual{ /*Nueva clase creada para el forulario - Hans */
    color: #49c691; 
    font-size: 2rem;
    font-weight: bold;
}

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>
<body>
<?php
    require("../Controlador/Paciente/ControllerPaciente.php");
    require("../Controlador/Cita/ControllerCita.php");
    $obj=new usernameControlerPaciente();
    $objcita=new usernameControlerCita();
    $rowscita=$objcita->contarRegistrosEnPacientes($_SESSION['IdPsicologo']);
    $patients = $obj->showCompleto($_SESSION['IdPsicologo']);
?>
<div class="containerTotal">
    <?php
        require_once '../Issets/views/Menu.php';
    ?> 
  <!----------- end of aside -------->
    <main class="animate__animated animate__fadeIn">
        <?php
            require_once '../Issets/views/Info.php';
        ?>
        <h2 style="color: #49c691;">Lista de Pacientes</h2>
        <div class="recent-updates" style="display:flex; flex-direction: row; gap:20px; align-items: center; padding: 10px 0px 0px 10px">
            <span style="font-size: 15px;color: #6a90f1;">
            <b style="font-size: 25px;color: #6a90f1;"><?= $rowscita ?></b> pacientes </span>
            <div class="input-group">
                <input type="text" style="background-color: White;" id="myInput" placeholder="Buscar" class="input" required></input>
            </div>
            <a class="button" style="padding:10px 30px; font-size:10px;" href="RegPaciente.php">
                <span class="material-symbols-sharp">add</span>Agregar Paciente
            </a>
            <button type="button" class="button-eliminar" id="eliminarSeleccionados" style="display: none;">Eliminar</button>
        </div>
        <div class="container-paciente-tabla">
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkboxPrincipal" class="checkbox-principal"></th>
                        <th >Paciente</th>
                        <th class="additional-column">Codigo</th>
                        <th class="additional-column">DNI</th>
                        <th class="additional-column">Email</th>
                        <th class="additional-column">Celular</th>
                        <th class="additional-column">Nueva Cita</th>
                        <th></th>
                    </tr>
                </thead >
                <?php if (!empty($patients)) : ?>
                    <?php foreach ($patients as $patient) : ?>
                        <tbody id="myTable">
                            <tr>
                                <td>
                                    <input type="checkbox" class="checkbox" id="checkbox<?=$patient[0]?>" value="<?=$patient[0]?>">
                                </td>
                                <td>
                                    <a style="cursor:pointer"
                                        class="show-info"
                                        data-patient-id="<?=$patient[0]?>"
                                        data-codigo="<?=$patient['codigopac']?>"
                                        data-nombres="<?= $patient['NomPaciente'] ?> <?= $patient['ApPaterno'] ?> <?= $patient['ApMaterno']?>"
                                        data-dni="<?=$patient['Dni']?>"
                                        data-genero="<?=$patient['Genero']?>"
                                        data-edad="<?=$patient['Edad']?>"
                                        data-estadocivil="<?=$patient['EstadoCivil']?>"
                                        data-email="<?=$patient['Email']?>"
                                        data-celular="<?=$patient['Telefono']?>"
                                        data-nombre-madre="<?=$patient['NomMadre']?>"
                                        data-estado-madre="<?=$patient['EstadoMadre']?>"
                                        data-nombre-padre="<?=$patient['NomPadre']?>"
                                        data-estado-padre="<?=$patient['EstadoPadre']?>"
                                        data-cant-hermanos="<?=$patient['CantHermanos']?>"
                                        data-antecedentes-familiares="<?=$patient['HistorialFamiliar']?>"
                                        data-FechaInicioCita="<?=$patient['FechaInicioCita']?>">
                                        <?=$patient['NomPaciente']?> <?=$patient['ApPaterno']?>
                                    </a>
                                </td>
                                <td class="additional-column"><?=$patient['codigopac']?></td>
                                <td class="additional-column"><?=$patient['Dni']?></td>
                                <td class="additional-column"><?=$patient['Email']?></td>
                                <td class="additional-column"><?=$patient['Telefono']?></td>
                                <td class="additional-column">
                                    <a class="button" style="width: 110px; padding:6px; font-size:10px;" href="citas.php">
                                        <span class="material-symbols-sharp">add</span>Crear Cita
                                    </a>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="dropbtn"><span class="material-symbols-sharp">more_vert</span></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    <?php endforeach;?>             
                <?php endif;?>
            </table>
            <div class="patient-details">
        
            </div>
        </div>
    </main>
</div>
<script src="../Issets/js/Dashboard.js"></script>
<script src="../Issets/js/pacientes.js"></script>
<script>
    const showInfoLinks = document.querySelectorAll('.show-info');
const additionalColumns = document.querySelectorAll('.additional-column');
const containerpacientetabla = document.querySelector('.container-paciente-tabla');
const patientDetails = document.querySelector('.patient-details');
let currentPatientId = null; // Variable para rastrear el paciente actual

showInfoLinks.forEach(link => {
    link.addEventListener('click', () => {
        // Obtener el ID del paciente desde el atributo data
        const patientId = link.getAttribute('data-patient-id');
        
        if (currentPatientId !== patientId) {
            // Si se hace clic en un paciente diferente

            // Ocultar las columnas adicionales
            additionalColumns.forEach(column => {
                column.classList.add('hidden');
                containerpacientetabla.classList.add('active');
            });

            // Obtener los datos del paciente
            const codigo = link.getAttribute('data-codigo');
            const dni = link.getAttribute('data-dni');
            const genero = link.getAttribute('data-genero');
            const edad = link.getAttribute('data-edad');
            const estadocivil = link.getAttribute('data-estadocivil');
            const nombres = link.getAttribute('data-nombres');
            const email = link.getAttribute('data-email');
            const celular = link.getAttribute('data-celular');

            // Obtener los datos del área familiar
            const nombreMadre = link.getAttribute('data-nombre-madre');
            const estadoMadre = link.getAttribute('data-estado-madre');
            const nombrePadre = link.getAttribute('data-nombre-padre');
            const estadoPadre = link.getAttribute('data-estado-padre');
            const cantHermanos = link.getAttribute('data-cant-hermanos');
            const antecedentesFamiliares = link.getAttribute('data-antecedentes-familiares');

            const FechaInicioCita = link.getAttribute('FechaInicioCita');

            console.log(`Enlace ${codigo}`);
            // Crear el contenido de los detalles del paciente
            const patientInfoHTML = `
            <div style="display:grid; flex-direction:row; gap:10px;">
                <div class="checkout-information">
                    <div class="input-group3">
                        <p class="visual">${nombres}</p>
                        <p class="arriba" for="#">ID: ${codigo}</p>
                    </div>
                    <div class="input-group">
                        <p class="arriba" for="#">Última cita: </p>
                        <h2 class="arriba">${FechaInicioCita || 'Aun no hay cita'}</h2>
                    </div>
                </div>
                <div style="display:flex; flex-direction:row; gap:10px;">
                <!-------MI CAMBIO ------>
                    <div class="checkout-information">
                    <p class="arriba">Datos específicos: </p>
                        <div class="input-group4">
                            <p class="abajo" for="Genero">Género</p>
                            <p class="arriba">${genero}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="Genero">Edad</p>
                            <p class="arriba">${edad}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Estado civil</p>
                            <p class="arriba">${estadocivil}</p>
                        </div>
                    </div>
                <!-------FIN DE MI CAMBIO ------>

                    <div class="checkout-information">
                    <p class="arriba">Información de contacto: </p>
                        <div class="input-group4">
                            <p class="abajo" for="Genero">Celular</p>
                            <p class="arriba">${celular}</p>  
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Correo</p>
                        <p class="arriba">${email}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">DNI</p>
                        <p class="arriba">${dni}</p>
                        </div>
                    </div>
                <!------ Linea de separacion entre mi display flex y grid ---->
                </div>

                <div style="display:flex; flex-direction:row; gap:10px;">
                    <div class="checkout-information">
                        <p class="arriba">Información personal: </p>
                        <div class="input-group4">
                            <p class="abajo" for="Genero">Nombres y apellidos</p>
                            <p class="arriba">${nombres}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Correo</p>
                            <p class="arriba">${email}</p>
                        </div>
                        <div class="input-group4">
                            <p class "abajo" for="#">DNI</p>
                            <p class="arriba">${dni}</p>
                        </div>
                    </div>
                    <div class="checkout-information">
                        <p class="arriba">Información familiar: </p>
                        <div class="input-group4">
                            <p class="abajo" for="Genero">Nombre de la madre</p>
                            <p class="arriba">${nombreMadre || 'No hay registros'}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Estado de la madre</p>
                            <p class="arriba">${estadoMadre || 'No hay registros'}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Nombre del padre</p>
                            <p class="arriba">${nombrePadre || 'No hay registros'}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Estado del padre</p>
                            <p class="arriba">${estadoPadre || 'No hay registros'}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Cantidad de hermanos</p>
                            <p class="arriba">${cantHermanos || 'No hay registros'}</p>
                        </div>
                        <div class="input-group4">
                            <p class="abajo" for="#">Antecedentes familiares</p>
                            <p class="arriba">${antecedentesFamiliares || 'No hay registros'}</p>
                        </div>
                    </div>
                    <!----Linea de separacion entre el formulario y los botones ---->
                </div>    
            </div>
            `;

            // Mostrar la información en el elemento .patient-details
            patientDetails.innerHTML = patientInfoHTML;

            // Mostrar el cuadro de detalles
            patientDetails.style.display = 'block';

            currentPatientId = patientId; // Actualizar el ID del paciente actual
        } else {
            // Si se hace clic en el mismo paciente nuevamente

            // Restaurar la tabla a su estado original
            additionalColumns.forEach(column => {
                column.classList.remove('hidden');
            });
            containerpacientetabla.classList.remove('active');
            // Ocultar el cuadro de detalles
            patientDetails.style.display = 'none';

            currentPatientId = null; // Restablecer el ID del paciente actual
        }
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