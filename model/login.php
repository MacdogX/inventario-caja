<?php
require_once '../controller/librery/database.php';


class Usuario

{
    private $connection;
    private $correo;
    private $contrasena;
   

    public function __construct($correo, $contrasena)
    {
        $this->connection = new Connection();
        $this->correo = $correo;
        $this->contrasena = $contrasena;
    
    }
    
    // Getter y Setter para la propiedad "correo"
    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    // Getter y Setter para la propiedad "contrasena"
    public function getContrasena() {
        return $this->contrasena;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function autenticar()
    {
        if ($this->validarCredenciales()) {
            
            session_start();

            $_SESSION['correo'] = $this->correo;
            $usuario = $this->obtenerNombreUsuario();
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['id'] = $usuario['id'];

            echo '<script>window.location.href = "../view/inventario.php";</script>';
            exit();
        } else {
            // Autenticación fallida, mostrar mensaje de error
            echo "Credenciales inválidas";
        }
    }

    private function obtenerNombreUsuario()
    {
        $pdo = $this->connection->conexion();
        $query = "SELECT nombre,id FROM usuarios WHERE email = :correo";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':correo', $this->correo);
        $statement->execute();
        $usuario = $statement->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            return $usuario;
        } else {
            return "";
        }
    }

    private function traersession()
        {
             $pdo = $this->connection->conexion();
             $query = "SELECT * FROM usuarios where email = :correo";
             $statement = $pdo->prepare($query);
             $statement->bindParam(':correo', $this->correo);
             $statement->execute();
             $params = array();
             $params = $statement->fetchAll(PDO::FETCH_ASSOC);
         
             return $params;
        
        }

    private function validarCredenciales()
    {
        // Lógica para validar las credenciales en la base de datos
        // Obtener la contraseña almacenada en la base de datos para el correo dado
        $pdo = $this->connection->conexion();
        $query = "SELECT * FROM usuarios WHERE email = :correo";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':correo', $this->correo);
        $statement->execute();
        $usuario = $statement->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Verificar si la contraseña ingresada coincide con la contraseña almacenada en la base de datos
            if (password_verify($this->contrasena, $usuario['contraseña'])) {
                return true; // Credenciales válidas
             
            } else {
                return false; // Contraseña inválida
              
            }
        } else {
            return false; // El correo ingresado no existe en la base de datos
        } 
    }

}

class SessionManager {
    public function logout() {
         // Iniciar el almacenamiento en búfer de salida
         ob_start();

         // Iniciar sesión
 
         // Eliminar todas las variables de sesión
         $_SESSION = array();
         // Destruir la sesión
         session_destroy();
         
         // Detener el almacenamiento en búfer y enviar la salida al navegador
         ob_end_flush();
 
         // Redireccionar a la página de inicio de sesión u otra página deseada

         echo '<script>window.location.href = "../index.php";</script>';
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];


    // Crear instancia de la clase Usuario
    $usuario = new Usuario($correo, $contrasena);

    // Autenticar al usuario
    $usuario->autenticar();
   
}






?>