<?php
require_once '../controller/librery/database.php';
class ingresoproductos
{
    private $connection;

    public function __construct()
    {
        $this->connection = new Connection();
    }
    
    public function guardarProducto($name, $description)
    {
        try {
            $pdo = $this->connection->conexion();
           
            $query = "INSERT INTO productos (name_producto, value_producto) VALUES (:name, :description)";
    
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo 'Error al guardar el producto: ' . $e->getMessage();
            return false;
        }
    }
}

// Obtener el valor enviado mediante la solicitud POST
$value = $_POST['value'];

// Verificar si el valor es igual a 1
if ($value == 1) {
    // Obtener los otros valores enviados mediante la solicitud POST
    $name = $_POST['name'];
    $description = $_POST['description'];
//echo "imprimir " .$name .$description;
    // Crear una instancia de la clase ingresoproductos
    $producto = new ingresoproductos();

    // Guardar el producto en la base de datos
    if ($producto->guardarProducto($name, $description)) {
        // El producto se guardó correctamente
        $response = array('status' => 'success');
    } else {
        // Hubo un error al guardar el producto
        $response = array('status' => 'error', 'message' => 'Error al guardar el producto en la base de datos.');
    }
} else {
    // El valor de 'value' no es igual a 1, no se ejecuta la función guardarProducto
    $response = array('status' => 'error', 'message' => 'El valor de "value" no es igual a 1.');
}

// Devolver la respuesta como JSON
echo json_encode($response);



?>