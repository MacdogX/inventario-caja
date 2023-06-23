<?php 

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

?>

