<?php
class ProductosHelper {
    public static function obtenerProductosPorFecha($fechaInicio, $fechaFin) {
        $productos = array(
            array("nombre" => "Producto 1", "precio" => 150, "fecha" => "2023-07-01"),
            array("nombre" => "Producto 2", "precio" => 200, "fecha" => "2023-07-02"),
            array("nombre" => "Producto 3", "precio" => 120, "fecha" => "2023-07-03"),
            array("nombre" => "Producto 4", "precio" => 300, "fecha" => "2023-07-04"),
            array("nombre" => "Producto 5", "precio" => 180, "fecha" => "2023-07-05"),
            array("nombre" => "Producto 1", "precio" => 150, "fecha" => "2023-07-01"),
            array("nombre" => "Producto 2", "precio" => 200, "fecha" => "2023-07-02"),
            array("nombre" => "Producto 3", "precio" => 120, "fecha" => "2023-07-03"),
            array("nombre" => "Producto 4", "precio" => 300, "fecha" => "2023-07-04"),
            array("nombre" => "Producto 5", "precio" => 180, "fecha" => "2023-07-05"),
            array("nombre" => "Producto 1", "precio" => 150, "fecha" => "2023-07-01"),
            array("nombre" => "Producto 2", "precio" => 200, "fecha" => "2023-07-02"),
            array("nombre" => "Producto 3", "precio" => 120, "fecha" => "2023-07-03"),
            array("nombre" => "Producto 4", "precio" => 300, "fecha" => "2023-07-04"),
            array("nombre" => "Producto 5", "precio" => 180, "fecha" => "2023-07-05")
        );

        $productosFiltrados = array();
        foreach ($productos as $producto) {
            if ($producto["fecha"] >= $fechaInicio && $producto["fecha"] <= $fechaFin) {
                $productosFiltrados[] = $producto;
            }
        }

        return $productosFiltrados;
    }
}

// Obtener los parámetros de fecha enviados por GET
if (isset($_GET["fechaInicio"]) && isset($_GET["fechaFin"])) {
    $fechaInicio = $_GET["fechaInicio"];
    $fechaFin = $_GET["fechaFin"];

    // Realizar la consulta con las fechas seleccionadas
    $productos = ProductosHelper::obtenerProductosPorFecha($fechaInicio, $fechaFin);
    // Devolver los productos como JSON
    echo json_encode(array("productos" => $productos));
}
?>