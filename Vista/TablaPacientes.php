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
                                        <input type="checkbox" class="checkbox" id="checkbox<?=$row[0]?>" value="<?=$row[0]?>">
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
                                        <div class="dropdown">
                                            <button class="buttonTab"><span class="material-symbols-sharp">more_vert</span></button>
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
    <script src="../Issets/js/dashboard.js"></script>
    <script src="../Issets/js/pacientes.js"></script>
</body>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>