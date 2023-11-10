
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
                <p>| <b><?=$_SESSION['Usuario']?> | </b></p>
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
                    <h2><?=$_SESSION['Usuario']?></h2>
                    <h1 style="margin-top:-10px;text-align:center">#<?=$_SESSION['IdPsicologo']?></h1>
                </div>
                <a href="#" class="closeaaa" >&times;</a>
            </div>
            <div style="margin:20px">
                <div>
                    <h3 style="color:#49c691;font-size:17px" for="CodigoPaciente">Nombre</h3>
                    <div style="display: flex; gap:30px;">
                        <input id="CodigoPaciente" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;" type="text" name="CodigoPaciente" value="<?=$_SESSION['Usuario']?>"
                            required />
                        <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
                    </div>
                </div>
                <div>
                    <h3 style="color:#49c691;font-size:17px" for="CodigoPaciente">Usuario</h3>
                    <div style="display: flex; gap:30px;">
                        <input id="CodigoPaciente" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;" type="text" name="CodigoPaciente"
                            value="<?=$_SESSION['NombrePsicologo']?>" required />
                        <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
                    </div>
                </div>
                <div>
                    <h3 style="color:#49c691;font-size:17px" for="CodigoPaciente">Correo</h3>
                    <div style="display: flex; gap:30px;">
                        <input id="CodigoPaciente" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;" type="text" name="CodigoPaciente" value="<?=$_SESSION['email']?>"
                            required />
                        <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
                    </div>
                </div>
                <div>
                    <h3 style="color:#49c691;font-size:17px" for="CodigoPaciente">Celular / Telefono</h3>
                    <div style="display: flex; gap:30px;">
                        <input id="CodigoPaciente" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;" type="text" name="CodigoPaciente" value="<?=$_SESSION['celular']?>"
                            required />
                        <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
                    </div>
                </div>
                <div>
                    <h3 style="color:#49c691;font-size:17px" for="CodigoPaciente">Contraseña </h3>
                    <div style="display: flex; gap:30px;">
                        <input id="CodigoPaciente" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;" type="password" name="CodigoPaciente" value="<?=$_SESSION['Passwords']?>"
                            required />
                        <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
