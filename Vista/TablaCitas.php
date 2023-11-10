<?php
session_start();
if (isset($_SESSION['NombrePsicologo'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="../Issets/css/citas.css">
        <link rel="stylesheet" href="../Issets/css/main.css">
        <link rel="icon" href="../Issets/images/contigovoyico.ico">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Citas</title>
    </head>

    <body>
        <?php
        require("../Controlador/Cita/ControllerCita.php");
        $obj = new usernameControlerCita();
        $rowscita = $obj->contarRegistrosEnCitas($_SESSION['IdPsicologo']);
        $rows = $obj->ver($_SESSION['IdPsicologo']);
        ?>
        <div class="container">
            <?php
            require_once '../Issets/views/Menu.php';
            ?>
            <!----------- fin de aside -------->
            <main class="animate__animated animate__fadeIn">
                <div class="center-divs">
                    <h4 style="color: #49c691;">Lista de Citas</h4>
                    <?php
                    require_once '../Issets/views/Info.php';
                    ?>
                </div>
                <div class="contenedor-botones">
                    <span style="font-size: 15px;color: #6a90f1; ">
                        <b style="font-size: 25px;color: #6a90f1;"><?= $rowscita ?></b>
                        Citas
                    </span>
                    <div class="separador"></div>
                    <div class="input-buscador">
                        <span id="search-icon"><i class="fas fa-search"></i></span>
                        <input type="text" id="myInput" placeholder="Buscar cita" class="input" required>
                    </div>
                    <a class="button-arriba" style="padding:10px 30px; font-size:10px;" href="RegCitas.php">
                        <i id="search-icon" class="fas fa-plus-circle add-icon" style="margin-right: 10px;"></i>Agregar Cita
                    </a>
                    <a class="button-eliminar" id="eliminarSeleccionados">
                        <i id="search-icon" class="fas fa-trash" style="margin-right: 10px;color:red"></i>Eliminar
                    </a>
                </div>
                <div class="recent-citas">
                    <table>
                        <?php
                        $rowsPerPage = 10;
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
                                <th>Más</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php if ($rows) : ?>
                                <?php foreach ($rows as $row) : ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="checkbox" id="checkbox<?= $row[0] ?>" value="<?= $row[0] ?>">
                                        </td>
                                        <td style="padding: 20px;"><?= $row[1] ?></td>
                                        <td><?= $row[11] ?></td>
                                        <td><?= $row[2] ?></td>
                                        <td><?= $row[3] ?></td>
                                        <td><?= $row[4] ?></td>
                                        <td style="color:green"><?= $row[5] ?></td>
                                        <td>
                                            <button class="buttonTab" onclick="openOptions(<?= $row[0] ?>)">
                                                <span class="material-symbols-sharp">more_vert</span>
                                            </button>
                                            <div id="dropdown-content-<?= $row[0] ?>" class="dropdown-content">
                                                <a type="button" class="btne" onclick="openModalEliminar('<?= $row[0] ?>')">
                                                    <span class="material-symbols-outlined">delete</span>
                                                    <p>Eliminar</p>
                                                </a>
                                                <a type="button" class="btnm" onclick="openModalEditar('<?= $row[0] ?>')">
                                                    <span class="material-symbols-outlined">edit</span>
                                                    <p>Editar</p>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="11">No hay registros</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <?php
                        if (isset($totalPages) && is_numeric($totalPages)) {
                            for ($page = 1; $page <= $totalPages; $page++) {
                        ?>
                                <a href="?page=<?= $page ?>"><?= $page ?></a>
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
        <?php if ($rows) : ?>
            <?php foreach ($rows as $row) : ?>
                <!-- Modal de eliminación -->
                <div id="modalEliminar<?= $row[0] ?>" class="service-modal-eliminar">
                    <div class="service-modal-body">
                        <a class="close" onclick="closeModalEliminar('<?= $row[0] ?>')">&times;</a>
                        <span style="font-size:50px; color:red" class="material-symbols-sharp">info</span>
                        <h2 style="font-size:20px">¿Estás seguro de eliminar la cita de <?= $row[1] ?>?</h2>
                        <br>
                        <div class="modal-button-container">
                            <a class="button-modal button-cancelar" onclick="closeModalEliminar('<?= $row[0] ?>')">Cancelar</a>
                            <a href="../Crud/Cita/eliminarCita.php?id=<?= $row[0] ?>" class="button-modal button-delete">Eliminar</a>
                        </div>
                    </div>
                </div>
                <?php
                $user = $obj->show($row[0]);
                ?>
                <!-- Modal de edicion -->
                <div id="modalEditar<?= $row[0] ?>" class="service-modal-editar flex-center">
                    <div class="service-modal-body">
                        <a href="#" class="close" onclick="closeModalEditar('<?= $row[0] ?>')">&times;</a>
                        <div class="message_dialog">
                            <h2 style="font-size:20px; color:#49c691">Editar Cita de <?= $row[1] . " " . $row[2] ?></h2>
                            <form action="../Crud/Cita/modificarCita.php" method="POST" class="dialog">
                                <input type="hidden" name="id_cita" value="<?= $row[0] ?>">
                                <!-- EDITAR MOTIVO ESTADO FECHA DE INICIO DURACION -->
                                <div class="input-group-modal">
                                    <h3 for="motivo">Motivo de la Consutla <b style="color:red">*</b></h3>
                                    <textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="motivo" name="motivo" required><?= $row['2'] ?></textarea>
                                </div>
                                <br>
                                <div class="input-group2">
                                    <div class="input-group-modal">
                                        <h3 for="EstadoCita">Estado de la Cita <b style="color:red">*</b></h3>
                                        <select class="input" id="EstadoCita" name="EstadoCita" required>
                                            <option value="Se requiere confirmacion" <?php if ($user['EstadoCita'] === "Se requiere confirmacion") echo "selected"; ?>>
                                                Se requiere confirmacion</option>
                                            <option value="Confirmado" <?php if ($user['EstadoCita'] === "Confirmado") echo "selected"; ?>>
                                                Confirmado</option>
                                            <option value="Ausencia del paciente" <?php if ($user['EstadoCita'] === "Ausencia del paciente") echo "selected"; ?>>
                                                Ausencia del paciente</option>
                                        </select>
                                    </div>
                                    <div class="input-group-modal" style="width:50%; margin-left: 65px;">
                                        <h3 for="ColorFondo">Color de Cita <b style="color:red">*</b></h3>
                                        <input type="color" id="ColorFondo" value="<?= $user['ColorFondo'] ?>" name="ColorFondo" list="colorOptions">
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
                                    <div class="input-group-modal" style="width:49%">
                                        <h3 for="fecha_inicio">Fecha de Cita<b style="color:red">*</b></h3>
                                        <input type="date" id="fecha_inicio" name="fecha_inicio" min="<?= $fechamin ?>" value="<?= $fechamin ?>">
                                    </div>
                                    <div class="input-group-modal" style="width:49%">
                                        <h3 for="hora_inicio">Hora de Cita <b style="color:red">*</b></h3>
                                        <input type="time" id="hora_inicio" name="hora_inicio" value="<?= $rows['4'] ?>" />
                                    </div>
                                </div>
                                <br>
                                <div class="input-group2">
                                    <div class="input-group-modal" style="width:49%">
                                        <h3 for="tipoCita">Tipo de Cita <b style="color:red">*</b></h3>
                                        <select class="input" id="tipoCita" name="tipoCita">
                                            <option value="Primera Visita" <?php if ($user['TipoCita'] === "Primera Visita") echo "selected"; ?>>
                                                Primera Visita</option>
                                            <option value="Visita de control" <?php if ($user['TipoCita'] === "Visita de control") echo "selected"; ?>>
                                                Visita de control</option>
                                        </select>
                                    </div>
                                    <div class="input-group-modal">
                                        <h3 style="margin-left: 65px;" for="duracion">Duracion <b style="color:red">*</b></h3>
                                        <select class="input" id="duracion" name="duracion" required>
                                            <option value="5" <?php if ($user['Duracioncita'] === 5) echo "selected"; ?>>5'
                                            </option>
                                            <option value="10" <?php if ($user['Duracioncita'] === 10) echo "selected"; ?>>10'
                                            </option>
                                            <option value="15" <?php if ($user['Duracioncita'] === 15) echo "selected"; ?>>15'
                                            </option>
                                            <option value="20" <?php if ($user['Duracioncita'] === 20) echo "selected"; ?>>20'
                                            </option>
                                            <option value="30" <?php if ($user['Duracioncita'] === 30) echo "selected"; ?>>30'
                                            </option>
                                            <option value="40" <?php if ($user['Duracioncita'] === 40) echo "selected"; ?>>40'
                                            </option>
                                            <option value="45" <?php if ($user['Duracioncita'] === 45) echo "selected"; ?>>45'
                                            </option>
                                            <option value="50" <?php if ($user['Duracioncita'] === 50) echo "selected"; ?>>50'
                                            </option>
                                            <option value="60" <?php if ($user['Duracioncita'] === 60) echo "selected"; ?>>60'
                                            </option>
                                            <option value="90" <?php if ($user['Duracioncita'] === 90) echo "selected"; ?>>90'
                                            </option>
                                            <option value="120" <?php if ($user['Duracioncita'] === 120) echo "selected"; ?>>120'
                                            </option>
                                        </select>
                                    </div>

                                </div>
                                <div class="input-group-modal" style="display: none;">
                                    <h3 for="FechaFin">FechaFin <b style="color:red">*</b></h3>
                                    <input id="FechaFin" type="text" name="FechaFin" readonly />
                                </div>
                                <div class="input-group2">
                                    <div class="input-group-modal" style="width:58%">
                                        <h3 for="CanalCita">Canal de Atraccion <b style="color:red">*</b></h3>
                                        <select class="input" id="CanalCita" name="CanalCita" required>
                                            <option value="Cita Online" <?php if ($user['CanalCita'] === "Cita Online") echo "selected"; ?>>
                                                Cita Online</option>
                                            <option value="Marketing Directo" <?php if ($user['CanalCita'] === "Marketing Directo") echo "selected"; ?>>
                                                Marketing Directo</option>
                                            <option value="Referidos" <?php if ($user['CanalCita'] === "Referidos") echo "selected"; ?>>
                                                Referidos</option>
                                        </select>
                                    </div>
                                    <div class="input-group-modal" style="width:55%">
                                        <h3 for="EtiquetaCita">Etiqueta <b style="color:red">*</b></h3>
                                        <select class="input" id="EtiquetaCita" name="EtiquetaCita" required>
                                            <option value="Consulta" <?php if ($user['EtiquetaCita'] === "Consulta") echo "selected"; ?>>
                                                Consulta</option>
                                            <option value="Familia Referida" <?php if ($user['EtiquetaCita'] === "Familia Referida") echo "selected"; ?>>
                                                Familia Referida</option>
                                            <option value="Prioridad" <?php if ($user['EtiquetaCita'] === "Prioridad") echo "selected"; ?>>
                                                Prioridad</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="input-group-modal" style="display: none">
                                    <h3 for="IdPsicologo">IdPsicologo </h3>
                                    <input type="text" id="IdPsicologo" name="IdPsicologo" value="<?= $_SESSION['IdPsicologo'] ?>" placeholder="Ingrese algun Antecedente Medico" />
                                </div>
                                <div class="modal-button-container">
                                    <button class="button-modal button-cancelar" onclick="closeModalEditar('<?= $row[0] ?>')">Cancelar</button>
                                    <button type="submit" class="button-modal button-editar">Guardar</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <script src="../issets/js/dashboard.js"></script>
        <script src="../Issets/js/citas.js"></script>
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
            // Buscador del paciente según su id
            $(document).ready(function() {
                $('.Codigo').click(function() {
                    var codigoPaciente = $('#CodigoPaciente').val();
                    var idPsicologo = <?php echo $_SESSION['IdPsicologo']; ?>;

                    // Realizar la solicitud AJAX al servidor
                    $.ajax({
                        url: 'Fetch/fetch_paciente.php', // Archivo PHP que procesa la solicitud
                        method: 'POST',
                        data: {
                            codigoPaciente: codigoPaciente,
                            idPsicologo: idPsicologo
                        },
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
                        data: {
                            NomPaciente: NomPaciente,
                            idPsicologo: idPsicologo
                        },
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
            function openModalEditar(id) {
                closeOptions(id);
                var modal = document.getElementById('modalEditar' + id);
                modal.classList.add('active');
            }

            function closeModalEditar(id) {
                var modal = document.getElementById('modalEditar' + id);
                modal.classList.remove('active');
            }

            function openModalEliminar(id) {
                closeOptions(id);
                var modal = document.getElementById('modalEliminar' + id);
                modal.classList.add('active');
            }

            function closeModalEliminar(id) {
                var modal = document.getElementById('modalEliminar' + id);
                modal.classList.remove('active');
            }

            function closeOptions(id) {
                var dropdownContent = document.querySelector("#dropdown-content-" + id);
                dropdownContent.style.display = "none";
            }

            function openOptions(id) {
                var dropdownContent = document.querySelector("#dropdown-content-" + id);

                // Comprueba si el dropdown ya está abierto
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    var dropdownContents = document.getElementsByClassName("dropdown-content");

                    for (var i = 0; i < dropdownContents.length; i++) {
                        dropdownContents[i].style.display = "none";
                    }

                    dropdownContent.style.display = "block";
                    dropdownContent.style.marginLeft = "-71px";
                }
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

                var startIndex = (page - 1) * <?= $rowsPerPage ?>;
                var endIndex = startIndex + <?= $rowsPerPage ?>;

                for (var i = startIndex; i < endIndex && i < rows.length; i++) {
                    rows[i].style.display = 'table-row';
                }
            }

            mostrarPagina(1);
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: ../Index.php");
}
?>