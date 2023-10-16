function convertirAMayusculas() {
    var input = document.getElementById('name');
    input.value = input.value.toUpperCase();
}
function saveProduct() {
    // Obtener los valores de los campos del formulario
   var name = document.getElementById('name').value;
    var price = document.getElementById('price').value;
    var description = document.getElementById('description').value;
    var usuariocode = document.getElementById('usuariocode').value;
    // Crear un objeto FormData para enviar los datos del formulario
    var formData = new FormData();
    formData.append('name', name);
    formData.append('price', price);
    formData.append('description', description);
    formData.append('usuariocode', usuariocode);
    

    // Crear y configurar la petición AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../model/guardar_producto.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // La petición se completó exitosamente
            var response = JSON.parse(xhr.responseText);
            // Manejar la respuesta del servidor
            if (response.status === 'success') {
                console.log('Producto guardado correctamente');
                // Cerrar el modal y restablecer los campos
             
                document.getElementById('name').value = '';
                document.getElementById('price').value = '';
                document.getElementById('description').value = '';
                document.getElementById('usuariocode').value = '';
                window.location.reload();
                closeModal();
               
            } else {
                console.error('Error al guardar el producto: ' + response.message);
            }
        } else {
            // Hubo un error en la petición
            console.error('Error en la petición AJAX');
        }
    };
    xhr.send(formData);
  }
      function openModal() {
        document.getElementById('modal').classList.remove('hidden');
      }
      function closeModal() {
        document.getElementById('modal').classList.add('hidden');
      }

      function openEliminar(id, cantidad, precio, nombre) {
    document.getElementById("eliminarModal").classList.remove("hidden");
    document.getElementById("eliminar-id").textContent = id;
    document.getElementById("eliminar-cantidad").textContent = cantidad;
    document.getElementById("eliminar-precio").textContent = precio;
    document.getElementById("eliminar-nombre").textContent = nombre;
    document.getElementById("value").value = id; // Setear el ID para usarlo en la función eliminar
            }

    
            function eliminarProductoAjax(id, value) {
                var formData = new FormData();
                formData.append('eliminar-id', id);
                formData.append('value', value);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../model/modelos.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            console.log('Producto eliminado');
                            // Cerrar el modal de eliminación
                            closeEliminar();
                            window.location.reload();
                            // Actualizar la tabla de productos (puedes hacerlo mediante AJAX aquí o recargar la página)
                            // ...
                        } else {
                            console.error('Error al eliminar el producto: ' + response.message);
                        }
                    } else {
                        console.error('Error en la petición AJAX');
                    }
                };
                xhr.send(formData);
            }

            function closeEliminar() {
                document.getElementById("eliminarModal").classList.add("hidden");
            }

            function eliminarProducto() {
                const id = document.getElementById("eliminar-id").textContent; // Obtener el ID del span
                const value = 3;

                eliminarProductoAjax(id, value);
            }
  

