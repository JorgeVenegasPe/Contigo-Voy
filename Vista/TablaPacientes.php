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
                            <th style="text-align: start; " >Paciente</th>
                            <th class="additional-column">Id</th>
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
                                    <td style="width: 8%;  padding: 18px;">
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
                                        <a class="button_1" style="display:none;   width: 110px; padding:6px; font-size:10px;margin-top: 4.5%;margin-bottom: 0%;" href="RegCitas.php">
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
                                            <a class="button" style="width: 110px; padding:6px; font-size:10px;" href="RegCitas.php">                                        
                                                    <span class="material-symbols-sharp">add</span>Crear Cita                                                                                                            
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown ">
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
    <script src="../Issets/js/Dashboard.js"></script>
    <script src="../Issets/js/pacientes.js"></script>
</body>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>