<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../controller/librery/librery.php';?>
    <title>Document</title>
</head>
<body>
    
        <?php  include '../view/nav/nav.php'; 
        require_once '../model/guardar_producto.php';

        // Crear una instancia de la clase Database
        $database = new Connection;


        ?>


        <div class="container mx-auto">
          <div class="grid grid-cols-3 gap-4">
            <div class="col-span-3 md:col-span-1 bg-gray-800 p-4 flex justify-center items-center">
                 <!-- Modal toggle -->
                 <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openModal()">Agregar Producto</button>

        </div>
        <div class="col-span-3 md:col-span-2 bg-gray-200 p-4">
        <!--table-->
        <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
          <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="border rounded-lg overflow-hidden dark:border-gray-700">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>

                            <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Age</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Address</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">John Brown</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">45</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">New York No. 1 Lake Park</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a class="text-blue-500 hover:text-blue-700" href="#">Delete</a>
                            </td>
                            </tr>

                            <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">Jim Green</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">27</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">London No. 1 Lake Park</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a class="text-blue-500 hover:text-blue-700" href="#">Delete</a>
                            </td>
                            </tr>

                            <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">Joe Black</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">31</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">Sidney No. 1 Lake Park</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a class="text-blue-500 hover:text-blue-700" href="#">Delete</a>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                </div>

        </div>


        <!-- Modal -->
        <div id="modal" class="modal hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-8 rounded relative w-full max-w-lg max-h-ful">
            <h2 class="text-xl font-bold mb-4">Ingreso de Producto</h2>
            <form action="guardar_producto.php" method="POST" id="productForm">
                <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" id="name" name="name" type="text" placeholder="Ingrese el nombre del producto" required>
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
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="button" onclick="saveProduct()">Guardar</button>
                  <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2" onclick="closeModal()">Cancelar</button>
                </div>
                
            </form>
            </div>
        </div>
        
     </div>

</div>
<script>

   function saveProduct() {
    // Obtener los valores de los campos del formulario
    var name = document.getElementById('name').value;
    var price = document.getElementById('price').value;
    var description = document.getElementById('description').value;

    // Crear un objeto FormData para enviar los datos del formulario
    var formData = new FormData();
    formData.append('name', name);
    formData.append('price', price);
    formData.append('description', description);

    // Crear y configurar la petición AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../model/guardar_producto.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // La petición se completó exitosamente
            var response = xhr.responseText;
            // Manejar la respuesta del servidor
            console.log(response);
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