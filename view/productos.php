<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../controller/librery/librery.php';?>
    <title>Productos</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css"0>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="../controller/table.css">
</head>
<body>
<?php  include '../view/nav/nav.php'; 
        require_once '../model/guardar_producto.php';
        // Crear una instancia de la clase Database
        $database = new Connection;
?>

<div class="container mx-auto">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3 md:col-span-1 bg-gray-500 p-4 flex justify-center items-center">
                    <!-- Modal toggle -->
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openModal()">Agregar Producto</button>
            </div>
       <div class="col-span-3 md:col-span-2 bg-gray-200 p-4">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="display responsive nowrap  w-full text-sm text-left text-blue-300 dark:text-blue-100 py-6" id="example">
                    <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Id de producto
                            </th>
                            <th scope="col" class="px-6 py-3">
                               Nombre del producto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3">
                               Accion
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-blue-300 border-b border-blue-400">
                            <th scope="row" class="text-center px-6 py-4 font-medium text-blue-250 whitespace-nowrap dark:text-blue-200">
                                1
                            </th>
                            <td class="px-6 py-4 text-center ">
                               Gaseosa
                            </td>
                            <td class="px-6 py-4 text-center ">
                                $2999
                            </td>
                            <td class="px-6 py-4 text-center ">
                                <a href="#" class="font-medium text-white hover:underline">Editar</a>
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    

    
    <div id="modal" class="modal hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-8 rounded relative w-full max-w-lg max-h-ful">
            <h2 class="text-xl font-bold mb-4">Ingreso de Producto</h2>
            <form onsubmit="saveProduct(); return false;">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre Del producto:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="name" name="name" type="text" placeholder="Ingrese el nombre del producto" required>                    
                </div>
                <!--
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Cantidad:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="price" name="price" type="number" step="0.01" placeholder="Ingrese el precio del producto" required>
                </div>
-->

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Precio del producto</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="description" name="description" type="number" rows="3" placeholder="Ingrese la descripción del producto" required>
                </div>
                <div class="flex justify-end">
                    <input type="hidden" value="1" id="value"" name="value">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Guardar</button>
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2" onclick="closeModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div> 
    
    
    
   





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css"0>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<script>
    $(document).ready(function () {
    $('#example').DataTable({
        order: [[0, 'desc']],
    });
});

</script>
<script>
function saveProduct() {
 // Obtener los valores de los campos del formulario
 var name = document.getElementById('name').value;
var description = document.getElementById('description').value;
var value = document.getElementById('value').value;

    // Crear un objeto FormData para enviar los datos del formulario
    var formData = new FormData();
    formData.append('name', name);
    formData.append('description', description);
    formData.append('value' value);

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
                closeModal();
                document.getElementById('name').value = '';
                document.getElementById('description').value = '';
                window.location.reload()
               
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
</body>
</html>