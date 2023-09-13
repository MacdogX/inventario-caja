<?php 
require_once '../model/login.php';
session_start();
if (isset($_SESSION['correo'])) {
    $correo = $_SESSION['correo'];
    $nombre = $_SESSION['nombre'];
    $id = $_SESSION['id'];

 //  echo "Bienvenido, $nombre ($correo)($id)";
}  else {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../controller/librery/librery.php';?>
    <title>Document</title>
    <!-- Librerías jQuery y DataTables -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <!-- Otras librerías y estilos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css">

    <style>
       /* #example {
            font: 90%/1.15em "Helvetica Neue", HelveticaNeue, Helvetica, Arial, sans-serif !important;
        }*/
        div#example_filter {
                margin-bottom: 15px;
            }
            body{
    font-family: 'Maven Pro', sans-serif;
    font-family: 'Permanent Marker', cursive;
    font-family: 'Playfair Display', serif;
    font-family: 'Roboto', sans-serif;
    font-weight: 600;
   
}
.col-span-3.md\:col-span-1.bg-indigo-800.p-4.flex.flex-col.items-center {
    font-weight: 600;
}
.font-medium {
    font-weight: 600;
}
li {
  /*   word-break: break-all !important;
    white-space: nowrap !important;
   width: 150px !important;*/
}
td.sm\:text-xs.md\:text-sm.prueba.dtr-hidden {
    word-break: break-all !important;
    white-space: nowrap !important;
    width: 150px !important;
}
.flex.flex-col.items-center.bg-indigo-800.p-4 {
    font-weight: 800;
}
td.sm\:text-xs.md\:text-sm.text-center {
    font-size: 16px;
}
td {
    white-space: nowrap; /* Impide que los datos se envuelvan */
    overflow: hidden; /* Oculta el contenido que desborda */
    text-overflow: ellipsis; /* Agrega puntos suspensivos (...) si el contenido es demasiado ancho */
    padding: 8px;
  }


  li {
    text-wrap: initial;
    white-space:normal;
   /* width:200px;*/
}



    </style>
</head>
<body>
        <?php  include '../view/nav/nav.php'; 
        require_once '../model/guardar_producto.php';
        // Crear una instancia de la clase Database
        $database = new Connection;
         ?>
<div class="container mx-auto">
    <div class="grid grid-cols-3 gap-4">
    <div class="col-span-3 md:col-span-1 bg-indigo-800 p-2flex flex-col items-center">
    <!-- Modal toggle -->
    <div class="flex flex-col items-center bg-indigo-800 p-4">
        <h2 class="text-white dark:text-black-600 mb-4 flex items-center ">
            <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
            Módulo de Registro de Ventas
        </h2>
        <button class="flex items-center bg-yellow-400 text-white hover:bg-gray-100 hover:text-gray-700 px-4 py-2 rounded-lg" onclick="openModal()">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-700" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 0a1 1 0 0 1 1 1v8h8a1 1 0 0 1 0 2h-8v8a1 1 0 0 1-2 0v-8H1a1 1 0 1 1 0-2h8V1a1 1 0 0 1 1-1z"/>
            </svg>
            Agregar producto
        </button>
    </div>
    
   <!-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openModal()">Agregar Producto</button>-->
