<?php
// Establecer los datos de conexión a la base de datos

require_once '../controller/librery/database.php';

class automodalproductos{
    private $connection;

  public function __construct() {
    $this->connection = new Connection();
  }
    public function buscarproductos(){
    try {

        $pdo = $this->connection->conexion();
    
        // Configurar el modo de error para lanzar excepciones en caso de errores
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Obtener el término de búsqueda enviado por AJAX
        if (isset($_GET['term'])) {
            $term = $_GET['term'];
    
            // Construir la consulta SQL con parámetros para evitar la inyección de SQL
            $query = "SELECT name_producto, value_producto FROM productos WHERE name_producto LIKE :term";
    
            // Preparar la consulta
            $statement = $pdo->prepare($query);
    
            // Verificar si hay errores en la preparación de la consulta
            if (!$statement) {
                die('Error en la consulta: ' . $pdo->errorInfo()[2]);
            }
    
            // Agregar el comodín '%' al término de búsqueda
            $searchTerm = '%' . $term . '%';
    
            // Asignar el término de búsqueda al parámetro de la consulta
            $statement->bindParam(':term', $searchTerm);
    
            // Ejecutar la consulta
            $statement->execute();
    
            // Obtener el resultado de la consulta
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
            // Crear un array para almacenar las sugerencias
            $suggestions = [];
    
            // Recorrer los resultados y agregarlos al array de sugerencias
            foreach ($result as $row) {
                $suggestion = [
                    'label' => $row['name_producto'], // etiqueta que se mostrará en la lista de autocompletado
                    'value' => $row['value_producto'] // valor que se asignará al campo de texto
                ];
    
                $suggestions[] = $suggestion;
            }
    
            // Enviar la respuesta como JSON
            header('Content-Type: application/json');
            echo json_encode($suggestions);
        }
    } catch (PDOException $e) {
        // Mostrar el mensaje de error en caso de que ocurra una excepción
        echo 'Error de conexión a la base de datos: ' . $e->getMessage();
    }
}

}


$mostrarconsulta = new automodalproductos();
$mostrarconsulta->buscarproductos();


?>