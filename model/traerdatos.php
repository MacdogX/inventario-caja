<?php 

require_once '../controller/librery/database.php';
class datosproductos{

    private $connection;

    public function __construct() {
        $this->connection = new Connection();
    }

    public function obtenerProductos() {
        try{
        $pdo = $this->connection->conexion();
        $sql = "SELECT * FROM ventaproducto order by id desc";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $productos;
    }
    catch (PDOException $e) {
        die("Error al obtener los productos: " . $e->getMessage());
    }
    }

    public function obternerproducto(){

        try {
            $pdo = $this->connection->conexion();
            $sql = "SELECT * FROM productos order by id desc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $productos;
        } catch (\Throwable $th) {
            die("Error al obtener los productos: " . $th->getMessage());
        }
    }

}

?>

