<?php
require_once '../controller/librery/database.php';
class ingresoproductos
{
    private $connection;

    public function __construct()
    {
        $this->connection = new Connection();
    }
    
    public function guardarProducto($name, $description, $id)
    {
        try {
            $pdo = $this->connection->conexion();
        
            $query = "INSERT INTO productos (name_producto, value_producto,emp_producto) VALUES (:name, :description, :emp_producto)";
    
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':emp_producto', $id);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo 'Error al guardar el producto: ' . $e->getMessage();
            return false;
        }
    }
}

class actualizarproducto {


    private $connection;
    public function __construct()
    {
        $this->connection = new Connection();
    }
    public function updateproducto($nombre, $precio, $id)
    {
        
        try {
            $pdo = $this->connection->conexion();
        
           // $query = "INSERT INTO productos (name_producto, value_producto,emp_producto) VALUES (:name, :description, :emp_producto)";
            $query = "UPDATE productos SET name_producto = :nombre, value_producto = :precio where id =:id ";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo 'Error al guardar el producto: ' . $e->getMessage();
            return false;
        }

    }

}
class eliminarproducto {

    private $connection;

    public function __construct()
    {
        $this->connection = new Connection();
    }

    public function eliminar($id)
    {
        
        try {
            $pdo = $this->connection->conexion();
        
           // $query = "INSERT INTO productos (name_producto, value_producto,emp_producto) VALUES (:name, :description, :emp_producto)";
            $query = "DELETE FROM ventaproducto WHERE `ventaproducto`.`id` =:id ";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
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
    $id = $_POST['usuariocode'];
    //echo "imprimir " .$name .$description;
    // Crear una instancia de la clase ingresoproductos
    $producto = new ingresoproductos();

    // Guardar el producto en la base de datos
    if ($producto->guardarProducto($name, $description, $id)) {
        // El producto se guardó correctamente
        $response = array('status' => 'success');
    } else {
        // Hubo un error al guardar el producto
        $response = array('status' => 'error', 'message' => 'Error al guardar el producto en la base de datos.');
    }
}elseif($value == 3){
        $id = $_POST['eliminar-id'];
           
            $eliminar = new eliminarproducto();

        if($eliminar->eliminar($id)){
            $response = array('status' => 'success');
            } else {
                // Hubo un error al guardar el producto
                $response = array('status' => 'error', 'message' => 'Error al guardar el producto en la base de datos.');
            }

    
}elseif($value == 2){
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $idusuario = $_POST['usuariocode']; // Cambiar 'id' por 'usuariocode'
    $id = $_POST['productId'];
    $producto = new actualizarproducto();
    if ($producto->updateproducto($nombre, $precio, $id)) {
        $response = array('status' => 'success');
    } else {
        // Hubo un error al guardar el producto
        $response = array('status' => 'error', 'message' => 'Error al actualizar el producto en la base de datos.');
    }
} else {
    // El valor de 'value' no es igual a 1, no se ejecuta la función guardarProducto
    $response = array('status' => 'error', 'message' => 'El valor de "value" no es igual a 1.');
}

// Devolver la respuesta como JSON
echo json_encode($response);



?>