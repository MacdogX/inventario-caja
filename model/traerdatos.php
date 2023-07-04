<?php 
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

require_once '../controller/librery/database.php';
class datosproductos{

    private $id;
    private $connection;
 

    public function __construct() {
        $this->connection = new Connection();
        
    }
    public function getId() {
        return $this->id;
    }

    public function setid($id) {
        $this->id = $id;
    }

    public function obtenerProductos($id) {
        try{
        $pdo = $this->connection->conexion();
        $sql = "SELECT * FROM ventaproducto WHERE id_emp = :id ORDER BY id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $productos;
    }
    catch (PDOException $e) {
        die("Error al obtener los productos: " . $e->getMessage());
    }
    }

    public function obternerproducto($id){

        try {
            $pdo = $this->connection->conexion();
            $sql = "SELECT * FROM productos where emp_producto = :id order by id desc";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $productos;
        } catch (\Throwable $th) {
            die("Error al obtener los productos: " . $th->getMessage());
        }
    }

}





class VentasStatistics {
    private $id;
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function obtenerVentasPorNombre($id) {
        try {
            // Consulta SQL para obtener los datos de ventas por nombre

            $pdo = $this->connection->conexion();
            $sql = "SELECT nombre, SUM(precio) AS ganancia_total FROM ventaproducto where id_emp = :id AND  DATE(fecha_ingreso) = CURDATE() GROUP BY nombre ORDER BY ganancia_total DESC limit 10";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            // Ejecutar la consulta
            $stmt->execute();
            // Obtener los resultados de la consulta
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Crear arrays para almacenar los datos de nombres y ganancias
            $nombres = array();
            $ganancias = array();
            // Recorrer los resultados de la consulta y almacenar los datos en los arrays
            foreach ($result as $row) {
                $nombres[] = $row['nombre'];
                $ganancias[] = $row['ganancia_total'];
            }
            return array('nombres' => $nombres, 'ganancias' => $ganancias);
        } catch(PDOException $e) {
            // Manejo de errores en caso de que ocurra una excepción PDO
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
}


class Filtrarestadistica {
    private $id;
    public $inicio;
    public $final;
    private $connection;
    public function __construct($connection) {
        $this->connection = $connection;
    }


    public function getInicio() {
        return $this->inicio;
    }

    public function setInicio($inicio) {
        $this->id = $inicio;
    }

    public function getFinal() {
        return $this->final;
    }

    public function setid($final) {
        $this->final = $final;
    }


    public function filtrarfecha($inicio,$final){

        $results = [];
        $pdo = $this->connection->conexion();
        $query = "SELECT * FROM productos WHERE fecha_ingreso between :inicio and :final and name_producto LIKE :nombre";
        $stmt = $pdo->prepare($query);
       // $stmt->bindParam(':nombre', "%$nombre%", PDO::PARAM_STR);
        $stmt->bindParam(':inicio', $inicio);
        $stmt->bindParam(':final', $final);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = [
              'nombre' => $row['name_producto'],
              'descripcion' => $row['id']
            ];
          }
      
          return $results;
    
    }


}

class VentaTotal {
    private $connection;
    private $id;

public function __construct($connection) {
        $this->connection = $connection;
    }
public function obtenerValorTotal($id) {
        try{

        $pdo = $this->connection->conexion();
        $sql = "SELECT SUM(precio) AS ganancia_total FROM ventaproducto WHERE id_emp = :id and DATE(fecha_ingreso) = CURDATE();";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
       

        return $stmt;
    }
    catch (PDOException $e) {
        die("Error al obtener los productos: " . $e->getMessage());
    }
    }


}

?>

