<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link	href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="icon" href="Issets/images/contigovoyico.ico">
    <link rel="stylesheet" href="Issets/css/login.css" />
    <title>Psicologa</title>
</head>
<body>
  <div class="container">
		<span class="form__title">Acceder</span>
		<form method="post" action="Controlador/login/ControllerLogin.php" class="form">
			<div class="form__group">
				<i class="ri-user-line form__icon"></i>
				<input for="usu" 
          type="text" 
          placeholder="Usuario" 
          name="usu" id="usu" 
          required 
          class="form__input" />
				<span class="form__bar"></span>
			</div>
			<div class="form__group">
				<i class="ri-lock-line form__icon"></i>
				<input
					type="password"
					placeholder="Contraseña"
					required
          			name="pass" id="pass"
					class="form__input"
				/>
				<span class="form__bar"></span>
			</div>
			<br>
			<?php
			if(isset($_GET['error']) && $_GET['error'] == 1){
			    echo "<p class='form__switch2' >Usuario o password son invalidos</p>";
			}
			?>
			<button type="submit" class="form__button">Ingresar</button>
			
			<p class="form__switch">
				Olvidaste la Contraseña? <a href="#">Aqui</a>
			</p>
		</form>
	</div>
</html>
