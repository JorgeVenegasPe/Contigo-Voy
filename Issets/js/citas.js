
// JavaScript para habilitar la funcionalidad de selección de todos los checkboxes
document.getElementById('checkboxPrincipal').addEventListener('change', function() {

    var checkboxes = document.querySelectorAll(
    '.checkbox'); 
    for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = this
        .checked; 
    }
    });
      
    
    $(document).ready(function() {
    $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    });
    });
    
    // Agrega un evento de clic al botón "Eliminar Seleccionados"
    document.getElementById('eliminarSeleccionados').addEventListener('click', function() {
    var checkboxes = document.querySelectorAll(
    '.checkbox:checked'); // Obtén todos los checkboxes marcados
    var idsAEliminar = [];
    
    // Recorre los checkboxes seleccionados y obtén sus valores (IDs)
    checkboxes.forEach(function(checkbox) {
    idsAEliminar.push(checkbox.value);
    });
    
    // Verifica si se han seleccionado checkboxes
    if (idsAEliminar.length > 0) {
    // Realiza la solicitud para eliminar registros desde la base de datos
    eliminarRegistros(idsAEliminar);
    } else {
    alert('Por favor, selecciona al menos un paciente para eliminar.');
    }
    });
    
    // Función para eliminar registros desde la base de datos
    function eliminarRegistros(idsAEliminar) {
    // Realiza una solicitud AJAX para enviar los IDs a tu script de eliminación en el servidor
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../Crud/Fetch/eliminar_citas.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Define lo que hacer cuando la solicitud se complete
    xhr.onload = function() {
    if (xhr.status === 200) {
        // Recarga la página o actualiza la tabla después de eliminar
        location.reload();
    } else {
        console.error('Error en la solicitud: ' + xhr.statusText);
    }
    };
    
    // Envia la solicitud con los IDs a eliminar
    xhr.send('ids=' + JSON.stringify(idsAEliminar));
    }
    
    var checkboxes = document.querySelectorAll(".checkbox");
    var botonEliminar = document.getElementById("eliminarSeleccionados");
    
    checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener("change", function() {
    var almenosUnCheckboxSeleccionado = false;
    
    checkboxes.forEach(function(cb) {
        if (cb.checked) {
            almenosUnCheckboxSeleccionado = true;
            return;
        }
    });
    
    if (almenosUnCheckboxSeleccionado) {
        botonEliminar.style.display = "flex";
    } else {
        botonEliminar.style.display = "none";
    }
    });
    });
    
    var checkboxPrincipal = document.getElementById("checkboxPrincipal");
    var botonEliminar = document.getElementById("eliminarSeleccionados");
    
    checkboxPrincipal.addEventListener("change", function() {
    if (checkboxPrincipal.checked) {
    botonEliminar.style.display = "flex";
    } else {
    botonEliminar.style.display = "none";
    }

    
    });
    