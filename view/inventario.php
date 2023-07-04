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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
</head>
<body>
        <?php  include '../view/nav/nav.php'; 
        require_once '../model/guardar_producto.php';
        // Crear una instancia de la clase Database
        $database = new Connection;
         ?>
<div class="container mx-auto">
    <div class="grid grid-cols-3 gap-4">
    <div class="col-span-3 md:col-span-1 bg-gray-800 p-4 flex flex-col items-center">
    <!-- Modal toggle -->
    <h2 class="text-white mb-4">Modulo de Ventas diarias</h2>
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openModal()">Agregar Producto</button>
</div>
        <div class="col-span-3 md:col-span-2 bg-gray-200 p-4">
            <!-- table -->
            <div class="flex flex-col justify-center items-center">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border rounded-lg overflow-hidden dark:border-gray-700">
                            <table id='example' class='display responsive nowrap mb-12 col-12 text-base sm:text-sm md:text-base table-condensed bg-gray-50 ' style='width:100%'>
                                <thead class="bg-blue-600 text-white uppercase">
                                    <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase ">Id</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase ">Cantidad</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase ">Precio</th>
                                        <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-white uppercase ">Producto</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-white uppercase ">Acción</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-gray-50">
                                    <?php 
                                  
                                    include_once '../model/traerdatos.php';
                                    $datosProductos = new datosproductos();
                                     
                                    $productos = $datosProductos->obtenerProductos($id);
                                    foreach ($productos as $producto): ?>
                                    <tr>
                                        <td class="sm:text-xs md:text-sm"><?php echo $producto['id']; ?></td>
                                        <td class="sm:text-xs md:text-sm"><?php echo $producto['cantidad']; ?></td>
                                        <td class="sm:text-xs md:text-sm"><?php echo $producto['precio']; ?></td>
                                        <td class="sm:text-xs md:text-sm"><?php  $nombreReducido = strlen($producto['nombre']) > 10 ? substr($producto['nombre'], 0, 10) . "..." : $producto['nombre']; echo $nombreReducido; ?></td>
                                        <td class="sm:text-xs md:text-sm">action</td>
                                       
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
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="name" name="name" type="text" placeholder="Ingrese el nombre del producto" oninput="convertirAMayusculas()" required>                    
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Cantidad:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="price" name="price" type="number" step="0.01" placeholder="Ingrese el precio del producto" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Precio</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="description" name="description" type="number" rows="3" placeholder="Ingrese la descripción del producto" required>
                </div>
                <div class="flex justify-end">
                <input type="hidden" id="usuariocode" name="usuariocode" value="<?php echo $id; ?>">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Guardar</button>
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2" onclick="closeModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" />
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
</script>

<script>
    $(document).ready(function () {
    $('#example').DataTable({
        order: [[0, 'desc']],
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