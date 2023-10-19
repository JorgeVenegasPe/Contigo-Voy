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
        $obj=new usernameControlerPaciente();
        $objcita=new usernameControlerCita();
        $rowscita=$objcita->contarRegistrosEnPacientes($_SESSION['IdPsicologo']);
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
                    <i id="search-icon" class="fas fa-plus-circle add-icon" style="margin-right: 10px;"></i>Agregar Paciente
                </a>
                <a class="button-eliminar" id="eliminarSeleccionados">
                    <i id="search-icon" class="fas fa-trash" style="margin-right: 10px;color:red" ></i>Eliminar
                </a>
            </div>
            <div class="container-paciente-tabla">
                <table>
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkboxPrincipal" class="checkbox-principal"></th>
                            <th style="text-align: start; " >Paciente</th>
                            <th class="additional-column">Codigo</th>
                            <th class="additional-column">DNI</th>
                            <th class="additional-column">Email</th>
                            <th class="additional-column">Celular</th>
                            <th class="additional-column" >Cita</th>
                            <th class="additional-column"> Más</th>
                        </tr>
                    </thead >
                    <?php if (!empty($patients)) : ?>
                        <?php foreach ($patients as $patient) : ?>
                            <tbody id="myTable" class="tu-tbody-clase">
                                <tr >
                                    <td>
                                        <input type="checkbox" class="checkbox" id="checkbox<?=$patient[0]?>" value="<?=$patient[0]?>">
                                    </td>
                                    <td style="text-align: start; font-weight:bold;padding: 14px;">
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
                                        <a class="buttoncita" style="display:none;   width: 110px; padding:6px; font-size:10px;margin-top: 4.5%;margin-bottom: 0%;" href="RegCitas.php">
                                            <div style="display: flex;">
                                                <span class="material-symbols-sharp">add</span>Crear Cita
                                            </div>                                                                           
                                        </a>                                    
                                    </td>
                                    <td class="additional-column" style="font-weight:bold;"><?=$patient['codigopac']?></td>
                                    <td class="additional-column" style="font-weight:bold;"><?=$patient['Dni']?></td>
                                    <td class="additional-column" style="font-weight:bold;width:25%;text-align: start; margin-left:4%; padding-left: 3%;"><?=$patient['Email']?></td>
                                    <td class="additional-column" style="font-weight:bold;"><?=$patient['Telefono']?></td>
                                    <td class="additional-column" >
                                        <div style="display: flex;justify-content: center;margin-top: 2%;">
                                            <a class="buttoncita" style="width: 110px; padding:6px; font-size:10px;" href="RegCitas.php">                                        
                                                <span class="material-symbols-sharp">add</span>Crear Cita                                                                                                            
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="buttonTab" onclick="openOptions(<?=$patient[0]?>)">
                                            <span class="material-symbols-sharp">more_vert</span>
                                        </button>
                                        <div id="dropdown-content-<?=$patient[0]?>" class="dropdown-content">
                                            <a type="button" class="btne" onclick="openModalEliminar('<?=$patient[0]?>')">
                                            <span class="material-symbols-outlined">delete</span>
                                                <p>Eliminar</p>
                                            </a>
                                            <a type="button" class="btnm" onclick="openModalEditar('<?=$patient[0]?>')">
                                                <span class="material-symbols-outlined">edit</span>
                                                <p>Editar</p>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            
                        <?php endforeach;?>             
                    <?php endif;?>
                            </tbody>
                </table>
                <div class="patient-details">
            
                </div>
            </div>
        </main>
    </div>
    <?php if (!empty($patients)) : ?>
        <?php foreach ($patients as $patient) : ?>
        <!-- Modal de eliminación -->
        <div id="modalEliminar<?=$patient[0]?>" class="service-modal flex-center">
            <div class="service-modal-body">
                <a class="close" onclick="closeModalEliminar('<?=$patient[0]?>')">&times;</a>
                <span style="font-size:50px; color:red" class="material-symbols-sharp">info</span>
                <h2 style="font-size:20px">¿Estás seguro de eliminar al paciente <?=$patient[2] ." ". $patient[3]?>?</h2>
                <br>
                <div class="modal-button-container">
                    <a href="../Crud/Paciente/eliminarPaciente.php?id=<?=$patient[0]?>" class="button-modal button-delete">Eliminar</a>
                </div>
            </div>
        </div>
        <!-- Modal de edicion -->
        <div id="modalEditar<?=$patient[0]?>" class="service-modal flex-center">
           <div class="service-modal-body">
               <a href="#" class="close"  onclick="closeModalEditar('<?=$patient[0]?>')">&times;</a>
               <div class="message_dialog">
                   <h2 style="font-size:20px; color:#49c691">Modificar datos de <?=$patient[2] ." ". $patient[3]?></h2>
                   <form action="../Crud/Cita/modificarCita.php" method="POST" class="modifica-form">
                    <input type="hidden" name="id_cita" value="<?=$patient[0]?>">
                        <!-- EDITAR MOTIVO ESTADO FECHA DE INICIO DURACION -->
                        <div class="input-group2">
                            <div class="input-group-modal">
                         	    <h3 for="NomPaciente">Nombre</h3>
			            	    <input id="NomPaciente" type="text" value="<?=$patient[2]?>" name="NomPaciente" class="input" required/>
                            </div>
                            <div class="input-group-modal">
			            	   <h3 for="Dni">DNI</h3>
			            	   <input id="Dni" type="text"value="<?=$patient[5]?>" name="Dni" class="input" required/>
			            	</div>
                        </div>
                        <div class="input-group2">
                            <div class="input-group-modal">
                                <h3 for="ApPaterno">Apellido Paterno</h3>
                                <input id="ApPaterno" type="text" value="<?=$patient[3]?>" name="ApPaterno" class="input" required/>
                            </div>
                            <div class="input-group-modal">
                                <h3 for="ApMaterno">Apellido Materno</h3>
                                <input id="ApMaterno" type="text" value="<?=$patient[4]?>" name="ApMaterno" class="input" required/>
                            </div>
                        </div>
                        <div class="input-group2">
                            <div style=" width:190px;" class="input-group-modal">
                                    <h3 for="FechaNacimiento">Fecha de nacimiento</h3>
                                    <input type="date" id="FechaNacimiento" value="<?=$patient[6]?>" name="FechaNacimiento" max="<?= $fechamin ?>" value="<?= $fechamin ?>" onchange="calcularEdad()" />
                            </div>
                            <div class="input-group-modal">
                                    <h3 for="Edad">Edad</h3>
                                    <input type="text" id="Edad" value="<?=$patient[7]?>" name="Edad" readonly/>
                            </div>
                        </div>
                        <div class="input-group2">
                            <div class="input-group-modal">
                                    <h3 for="GradoInstruccion">Grado de instruccion</h3>
                                    <input id="GradoInstruccion"value="<?=$patient[8]?>" type="text" name="GradoInstruccion" class="input" required/>
                            </div>
                            <div class="input-group-modal">
                                    <h3 for="Ocupacion">Ocupacion</h3>
                                    <input type="text" id="Ocupacion" value="<?=$patient[9]?>" class="input" name="Ocupacion" required/>
                            </div>
                        </div>
                        <div class="input-group2">
                            <div style="width:190px"class="input-group-modal">
                                <h3 for="EstadoCivil">Estado civil</h3>
                                <select style="text-align:center" class="input" id="EstadoCivil" name="EstadoCivil" required>
                                <option value="">Seleccionar</option>
                                <option value="soltero">Soltero/a</option>
                                <option value="casado">Casado/a</option>
                                <option value="divorciado">Divorciado/a</option>
                                <option value="viudo">Viudo/a</option>
                                </select>
                            </div>
                            <div style=" width:190px;"class="input-group-modal">
                                <h3 for="Genero">Género</h3>
                                <select style="text-align:center" class="input" id="Genero" name="Genero" required>
                                <option value="">Seleccionar</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group-modal">
                            <h3 for="Telefono">Celular</h3>
                            <input type="text" id="Telefono" value="<?=$patient[12]?>" class="input" name="Telefono" placeholder="Ejemp. 955888222"  required/>
                        </div>
                        <div style="margin-left:2em" id="respuesta2"> </div>
                        <div  class="input-group-modal">
                            <h3 for="Email">Correo Electronico</h3>
                            <input type="Email" id="Email" class="input" value="<?=$patient[13]?>" name="Email" style="color: #7B7C89;" required/>
                        </div>
                        <div style="margin-left:2em" id="respuesta3"> </div>
                        <div  class="input-group2">
                            <div style="width: 190px" class="input-group-modal">
                                <h3 for="Departamento">Departamento</h3>
                                <select style="text-align: center" class="input"  id="Departamento" name="Departamento" required>
                                <option value="">Seleccionar</option>
                                <?php foreach ($departamentos as $departamento) : ?>
                                    <option value="<?php echo $departamento['id']; ?>" data-id="<?php echo $departamento['id']; ?>"><?php echo $departamento['name']; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div style="width: 190px" class="input-group-modal">
                                <h3 for="Provincia">Provincia</h3>
                                <select style="text-align: center" class="input" id="Provincia" name="Provincia" required>
                                    <option value="">Seleccionar</option>
                                </select>
                            </div>
                        </div>
                        <div  class="input-group2">
                            <div style="width:190px" class="input-group-modal">
                                <h3 for="Distrito">Distrito</h3>
                                <select style="text-align:center" class="input" id="Distrito" name="Distrito" required>
                                <option value="">Seleccionar</option>
                                </select>
                            </div>
                            <div class="input-group-modal">
                                <h3 for="Direccion">Dirección</h3>
                                <input type="text" id="Direccion" value="<?=$patient[14]?>" class="input" name="Direccion" style="color: #7B7C89;" required/>
                            </div>
                        </div>
                        <div class="input-group-modal">
                            <h3 for="AntecedentesMedicos">Antecedentes médicos</h3>
                            <input type="text" id="AntecedentesMedicos"  value="<?=$patient[15]?>" class="input" name="AntecedentesMedicos" style="color: #7B7C89;" required/>
                        </div>
                        <div class="input-group-modal">
                            <h3 for="MedicamentosPrescritos">Medicamentos Prescritos</h3>
                            <input type="text" id="MedicamentosPrescritos" class="input" value="<?=$patient[17]?>" name="MedicamentosPrescritos"  style="color: #7B7C89;" required/>
                        </div>
                        <div class="input-group-modal" style="display: none">
                            <h3 for="IdPsicologo">IdPsicologo</h3>
                            <input type="text" id="IdPsicologo" class="input" value="<?=$patient[16]?>" name="IdPsicologo" value="<?=$_SESSION['IdPsicologo']?>" />
                        </div>                                               
                    </form>
                    <div class="modal-button-container">
                        <button class="button-modal button-cancelar" onclick="closeModalEditar('<?=$patient[0]?>')">Cancelar</button>        
                        <button class="button-modal button-editar">Guardar</button>
                    </div>
               </div>
           </div>
        </div>           
        <?php endforeach;?>             
    <?php endif;?>
    <script src="../Issets/js/pacientes.js"></script>
    <script src="../Issets/js/main.js"></script>
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
</body>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>