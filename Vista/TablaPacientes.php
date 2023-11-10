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
        <link rel="stylesheet" href="../issets/css/paciente.css">
        <link rel="stylesheet" href="../issets/css/main.css">
        <link rel="icon" href="../Issets/images/contigovoyico.ico">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Paciente</title>
    </head>

    <body>
        <?php
        require("../Controlador/Paciente/ControllerPaciente.php");
        require("../Controlador/Cita/ControllerCita.php");
        $obj = new usernameControlerPaciente();
        $objcita = new usernameControlerCita();
        $rowscita = $objcita->contarRegistrosEnPacientes($_SESSION['IdPsicologo']);
        $patients = $obj->showCompleto($_SESSION['IdPsicologo']);
        ?>
        <div class="container">
            <?php
            require_once '../Issets/views/Menu.php';
            ?>
            <!----------- end of aside -------->
            <main class="animate__animated animate__fadeIn">
                <div class="center-divs">
                    <h4 style="color: #49c691;">Lista de Pacientes</h4>
                    <?php
                    require_once '../Issets/views/Info.php';
                    ?>
                </div>
                <div class="contenedor-botones">
                    <span style="font-size: 15px;color: #6a90f1; ">
                        <b style="font-size: 25px;color: #6a90f1;"><?= $rowscita ?></b>
                        pacientes
                    </span>
                    <div class="separador"></div>
                    <div class="input-buscador">
                        <span id="search-icon"><i class="fas fa-search"></i></span>
                        <input type="text" id="myInput" placeholder="Buscar Paciente" class="input" required>
                    </div>
                    <a class="button-arriba" style="padding:10px 30px; font-size:10px;" href="RegPaciente.php">
                        <i id="search-icon" class="fas fa-plus-circle add-icon" style="margin-right: 10px;"></i>Agregar
                        Paciente
                    </a>
                    <a class="button-eliminar" id="eliminarSeleccionados">
                        <i id="search-icon" class="fas fa-trash" style="margin-right: 10px;color:red"></i>Eliminar
                    </a>
                </div>
                <div class="container-paciente-tabla">
                    <table>
                        <?php
                        $patientsPerPage = 7; // Cantidad de pacientes por página
                        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $offset = ($currentPage - 1) * $patientsPerPage;
                        $patientsToDisplay = array_slice($patients, $offset, $patientsPerPage);
                        ?>

                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkboxPrincipal" class="checkbox-principal"></th>
                                <th style="text-align: start; ">Paciente</th>
                                <th class="additional-column">Codigo</th>
                                <th class="additional-column">DNI</th>
                                <th class="additional-column">Email</th>
                                <th class="additional-column">Celular</th>
                                <th class="additional-column">Cita</th>
                                <th class="additional-column"> Más</th>
                            </tr>
                        </thead>
                        <?php if ($patients) : ?>
                            <?php foreach ($patientsToDisplay as $patient) : ?>
                                <tbody id="myTable" class="tu-tbody-clase">
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="checkbox" id="checkbox<?= $patient[0] ?>" value="<?= $patient[0] ?>">
                                        </td>
                                        <td style="text-align: start; font-weight:bold;padding: 14px;">
                                            <a style="cursor:pointer" class="show-info" data-patient-id="<?= $patient[0] ?>" data-codigo="<?= $patient['codigopac'] ?>" data-nombres="<?= $patient['NomPaciente'] ?>  <?= $patient['ApPaterno'] ?> <?= $patient['ApMaterno'] ?>" data-dni="<?= $patient['Dni'] ?>" data-genero="<?= $patient['Genero'] ?>" data-edad="<?= $patient['Edad'] ?>" data-estadocivil="<?= $patient['EstadoCivil'] ?>" data-email="<?= $patient['Email'] ?>" data-celular="<?= $patient['Telefono'] ?>" data-nombre-madre="<?= $patient['NomMadre'] ?>" data-estado-madre="<?= $patient['EstadoMadre'] ?>" data-nombre-padre="<?= $patient['NomPadre'] ?>" data-estado-padre="<?= $patient['EstadoPadre'] ?>" data-cant-hermanos="<?= $patient['CantHermanos'] ?>" data-antecedentes-familiares="<?= $patient['HistorialFamiliar'] ?>">
                                                <?= $patient['NomPaciente'] ?> <?= $patient['ApPaterno'] ?>
                                            </a>
                                            <a class=" buttoncita" style="display:none;   width: 110px; padding:6px; font-size:10px;margin-top: 4.5%;margin-bottom: 0%;" href="RegCitas.php">
                                                <div style="display: flex;">
                                                    <span class="material-symbols-sharp">add</span>Crear Cita
                                                </div>
                                            </a>
                                        </td>
                                        <td class="additional-column" style="font-weight:bold;"><?= $patient['codigopac'] ?></td>
                                        <td class="additional-column" style="font-weight:bold;"><?= $patient['Dni'] ?></td>
                                        <td class="additional-column" style="font-weight:bold;width:25%;text-align: start; margin-left:4%; padding-left: 3%;">
                                            <?= $patient['Email'] ?></td>
                                        <td class="additional-column" style="font-weight:bold;"><?= $patient['Telefono'] ?></td>
                                        <td class="additional-column">
                                            <div style="display: flex;justify-content: center;margin-top: 2%;">
                                                <a class="buttoncita" style="width: 110px; padding:6px; font-size:10px;" href="RegCitas.php">
                                                    <span class="material-symbols-sharp">add</span>Crear Cita
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="buttonTab" onclick="openOptions(<?= $patient[0] ?>)">
                                                <span class="material-symbols-sharp">more_vert</span>
                                            </button>
                                            <div id="dropdown-content-<?= $patient[0] ?>" class="dropdown-content">
                                                <a type="button" class="btne" onclick="openModalEliminar('<?= $patient[0] ?>')">
                                                    <span class="material-symbols-outlined">delete</span>
                                                    <p>Eliminar</p>
                                                </a>
                                                <a type="button" class="btnm" onclick="openModalEditar('<?= $patient[0] ?>')">
                                                    <span class="material-symbols-outlined">edit</span>
                                                    <p>Editar</p>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php endif; ?>
                                </tbody>
                    </table>

                    <div class="patient-details">

                    </div>
                </div>
                <div class="pagination">
                    <?php if ($patients) : ?>
                        <?php $totalPages = ceil(count($patients) / $patientsPerPage); ?>
                        <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
                            <a href="?page=<?= $page ?>" class="<?= $page === $currentPage ? 'active' : '' ?>"><?= $page ?></a>
                        <?php endfor; ?>
                    <?php endif; ?>
                </div>

            </main>
        </div>
        <?php if (!empty($patients)) : ?>
            <?php foreach ($patients as $patient) : ?>
                <!-- Modal de eliminación -->
                <div id="modalEliminar<?= $patient[0] ?>" class="service-modal-eliminar">
                    <div class="service-modal-body">
                        <a class="close" onclick="closeModalEliminar('<?= $patient[0] ?>')">&times;</a>
                        <span style="font-size:50px; color:red" class="material-symbols-sharp">info</span>
                        <h2 style="font-size:20px">¿Estás seguro de eliminar al paciente <?= $patient[2] . " " . $patient[3] ?>?</h2>
                        <br>
                        <div class="modal-button-container">
                            <a href="../Crud/Paciente/eliminarPaciente.php?id=<?= $patient[0] ?>" class="button-modal button-delete">Eliminar</a>
                        </div>
                    </div>
                </div>
                <!-- Modal de edicion -->
                <div id="modalEditar<?= $patient[0] ?>" class="service-modal flex-center">
                    <div class="service-modal-body">
                        <a href="#" class="close" onclick="closeModalEditar('<?= $patient[0] ?>')">&times;</a>
                        <div class="message_dialog">
                            <h2 style="font-size:20px; color:#49c691">Modificar datos de <?= $patient[2] . " " . $patient[3] ?></h2>
                            <form action="../Crud/Paciente/modificarPaciente.php" method="POST" class="modifica-form">
                                <input type="hidden" name="id_cita" value="<?= $patient[0] ?>">
                                <!-- EDITAR MOTIVO ESTADO FECHA DE INICIO DURACION -->
                                <div class="input-group-modal" style="display: none">
                                    <h3 for="IdPsicologo">IdPsicologo</h3>
                                    <input type="text" id="IdPaciente" class="input" value="<?= $patient[0] ?>" name="IdPaciente" />
                                </div>
                                <div class="input-group2">
                                    <div class="input-group-modal">
                                        <h3 for="NomPaciente">Nombre</h3>
                                        <input id="NomPaciente" type="text" value="<?= $patient[2] ?>" name="NomPaciente" class="input" required />
                                    </div>
                                    <div class="input-group-modal">
                                        <h3 for="Dni">DNI</h3>
                                        <input id="Dni" type="text" value="<?= $patient[5] ?>" name="Dni" class="input" required />
                                    </div>
                                </div>
                                <div class="input-group2">
                                    <div class="input-group-modal">
                                        <h3 for="ApPaterno">Apellido Paterno</h3>
                                        <input id="ApPaterno" type="text" value="<?= $patient[3] ?>" name="ApPaterno" class="input" required />
                                    </div>
                                    <div class="input-group-modal">
                                        <h3 for="ApMaterno">Apellido Materno</h3>
                                        <input id="ApMaterno" type="text" value="<?= $patient[4] ?>" name="ApMaterno" class="input" required />
                                    </div>
                                </div>
                                <div class="input-group2">
                                    <div style=" width:190px;" class="input-group-modal">
                                        <h3 for="FechaNacimiento">Fecha de nacimiento</h3>
                                        <input type="date" id="FechaNacimiento" value="<?= $patient[6] ?>" name="FechaNacimiento" max="<?= $fechamin ?>" value="<?= $fechamin ?>" onchange="calcularEdad()" />
                                    </div>
                                    <div class="input-group-modal">
                                        <h3 for="Edad">Edad</h3>
                                        <input type="text" id="Edad" value="<?= $patient[7] ?>" name="Edad" readonly />
                                    </div>
                                </div>
                                <div class="input-group2">
                                    <div class="input-group-modal">
                                        <h3 for="GradoInstruccion">Grado de instruccion</h3>
                                        <input id="GradoInstruccion" value="<?= $patient[8] ?>" type="text" name="GradoInstruccion" class="input" required />
                                    </div>
                                    <div class="input-group-modal">
                                        <h3 for="Ocupacion">Ocupacion</h3>
                                        <input type="text" id="Ocupacion" value="<?= $patient[9] ?>" class="input" name="Ocupacion" required />
                                    </div>
                                </div>
                                <div class="input-group2">
                                    <div style="width:190px" class="input-group-modal">
                                        <h3 for="EstadoCivil">Estado civil</h3>
                                        <select style="text-align:center" class="input" id="EstadoCivil" name="EstadoCivil" required>
                                            <option value="">Seleccionar</option>
                                            <option value="soltero" <?php echo ($patient[10] === 'soltero') ? 'selected' : ''; ?>>
                                                Soltero/a</option>
                                            <option value="casado" <?php echo ($patient[10] === 'casado') ? 'selected' : ''; ?>>
                                                Casado/a</option>
                                            <option value="divorciado" <?php echo ($patient[10] === 'divorciado') ? 'selected' : ''; ?>>Divorciado/a
                                            </option>
                                            <option value="viudo" <?php echo ($patient[10] === 'viudo') ? 'selected' : ''; ?>>
                                                Viudo/a</option>
                                        </select>

                                    </div>
                                    <div style=" width:190px;" class="input-group-modal">
                                        <h3 for="Genero">Género</h3>
                                        <select style="text-align:center" class="input" id="Genero" name="Genero" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Masculino" <?php echo ($patient[11] === 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                                            <option value="Femenino" <?php echo ($patient[11] === 'Femenino') ? 'selected' : ''; ?>>
                                                Femenino</option>
                                            <option value="Otro" <?php echo ($patient[11] === 'Otro') ? 'selected' : ''; ?>>Otro
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="input-group-modal">
                                    <h3 for="Telefono">Celular</h3>
                                    <input type="text" id="Telefono" value="<?= $patient[12] ?>" class="input" name="Telefono" placeholder="Ejemp. 955888222" required />
                                </div>
                                <div style="margin-left:2em" id="respuesta2"> </div>
                                <div class="input-group-modal">
                                    <h3 for="Email">Correo Electronico</h3>
                                    <input type="Email" id="Email" class="input" value="<?= $patient[13] ?>" name="Email" style="color: #7B7C89;" required />
                                </div>
                                <div style="margin-left:2em" id="respuesta3"> </div>
                                <div class="input-group-modal">
                                    <h3 for="Direccion">Direccion</h3>
                                    <input type="text" id="Direccion" class="input" value="<?= $patient[14] ?>" name="Direccion" />
                                </div>
                                <div class="input-group-modal">
                                    <h3 for="AntecedentesMedicos">Antecedentes médicos</h3>
                                    <input type="text" id="AntecedentesMedicos" value="<?= $patient[15] ?>" class="input" name="AntecedentesMedicos" style="color: #7B7C89;" required />
                                </div>
                                <div class="input-group-modal">
                                    <h3 for="MedicamentosPrescritos">Medicamentos Prescritos</h3>
                                    <input type="text" id="MedicamentosPrescritos" class="input" value="<?= $patient[17] ?>" name="MedicamentosPrescritos" style="color: #7B7C89;" required />
                                </div>
                                <div class="input-group-modal" style="display: none">
                                    <h3 for="IdPsicologo">IdPsicologo</h3>
                                    <input type="text" id="IdPsicologo" class="input" value="<?= $patient[16] ?>" name="IdPsicologo" value="<?= $_SESSION['IdPsicologo'] ?>" />
                                </div>
                                <br>
                                <div class="modal-button-container">
                                    <button class="button-modal button-cancelar" onclick="closeModalEditar('<?= $patient[0] ?>')">Cancelar</button>
                                    <button class="button-modal button-editar">Guardar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <script src="../Issets/js/pacientes.js"></script>
        <script src="../Issets/js/dashboard.js"></script>
        <script>
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
        </script>
        <script>
            $(document).ready(function() {
                $('#Departamento').change(function() {
                    var departamentoId = $(this).find(':selected').data('id');
                    obtenerProvincias(departamentoId);
                });

                function obtenerProvincias(departamentoId) {
                    $.ajax({
                        url: '../Crud/Fetch/obtenerProvincias.php',
                        method: 'POST',
                        data: {
                            departamentoId: departamentoId
                        },
                        dataType: 'json',
                        success: function(provincias) {
                            // Llenar el select de provincias con los datos obtenidos
                            var selectProvincias = $('#Provincia');
                            selectProvincias.empty();
                            selectProvincias.append($('<option>', {
                                value: '',
                                text: 'Seleccionar'
                            }));
                            provincias.forEach(function(provincia) {
                                selectProvincias.append($('<option>', {
                                    value: provincia.id,
                                    text: provincia.name
                                }));
                            });
                        }
                    });
                }
            });

            $('#Provincia').change(function() {
                var provinciaId = $(this).val();
                obtenerDistritos(provinciaId);
            });

            function obtenerDistritos(provinciaId) {
                $.ajax({
                    url: '../Crud/Fetch/obtenerDistritos.php',
                    method: 'POST',
                    data: {
                        provinciaId: provinciaId
                    },
                    dataType: 'json',
                    success: function(distritos) {
                        // Llenar el select de distritos con los datos obtenidos
                        var selectDistritos = $('#Distrito');
                        selectDistritos.empty();
                        selectDistritos.append($('<option>', {
                            value: '',
                            text: 'Seleccionar'
                        }));
                        distritos.forEach(function(distrito) {
                            selectDistritos.append($('<option>', {
                                value: distrito.id,
                                text: distrito.name
                            }));
                        });
                    }
                });
            }
        </script>
        <script>
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