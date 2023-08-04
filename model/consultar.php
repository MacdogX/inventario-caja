<?php
require_once '../controller/librery/database.php';

class ProductosHelper{
    private $usuariocode;
    private $connection;

    public function __construct()
    {
        $this->connection = new Connection();
    }

    public function obtenerProductosPorFecha($fechaInicio, $fechaFin, $usuariocode) {
        try {
            $pdo = $this->connection->conexion();
        
            $query = "SELECT nombre, SUM(precio) AS precio, fecha_ingreso 
            FROM ventaproducto 
            WHERE id_emp = :id 
            AND DATE(fecha_ingreso) BETWEEN :fechaInicio 
             AND :fechaFin 
           GROUP BY nombre ORDER BY precio DESC";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $usuariocode);
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
if (isset($_GET["fechaInicio"]) && isset($_GET["fechaFin"])&& isset($_GET["usuariocode"])) {
    $fechaInicio = $_GET["fechaInicio"];
    $fechaFin = $_GET["fechaFin"];
    $usuariocode = $_GET["usuariocode"]; // Asigna el ID correspondiente (debes obtenerlo de alguna forma)

    // Realizar la consulta con las fechas seleccionadas
    $productosHelper = new ProductosHelper();
    $productos = $productosHelper->obtenerProductosPorFecha($fechaInicio, $fechaFin, $usuariocode);
    // Devolver los productos como JSON
    echo json_encode(array("productos" => $productos));
}
?>