</div>
        <div class="col-span-3 md:col-span-2 p-2">
            <!-- table -->

            <div class="col-span-3 md:col-span-2 p-4">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table id='example' class='display responsive nowrap mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden' style='width:100%'>
                                <thead class="bg-indigo-800">
                                    <tr class="text-white text-center">
                                        <th scope="col" class="font-semibold text-sm uppercase px-6 py-4 text-center">Id</th>
                                        <th scope="col" class="font-semibold text-sm uppercase px-6 py-4 text-center">Cantidad</th>
                                        <th scope="col" class="font-semibold text-sm uppercase px-6 py-4 text-center">Precio</th>
                                        <th scope="col" class="font-semibold text-sm uppercase px-6 py-4 text-center">Acción</th>
                                        <th scope="col" class="font-semibold text-sm uppercase px-6 py-4 text-center prueba ">Producto</th>
                                     </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-gray-50">
                                    <?php 
                                  
                                    include_once '../model/traerdatos.php';
                                    $datosProductos = new datosproductos();
                                     
                                    $productos = $datosProductos->obtenerProductos($id);
                                    foreach ($productos as $producto): ?>
                                    <tr>
                                        <td class="sm:text-xs md:text-sm text-center"><?php echo $producto['id']; ?></td>
                                        <td class="sm:text-xs md:text-sm text-center"><?php echo $producto['cantidad']; ?></td>
                                        <td class="sm:text-xs md:text-sm"><?php echo $producto['precio']; ?></td>
                                        
                                        <td class="sm:text-xs md:text-sm text-center"> 
                                        <a href="#" class="text-white text-sm bg-green-400 font-semibold px-2 rounded-full" onclick="openEliminar(<?php echo $producto['id']; ?>, '<?php echo $producto['cantidad']; ?>', '<?php echo $producto['precio']; ?>', '<?php echo $producto['nombre']; ?>')">Eliminar</a>   
                                        </td>
                                        
                                        <td class="sm:text-xs md:text-sm prueba"><?php echo $producto['nombre']; ?></td>
                                    <!--    <td class="sm:text-xs md:text-sm text-center"><?php  $nombreReducido = strlen($producto['nombre']) > 27 ? substr($producto['nombre'], 0, 27) . "..." : $producto['nombre']; echo $nombreReducido; ?></td>-->
                                       
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Candidad</th>
                                        <th>Precio</th>
                                        <th>Producto</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                    
                </div>
            </div>
        </div>
        <div>
        </div>
    </div>
   
    <div id="modal" class="modal hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-8 rounded relative w-full max-w-lg max-h-ful">
            <h2 class="text-xl font-bold mb-4">Ingreso de Producto</h2>
            <form id="productForm" onsubmit="saveProduct(); return false;">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre Producto:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="name" name="name" type="text" placeholder="Ingrese el nombre del producto" oninput="convertirAMayusculas()" required>                    
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Cantidad:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="price" name="price" type="number" step="0.01" placeholder="Ingrese la cantidad" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Precio</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="description" name="description" type="number" rows="3" placeholder="$$$ Ingrese el precio" required>
                </div>
                <div class="flex justify-end">
                <input type="hidden" id="usuariocode" name="usuariocode" value="<?php echo $id; ?>">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Guardar</button>
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2" onclick="closeModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>


<!--MODAL PARA ELIMINAR -->

<!-- Modal de confirmación -->
<div id="eliminarModal" class="fixed inset-0 flex items-center justify-center z-10 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h3 class="text-center text-lg font-semibold mb-4">¿Desea eliminar?</h3>
        <p class="mb-2"><strong>ID:</strong> <span id="eliminar-id"></span></p>
        <p class="mb-2"><strong>Cantidad:</strong> <span id="eliminar-cantidad"></span></p>
        <p class="mb-2"><strong>Precio:</strong> <span id="eliminar-precio"></span></p>
        <p class="mb-4"><strong>Nombre:</strong> <span id="eliminar-nombre"></span></p>
        <div class="flex justify-center space-x-4">
         <input type="hidden" value="3" id="value" name="value">
    
         <button class="text-green-400 font-semibold px-2 rounded-full" onclick="eliminarProducto()">Sí</button>
<button class="text-red-400 font-semibold px-2 rounded-full" onclick="closeEliminar()">No</button>
        </div>
    </div>
</div>

<!-- MODAL ELEMINAR FINAL -->


</div>


    

<script>

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
  
    // Función para eliminar el producto
   /* function eliminar() {
        const id = document.getElementById("eliminar-id").value;
        // Realiza la lógica para eliminar el producto con el ID "id"
        // ...
        closeEliminar(); // Cierra el modal después de eliminar
    }*/
</script>


<script>
    $(document).ready(function () {
    $('#example').DataTable({
        "pageLength": 15,
        order: [[0, 'desc']], 
        language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    },
    });
});
</script>


<script>
$(document).ready(function(){
    $("#name").autocomplete({
        source: "../model/autocomplete.php",
        minLength: 2,
        select: function(event, ui) {
            // Obtener el valor seleccionado del campo de texto
            var selectedlabel = ui.item.label;

            // Autocompletar el campo textbox con el valor seleccionado
            setTimeout(function(){
                $("#name").val(selectedlabel);
            }, 0);
        }
    });
    
    $("#name").on("autocompleteselect", function(event, ui) {
        // Obtener el valor seleccionado del campo de texto
        var selectedValue = ui.item.value;

        // Asignar el valor seleccionado al campo textmax
        $("#description").val(selectedValue);
      });
});
function convertirAMayusculas() {
            var input = document.getElementById('name');
            input.value = input.value.toUpperCase();
        }
</script>
</body>
</html>

