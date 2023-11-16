<?php
// Incluye tus archivos con las clases necesarias
require_once('../Controlador/Paciente/ControllerPaciente.php');
require_once('../Modelo/Paciente/ModelPaciente.php');

// Crea una instancia del controlador y del modelo
$Psi = new usernameControlerPaciente();
$psicologo = $Psi->showPsicologo($_SESSION['IdPsicologo']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardarCambios'])) {
    // Obtén el ID del psicólogo desde el formulario
    $idPsicologo = $_POST['idPsicologo'];

    // Obtén otros datos del formulario
    $nombre = $_POST['nombreInput'];
    $usuario = $_POST['usuarioInput'];
    $correo = $_POST['correoInput'];
    $celular = $_POST['celularInput'];
    $contrasena = $_POST['contrasenaInput'];

    // Crea una instancia del controlador y utiliza el método para actualizar los datos
    $Psi = new usernameControlerPaciente();
    $result = $Psi->updatePsicologo($idPsicologo, $nombre, $usuario, $correo, $celular, $contrasena);

    // Verifica el resultado de la actualización
    if ($result) {
        // Actualización exitosa, redirige a la misma página para reflejar los cambios
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Manejar el caso en que la actualización falla
        echo "Error al actualizar los datos.";
    }
}
?>
<style>

</style>
<!-- El resto de tu código HTML y JavaScript -->
<div class="top">
    <button id="menu-btn" style="display: none;">
        <span class="material-symbols-sharp" translate="no">menu</span>
    </button>
    <div class="theme-toggler">
        <span class="material-symbols-sharp active" translate="no">light_mode</span>
        <span class="material-symbols-sharp" translate="no">dark_mode</span>
    </div>
    <div>
        <div>
            <a class="ajuste-info">
                <span class="material-symbols-sharp" translate="no">settings</span>
            </a>
        </div>
    </div>
    <div class="profile">
        <div class="info">
            <p>| <b><?= $_SESSION['Usuario'] ?> | </b></p>
        </div>
    </div>
    <a href="../issets/views/Salir.php">
        <h3 class="cerrar-info">Cerrar Sesion</h3>
    </a>
</div>
<div class="navigation">
    <div class="form-info">
        <div style="display:flex;margin:1em;gap:20px">
            <div>
                <h2><?= $_SESSION['Usuario'] ?></h2>
                <h1 style="margin-top:-10px;text-align:center">#<?= $_SESSION['IdPsicologo'] ?></h1>
            </div>
            <a href="#" class="closeaaa">&times;</a>
        </div>
        <form method="post" action="">
            <div style="margin:20px">
                <div>
                    <h3 style="color:#49c691;font-size:17px; text-align:start;" for="nombreInput">Nombre</h3>
                    <div style="display: flex; gap:30px;">
                        <input id="nombreInput" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px; margin-bottom: 10px;" type="text" name="nombreInput" value="<?= $psicologo['Usuario'] ?>" readonly />
                        <a style="font-size:15px; padding:2px 15px" class="search Codigo" onclick="habilitarEdicion('nombreInput')">Editar</a>
                    </div>
                </div>
                <div>
                    <h3 style="color:#49c691;font-size:17px;text-align:start;" for="usuarioInput">Usuario</h3>
                    <div style="display: flex; gap:30px;">
                        <input id="usuarioInput" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;margin-bottom: 10px;" type="text" name="usuarioInput" value="<?= $psicologo['NombrePsicologo'] ?>" readonly />
                        <a style="font-size:15px; padding:2px 15px" class="search Codigo" onclick="habilitarEdicion('usuarioInput')">Editar</a>
                    </div>
                </div>
                <div>
                    <h3 style="color:#49c691;font-size:17px;text-align:start;" for="correoInput">Correo</h3>
                    <div style="display: flex; gap:30px;">
                        <input id="correoInput" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;margin-bottom: 10px;" type="text" name="correoInput" value="<?= $psicologo['email'] ?>" readonly />

                        <a style="font-size:15px; padding:2px 15px" class="search Codigo" onclick="habilitarEdicion('correoInput')">Editar</a>
                    </div>
                </div>
                <div>
                    <h3 style="color:#49c691;font-size:17px;text-align:start;" for="celularInput">Celular / Telefono</h3>
                    <div style="display: flex; gap:30px;">
                        <input id="celularInput" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;margin-bottom: 10px;" type="text" name="celularInput" value="<?= $psicologo['celular'] ?>" readonly />
                        <a style="font-size:15px; padding:2px 15px" class="search Codigo" onclick="habilitarEdicion('celularInput')">Editar</a>
                    </div>
                </div>
                <div>
                    <h3 style="color:#49c691;font-size:17px;text-align:start;" for="contrasenaInput">Contraseña</h3>
                    <div style="display: flex; gap:30px;">
                        <input id="contrasenaInput" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;margin-bottom: 10px;" type="password" name="contrasenaInput" value="<?= $psicologo['Passwords'] ?>" readonly />
                        <a style="font-size:15px; padding:2px 15px" class="search Codigo" onclick="habilitarEdicion('contrasenaInput')">Editar</a>
                    </div>
                </div>
                <!-- Agrega el siguiente botón de guardar al final del formulario -->
                <input type="hidden" name="idPsicologo" value="<?= $_SESSION['IdPsicologo'] ?>">

                <button style="font-size:15px; padding:2px 15px; margin-top:10px;" class="search Codigo" type="submit" name="guardarCambios" onclick="guardarCambios()">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
<script>
    function habilitarEdicion(inputId) {
        var input = document.getElementById(inputId);
        input.readOnly = false;
    }

    function guardarCambios() {
        // Puedes agregar lógica adicional aquí si es necesario
        // Deshabilita la edición en todos los campos
        document.getElementById('nombreInput').readOnly = true;
        document.getElementById('usuarioInput').readOnly = true;
        document.getElementById('correoInput').readOnly = true;
        document.getElementById('celularInput').readOnly = true;
        document.getElementById('contrasenaInput').readOnly = true;
        // ... (Deshabilita otros campos)
    }
</script>

<script>
    // Añade un evento para restablecer los campos a solo lectura al cerrar el modal
    document.querySelector('.closeaaa').addEventListener('click', function() {
        document.getElementById('nombreInput').readOnly = true;
        document.getElementById('usuarioInput').readOnly = true;
        document.getElementById('correoInput').readOnly = true;
        document.getElementById('celularInput').readOnly = true;
        document.getElementById('contrasenaInput').readOnly = true;
        // ... (Restablece otros campos a solo lectura)
    });
</script>