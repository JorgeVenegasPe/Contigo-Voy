<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
</head>
<body>
<aside>
    <div class="top">
        <div class="logo">
            <img src="../Issets/images/contigovoy.png" alt="">
            <h2>Psicologa</h2>
        </div>
        <div class="close" id="close-btn">
            <span class="material-symbols-sharp" translate="no">close</span>
        </div>
    </div>
    <div class="sidebar">
        <a class="dashboard" href="Dashboards.php" >
            <span class="material-symbols-sharp" translate="no">dashboard</span>
            <h3>Dashboard</h3>
        </a>
        <a class="pacientes" href="TablaPacientes.php">
            <span class="material-symbols-sharp" translate="no">groups</span>
            <h3>Pacientes</h3>
        </a>
        <a class="citas" href="TablaCitas.php">
            <span class="material-symbols-sharp" translate="no">volunteer_activism</span>
            <h3>Citas</h3>
        </a>        
        <a class="historial" href="Historial.php">
            <span class="material-symbols-sharp" translate="no">history</span>
            <h3>Historial</h3>
        </a>
        <a class="calendario" href="Calendario.php">
            <span class="material-symbols-sharp" translate="no">calendar_month</span>
            <h3>Calendario</h3>
        </a>
        <a class="planes" href="Salir.php">
            <span class="material-symbols-sharp" translate="no">account_balance_wallet</span>
            <h3>Planes</h3>
        </a>
        <a class="privacidad" href="PoliticasSeguridad.php">
            <span class="material-symbols-sharp" translate="no">security</span>
            <h3>Politcas y Privacidad</h3>
        </a>
    </div>
    <div class="nav-menu-btn"></div>  
</aside>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const currentPage = window.location.pathname;

    const links = document.querySelectorAll('aside .sidebar a');

    links.forEach(link => {
      const linkHref = link.getAttribute('href');
      if (currentPage.includes(linkHref)) {
        link.classList.add('active');
      }
    });
  });
</script>
</body>
</html>