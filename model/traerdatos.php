<?php 

require_once '../controller/librery/database.php';
class datosproductos{

    private $connection;

    public function __construct() {
        $this->connection = new Connection();
    }

    public function obtenerProductos() {
        $pdo = $this->connection->conexion();
        $sql = "SELECT * FROM productos";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $productos;
    }

    public function mostrarTablaProductos() {
        $productos = $this->obtenerProductos();

        // Verificar si se obtuvieron productos
        if (empty($productos)) {
            echo "No se encontraron productos";
            return;
        }

    
        // Crear la tabla
        echo "<tr>";
     
        // Iterar sobre los productos y mostrarlos en la tabla
        foreach ($productos as $producto) {
            $nombre = $producto['nombre'];
            $cantidad = $producto['cantidad'];
            $precio = $producto['precio'];
        
            echo '<tr class="bg-gray-100 hover:bg-gray-200">';
            echo "<td class='border px-6 py-2'>$nombre</td>";
            echo "<td class='border px-6 py-2'>$cantidad</td>";
            echo "<td class='border px-6 py-2'>$precio</td>";
            echo "<td class='border px-6 py-2'>action</td>";
            echo '</tr>';
        }

       // echo "</tr>";
    }
}

?>

