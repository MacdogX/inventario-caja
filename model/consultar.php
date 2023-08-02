<?php
require_once '../controller/librery/database.php';

class ProductosHelper{
    private $id;
    private $connection;

    public function __construct()
    {
        $this->connection = new Connection();
    }

    public function obtenerProductosPorFecha($fechaInicio, $fechaFin, $id) {
        try {
            $pdo = $this->connection->conexion();
        
            $query = "SELECT nombre, SUM(precio) AS precio, fecha_ingreso FROM ventaproducto WHERE id_emp = :id AND fecha_ingreso >= :fechaInicio AND fecha_ingreso <= :fechaFin GROUP BY nombre ORDER BY precio DESC";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':fechaInicio', $fechaInicio);
            $stmt->bindParam(':fechaFin', $fechaFin);
            $stmt->execute();

            $productosFiltrados = array();
            foreach ($stmt as $producto) {
                $productosFiltrados[] = array(
                    "nombre" => $producto["nombre"],
                    "precio" => $producto["precio"]
                );
            }
            return $productosFiltrados;
        } catch (PDOException $e) {
            echo 'Error al obtener los productos: ' . $e->getMessage();
            return false;
        }
    }
}

// Obtener los parámetros de fecha enviados por GET
if (isset($_GET["fechaInicio"]) && isset($_GET["fechaFin"])) {
    $fechaInicio = $_GET["fechaInicio"];
    $fechaFin = $_GET["fechaFin"];
    $id = 8; // Asigna el ID correspondiente (debes obtenerlo de alguna forma)

    // Realizar la consulta con las fechas seleccionadas
    $productosHelper = new ProductosHelper();
    $productos = $productosHelper->obtenerProductosPorFecha($fechaInicio, $fechaFin, $id);
    // Devolver los productos como JSON
    echo json_encode(array("productos" => $productos));
}
?>