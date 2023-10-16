
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
                <a class="ajuste-info" style="cursor:pointer;" onclick="openModalAjustes()">
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
<script>
    function openModalAjustes() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    }
    function closeModalAjustes() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
 </script>