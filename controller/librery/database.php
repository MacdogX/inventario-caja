<?php
class Connection {
    private $driver = "mysql";
    private $host = "localhost";
    private $user = "root";
    private $pass = '';
    private $dbName = "principal";
    private $charset = "utf8";
  
    protected function conexion() {
      try {
        $pdo = new PDO("{$this->driver}:host={$this->host};dbname={$this->dbName};charset={$this->charset}", $this->user, $this->pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
      } catch (PDOException $e) {
        die($e->getMessage());
      }
    }

    public function testConnection() {
        $pdo = $this->conexion();
        if ($pdo) {
       //   echo "Conexión exitosa a la base de datos";
        } else {
          echo "Error al conectar con la base de datos";
        }
      }
      public function guardarProducto($nombre, $cantidad, $precio)
    {
        try {
            $pdo = $this->conexion();
            $sql = "INSERT INTO productos (nombre, cantidad, precio) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nombre, $cantidad, $precio]);
            echo "Producto guardado correctamente";
        } catch (PDOException $e) {
            echo "Error al guardar el producto: " . $e->getMessage();
        }
    }
  

    
  }



  $connection = new Connection();
  $connection->testConnection();
  ?>
