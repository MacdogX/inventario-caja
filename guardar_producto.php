<?php
/**
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Ruta al archivo JSON de las credenciales del servicio de Firebase
$factory = (new Factory)
     ->withServiceAccount(__DIR__.'/ahorros.json')
     ->withDatabaseUri('https://ahorros-79cd8-default-rtdb.firebaseio.com');

$database = $factory->createDatabase();

// Obtener una referencia a la colección "products"
$productsRef = $database->getReference('products');

// Crear un nuevo producto
$newProduct = [
    'name' => 'Product Name',
    'price' => 9.99,
    'description' => 'Product description',
];

// Guardar el nuevo producto en Firebase
$productRef = $productsRef->push($newProduct);

// Obtener el ID del nuevo producto
$productId = $productRef->getKey();

echo "El producto se ha guardado correctamente. ID: " . $productId;


*/


require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Ruta al archivo JSON de las credenciales del servicio de Firebase
/*
$factory = (new Factory)
     ->withServiceAccount(__DIR__.'/ahorros.json')
     ->withDatabaseUri('https://ahorros-79cd8-default-rtdb.firebaseio.com');
     */


     use \Firebase\JWT\JWT;
     
     $firebaseConfig = [
       'projectId' => 'your-project-id',
       'clientId' => 'your-client-id',
       'clientEmail' => 'your-client-email',
       'privateKey' => 'your-private-key',
     ];
     

$factory = (new Factory)
     ->withServiceAccount(__DIR__.'/ahorros.json')
     ->withDatabaseUri('https://ahorros-79cd8-default-rtdb.firebaseio.com');

$database = $factory->createDatabase();

// Obtener una referencia a la colección "products"
$productsRef = $database->getReference('products');

// Obtener los datos del formulario
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];

// Crear un nuevo producto
$newProduct = [
    'name' => $name,
    'price' => $price,
    'description' => $description,
];

// Guardar el nuevo producto en Firebase
$productRef = $productsRef->push($newProduct);

// Obtener el ID del nuevo producto
$productId = $productRef->getKey();
?>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
<?php
echo "El producto se ha guardado correctamente. ID: " . $productId;
// Botón de regresar a index.html
echo '<br><br><a href="index.html" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Volver</a>';
?>