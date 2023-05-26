<?php

class Usuario
{
    private $correo;
    private $contrasena;

    public function __construct($correo, $contrasena)
    {
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
            echo "Inicio de sesión exitoso";
            header("Location: ../view/inventario.php");
            exit();
        } else {
            // Autenticación fallida, mostrar mensaje de error o redirigir al usuario a la página de inicio de sesión con un mensaje de error
            echo "Credenciales inválidas";
         
        }
    }

    private function validarCredenciales()
    {
        // Lógica para validar las credenciales en la base de datos

        // Obtener la contraseña almacenada en la base de datos para el correo dado
        $pdo = new PDO("mysql:host=localhost;dbname=principal", "root", "");
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