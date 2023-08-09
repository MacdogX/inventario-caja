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
                <div class="col-span-3 md:col-span-1 bg-gray-800 p-4 flex flex-col items-center">
                    <!-- Modal toggle -->
                    <h2 class="text-white mb-4">Agregar productos al inventario</h2>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openModal()">Agregar Producto</button>
            </div>
       <div class="col-span-3 md:col-span-2 bg-gray-200 p-4">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="display responsive nowrap mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden" id="example">
                    <thead class="bg-gray-900 text-white uppercase">
                  <tr>
                      <th scope="col" class="font-semibold text-sm uppercase px-6 py-4 ">
                          Id de producto
                      </th>
                      <th scope="col" class="font-semibold text-sm uppercase px-6 py-4 ">
                          Nombre del producto
                      </th>
                      <th scope="col" class="font-semibold text-sm uppercase px-6 py-4 ">
                          Precio
                      </th>
                      <th scope="col" class="font-semibold text-sm uppercase px-6 py-4 ">
                          Acción
                      </th>
                  </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-gray-50">
                  <?php 
                  include_once '../model/traerdatos.php';
                  $datosProductos = new datosproductos();
                  $productos = $datosProductos->obternerproducto($id);
                  foreach ($productos as $productoItem):
                  ?>
                  <tr class="bg-blue-300 border-b border-blue-400">
                      <th scope="row" class="text-center px-6 py-4 font-medium text-blue-250 whitespace-nowrap dark:text-blue-200">
                          <?php echo $productoItem['id']; ?>
                      </th>
                      <td class="px-6 py-4 text-center">
                          <?php echo $productoItem['name_producto']; ?>
                      </td>
                      <td class="px-6 py-4 text-center">
                          <?php echo $productoItem['value_producto']; ?>
                      </td>
                      <td class="px-6 py-4 text-center">
                          <a href="#" class="text-white text-sm w-1/3 pb-1 bg-blue-400 font-semibold px-2 rounded-full" onclick="openEditModal(<?php echo $productoItem['id']; ?>, '<?php echo $productoItem['name_producto']; ?>', '<?php echo $productoItem['value_producto']; ?>')">
                              <i class="fas fa-pencil-alt mr-1"></i> Editar
                          </a>
                      </td>
                  </tr>
                  <?php endforeach; ?>
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
                    <input  oninput="convertirAMayusculas()" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="name" name="name" type="text" placeholder="Ingrese el nombre del producto" required>                    
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Precio del producto</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="description" name="description" type="number" rows="3" placeholder="Ingrese la descripción del producto" required>
                </div>
                <div class="flex justify-end">
                    <input type="hidden" value="1" id="value" name="value">
                    <input type="hidden" id="modalProductId" value="<?php echo $productoItem['id']; ?>">
                    <input type="hidden" id="usuariocode" name="usuariocode" value="<?php echo $id; ?>">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Guardar</button>
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2" onclick="closeModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div> 
<!-- Modal de edición -->


<div id="modalEditar" class="modal hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-8 rounded relative w-full max-w-lg max-h-ful">
    <h2 class="text-xl font-bold mb-4">Editar producto</h2>
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
        <form onsubmit="saveEditedProduct(); return false;">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">Nombre del producto:</label>
                <input oninput="convertirAMayusculas()" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="nombre" name="nombre" value="">
                </div>
                <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="precio">Precio:</label>
                <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="precio" name="precio" value="">
                </div>
                <div class="flex justify-end">
                <input type="hidden" value="2" id="value" name="value">
                <input type="hidden" id="usuariocode" name="usuariocode" value="<?php echo $id; ?>">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Guardar</button>
                <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2" type="button" onclick="closeEditModal()">Cancelar</button>
            </form>
            </div>
  
        </div>
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



<script src="../controller/script_productos.js"> </script>



<script >
/*
function displayResults(results) {
  var searchResults = document.getElementById('searchResults');
  searchResults.innerHTML = ''; // Limpiar resultados anteriores
  
  if (results.length === 0) {
    searchResults.innerHTML = 'No se encontraron resultados';
  } else {
    // Crear elementos para mostrar los resultados
    for (var i = 0; i < results.length; i++) {
      var result = results[i];
      var resultItem = document.createElement('div');
      resultItem.textContent = result.name + ' - ' + result.description;
      searchResults.appendChild(resultItem);
    }
  }
}
*/
</script>




</body>
</html>