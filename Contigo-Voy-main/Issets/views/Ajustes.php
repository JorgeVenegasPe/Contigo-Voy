<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModalAjustes()">&times;</span>
        <div class="checkout-information">
            <h2><?=$_SESSION['Usuario']?></h2>
            <h1 style="margin-top:-10px">#<?=$_SESSION['IdPsicologo']?></h1>
            <div class="input-group">
                <br>
                <h3 for="CodigoPaciente">Nombre</h3>
                <div style="display: flex; gap:25px;">
                    <input id="CodigoPaciente" type="text" name="CodigoPaciente" value="<?=$_SESSION['Usuario']?>"
                        required />
                    <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
                </div>
            </div>
            <div class="input-group">
                <h3 for="CodigoPaciente">Usuario</h3>
                <div style="display: flex; gap:25px;">
                    <input id="CodigoPaciente" type="text" name="CodigoPaciente"
                        value="<?=$_SESSION['NombrePsicologo']?>" required />
                    <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
                </div>
            </div>
            <div class="input-group">
                <h3 for="CodigoPaciente">Correo</h3>
                <div style="display: flex; gap:25px;">
                    <input id="CodigoPaciente" type="text" name="CodigoPaciente" value="<?=$_SESSION['email']?>"
                        required />
                    <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
                </div>
            </div>
            <div class="input-group">
                <h3 for="CodigoPaciente">Celular / Telefono</h3>
                <div style="display: flex; gap:25px;">
                    <input id="CodigoPaciente" type="text" name="CodigoPaciente" value="<?=$_SESSION['celular']?>"
                        required />
                    <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
                </div>
            </div>
            <div class="input-group">
                <h3 for="CodigoPaciente">Contraseña </h3>
                <div style="display: flex; gap:25px;">
                    <input id="CodigoPaciente" type="password" name="CodigoPaciente" value="<?=$_SESSION['Passwords']?>"
                        required />
                    <a style="font-size:15px; padding:2px 15px" class="search Codigo">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>