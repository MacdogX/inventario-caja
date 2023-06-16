<?php
require_once '../controller/librery/database.php';
include '../controller/librery/librery.php';

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
        // Lógica para autenticar al usuario

        // Verificar si el correo y la contraseña son válidos
        if ($this->validarCredenciales()) {
            // Autenticación exitosa, iniciar sesión o redirigir al usuario a la página de inicio
          //  echo "Inicio de sesión exitoso";
            if($params = $this->traersession()){
                foreach ($params as $row) {
                    $id_rol = $row[4];
                    $id_nombre= $row[1];
                    $_SESSION['id_nombre']=$id_nombre;
                    $_SESSION['id_rol'] = $id_rol;
                }
                header("Location: ../view/inventario.php");
                 exit();

            }else{

            }



            
        } else {
            // Autenticación fallida, mostrar mensaje de error o redirigir al usuario a la página de inicio de sesión con un mensaje de error
            echo '
            <div role="alert">
                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                    Error de usuario
                </div>
                <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                    <p>Usuario o contraseña no existe </p>
                    <a href="../index.php">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Regresar
                    </button>
                  </a>
                </div>
            </div>
         ';
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];


    // Crear instancia de la clase Usuario
    $usuario = new Usuario($correo, $contrasena);

    // Autenticar al usuario
    $usuario->autenticar();
}

class SessionManager {
    public function logout() {
        // Iniciar sesión
        session_start();

        // Eliminar todas las variables de sesión
        $_SESSION = array();

        // Destruir la sesión
        session_destroy();

        // Redireccionar a la página de inicio de sesión u otra página deseada
        header("Location: /project-side-inventarioycaja/index.php");
        exit();
    }
}
?>