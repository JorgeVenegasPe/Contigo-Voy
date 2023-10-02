<?php
session_start();
if (isset($_SESSION['NombrePsicologo'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../Issets/images/contigovoyico.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Issets/css/seguridad.css">
    <link rel="stylesheet" href="../Issets/css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Politicas y Seguridad</title>
</head>
<body>    
  <?php
    require("../Controlador/Paciente/ControllerPaciente.php");
    $obj = new usernameControlerPaciente();
    $departamentos = $obj->MostrarDepartamento();
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
      <body>
    <section class="wave-contenedor website">
        <img src="../Issets/images/1img.jpeg" alt="">
        <div class="contenedor-textos-main">
            <h5>CARACTERISTICAS</h5>
            <h2 class="titulo left"><strong>Seguridad</strong></h2> 
            <p class="parrafo">Nuestra prioridad número uno es la seguridad de los datos de pacientes,médicos y clínica. Protegemos toda la información de modo que sus datos estén completamente a salvo de tipos sin escrúpulos que tratarán de invadir su privacidad o la de sus pacientes.</p>

            <a href="" class="cta">Registrate gratis</a>
        </div>
    </section>
    <section class="info-last">
        <div class="contenedor last-section">
            <div class="contenedor-textos-main">
                <h2 class="titulo left"><strong>En Contigo Voy todo gira alrededor de conseguir la máxima seguridad</strong> </h2>
                <p class="parrafo">Garantizamos la seguridad de toda la información que ingresa en Contigo Voy.Todos sus datos están protegidos y almacenados disponibles en cualquier momento, incluso puede configurar diferentes niveles de acceso a la información para todos los miembros de su clínica o consultorio. Trabajamos para garantizar que trabaje con total confidencialidad.</p>
        <section id="caracteristicas">
        
            <ul>
                <li>✔️ Cifrado seguro de datos</li>
                <li>✔️ Copias de seguridad</li>
                <li>✔️ Control de acceso para sus trabajadores</li>
            </ul>
                
            
            </div>
            <img src="../Issets/images/confide.svg" alt="">
        </div>
    </section>
    <section class="info-last">

        <div class="contenedor last-section">
                <h2 class="titulo left"><strong>Así es cómo Contigo Voy mantiene todo bajo llave:</strong> </h2>
        <section id="caracteristicas">
        
            <ul>
                <li>✔️ Nos tomamos la ley GDPR muy en serio, y desarrollamos nuestro sistema bajo estas reglas desde el primer dia</li>
                <li>✔️ Acceso basado en roles para garantizar que sólo las personas asignadas puedan ver la información</li>
                <li>✔️ Certificado SSL de 2048 bits suministrado por Symantec Thawte, una autoridad con prestigio mundial</li>
                <li>✔️ Almacenamiento en la nube,con servidores en cada uno de los países donde estamos presentes</li>
                <li>✔️ Nuestros centros de datos son de alta seguridad utilizados por los principales bancos e instituciones finacieras</li>
                <li>✔️ Todos los datos que almacenamos están disponibles en todo momento para usted y pueden ser destruidos permanentemente.</li>
                <br><li>Ofrezca a sus pacientes y colegas las protección que merecen</li>
              </ul>
    </section>
</body>
<script src="../Issets/js/dashboard.js"></script>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>