<?php

class Usuario {
    private $id;
    private $nombre;
    private $email;
    private $contraseña;
    private $rol;
    private $fecha_registro;
    

    public function __construct($nombre, $email, $contraseña, $rol = 'usuario') {
        $this->nombre = $nombre;
        $this->email = $email;
        $opciones = [
            'cost' => 8, // Nivel de hash (mayor es más seguro pero más lento)
        ];
        $this->contraseña = password_hash($contraseña, PASSWORD_DEFAULT, $opciones);
    
        $this->rol = $rol;
        $this->fecha_registro = date('Y-m-d H:i:s');
 
    }

    // Métodos getter y setter

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getContraseña() {
        return $this->contraseña;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getFechaRegistro() {
        return $this->fecha_registro;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Otros métodos

    public function guardarUsuario() {
        // Lógica para guardar el usuario en la base de datos
        
        // Verificar si el correo electrónico ya existe
        $pdo = new PDO("mysql:host=localhost;dbname=principal", "root", "");
        $query = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':email', $this->email);
        $statement->execute();
        
        $count = $statement->fetchColumn();
        
        if ($count > 0) {
            // El correo electrónico ya está registrado, puedes mostrar un mensaje de error o realizar alguna acción
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            '<script>
            Swal.fire({
             icon: 'error',
             title: 'Error',
             text: '¡Correo ya se encuentra regisrado!',
             showConfirmButton: true,
             confirmButtonText: 'Cerrar'
             }).then(function(result){
                if(result.value){                   
                 window.location = '../index.php';
                }
             });
            </script>';
            ";
            return;
        }

        // El correo electrónico no existe, proceder a guardar el usuario en la base de datos

        $query = "INSERT INTO usuarios (nombre, email, contraseña, rol, fecha_registro)
        VALUES (:nombre, :email, :contrasena, :rol, :fecha_registro)";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':nombre', $this->nombre);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':contrasena', $this->contraseña);
        $statement->bindParam(':rol', $this->rol);
        $statement->bindParam(':fecha_registro', $this->fecha_registro);
        $statement->execute();
        
        // Si necesitas obtener el ID generado por AUTO_INCREMENT
        $this->id = $pdo->lastInsertId();
    }
}

// Obtener los valores enviados a través de $_POST
$nombre = $_POST['nombres'];
$email = $_POST['email'];
$contraseña = $_POST['password'];

// Crear una instancia de la clase Usuario con los valores obtenidos
$usuario = new Usuario($nombre, $email, $contraseña);

// Guardar el usuario en la base de datos
$usuario->guardarUsuario();