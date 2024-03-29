// Realiza el llamado del datable 

$(document).ready(function () {
  $('#example').DataTable({
      "pageLength": 15,
      order: [[0, 'desc']],
      columnDefs: [
        { responsivePriority: 1, targets: 0 }, // Primera columna
        { responsivePriority: 2, targets: 1 }, // Segunda columna
      ],
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        search: 'Buscar producto',
    }, 
    responsive: true,
    
  });

});





var table = $('#example').DataTable();
 
$('#container').css( 'display', 'block' );
table.columns.adjust().draw();


//Transforma las letras de los productos en mayuscula
function convertirAMayusculas() {
  var inputName = document.getElementById('name');
  var inputNombre = document.getElementById('nombre');
  inputName.value = inputName.value.toUpperCase();
  inputNombre.value = inputNombre.value.toUpperCase();
}

// abre el modal que ingresa los productos y lo cierra
function openModal() {
  document.getElementById('modal').classList.remove('hidden');
}
function closeModal() {
  document.getElementById('modal').classList.add('hidden');
}
//  function guarda los productos  ingresados por el modal
function saveProduct() {
      // Obtener los valores de los campos del formulario
      var name = document.getElementById('name').value;
      var description = document.getElementById('description').value;
      var value = document.getElementById('value').value;
      var usuariocode = document.getElementById('usuariocode').value;

      // Crear un objeto FormData para enviar los datos del formulario
      var formData = new FormData();
      formData.append('name', name);
      formData.append('description', description);
      formData.append('value', value);
      formData.append('usuariocode', usuariocode);

      // Crear y configurar la petición AJAX
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../model/modelos.php', true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          // La petición se completó exitosamente
          var response = JSON.parse(xhr.responseText);
          // Manejar la respuesta del servidor
          if (response.status === 'success') {
            console.log('Producto guardado correctamente');
            // Cerrar el modal y restablecer los campos
            closeModal();
            document.getElementById('name').value = '';
            document.getElementById('description').value = '';
            document.getElementById('usuariocode').value = '';
            window.location.reload();
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

// La función para abrir el modal de edición
function openEditModal(id, nombre, precio) {
  document.getElementById('modalProductId').value = id; // Asignar el ID al campo oculto
  document.getElementById('modalEditar').classList.remove('hidden');
  // Poblar los campos del formulario del modal de edición
  document.getElementById('nombre').value = nombre;
  document.getElementById('precio').value = precio;
}

// La función para cerrar el modal de edición

function closeEditModal() {
  document.getElementById('modalEditar').classList.add('hidden');
  // Restablecer los campos del formulario al cerrar el modal
  document.getElementById('nombre').value = '';
  document.getElementById('precio').value = '';
}


function saveEditedProduct() {
  var productId = document.getElementById('modalProductId').value; // Obtener el ID del campo oculto
  var nombre = document.getElementById('nombre').value;
  var precio = document.getElementById('precio').value;
  var value = document.getElementById('value').value = 2;
  var usuariocode = document.getElementById('usuariocode').value;

  var formData = new FormData();
  formData.append('productId', productId); // Agregar el ID a los datos enviados
  formData.append('nombre', nombre);
  formData.append('precio', precio);
  formData.append('value', value);
  formData.append('usuariocode', usuariocode);
var xhr = new XMLHttpRequest();
      xhr.open('POST', '../model/modelos.php', true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          // La petición se completó exitosamente
          var response = JSON.parse(xhr.responseText);
          // Manejar la respuesta del servidor
          if (response.status === 'success') {
            console.log('Producto guardado correctamente');
            // Cerrar el modal y restablecer los campos
            closeEditModal();
            document.getElementById('nombre').value = '';
            document.getElementById('precio').value = '';
            document.getElementById('usuariocode').value = '';
            window.location.reload();
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

function deleteProduct() {
  var productId = document.getElementById('modalProductId').value;
  var value = document.getElementById('value').value = 4; // Valor para indicar eliminación
  var usuariocode = document.getElementById('usuariocode').value;

  var formData = new FormData();
  formData.append('productId', productId);
  formData.append('value', value);
  formData.append('usuariocode', usuariocode);

  var xhr = new XMLHttpRequest();
  xhr.open('POST', '../model/modelos.php', true);
  xhr.onload = function () {
      if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.status === 'success') {
              console.log('Producto eliminado correctamente');
              closeEditModal();
              document.getElementById('nombre').value = '';
              document.getElementById('precio').value = '';
              document.getElementById('usuariocode').value = '';
              window.location.reload();
          } else {
              console.error('Error al eliminar el producto: ' + response.message);
          }
      } else {
          console.error('Error en la petición AJAX');
      }
  };
  xhr.send(formData);
}



