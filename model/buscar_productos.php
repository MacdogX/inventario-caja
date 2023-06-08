<?php
require_once '../controller/librery/database.php';

class ArchivoHandler {
  private $connection;

  public function __construct() {
    $this->connection = new Connection();
  }

  public function buscarProductos() {
    if (isset($_POST['nombre'])) {
      $nombre = $_POST['nombre'];

      // Hacer la búsqueda en la base de datos
      $results = $this->buscarEnBaseDeDatos($nombre);

      // Enviar una respuesta al cliente en formato JSON
      $response = [
        'status' => 'success',
        'data' => $results
      ];
      header('Content-Type: application/json');
      echo json_encode($response);
    } else {
      // No se recibió ningún nombre
      $response = [
        'status' => 'error',
        'message' => 'No se recibió ningún nombre'
      ];
      header('Content-Type: application/json');
      echo json_encode($response);
    }
  }

  private function buscarEnBaseDeDatos($nombre) {
    // Aquí debes implementar la lógica de búsqueda en tu base de datos
    // Utiliza $this->connection para acceder a la conexión a la base de datos
    // ...

    $results = [];

    // Ejemplo de consulta ficticia utilizando $this->connection
    $pdo = $this->connection->conexion();

    // Consulta SQL con parámetros para evitar la inyección de SQL
    $query = "SELECT * FROM productos WHERE name_producto LIKE :nombre";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':nombre', "%$nombre%", PDO::PARAM_STR);
    $stmt->execute();

    // Obtener los resultados de la consulta
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $results[] = [
        'nombre' => $row['name_producto'],
        'descripcion' => $row['id']
      ];
    }

    return $results;
  }
}

// Crear una instancia del controlador y llamar al método adecuado
$archivoHandler = new ArchivoHandler();
$archivoHandler->buscarProductos();
?>
