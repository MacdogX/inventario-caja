<?php
class ArchivoHandler {
    public function recibirNombre() {
      if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
  
        // Hacer algo con el valor recibido, como guardarlo en la base de datos o procesarlo de alguna manera
  
        // Enviar una respuesta al cliente
        echo "El nombre recibido es: " . $nombre;
      } else {
        echo "No se recibió ningún nombre";
      }
    }
  }
  
  // Crear una instancia del controlador y llamar al método adecuado
  $archivoHandler = new ArchivoHandler();
  $archivoHandler->recibirNombre();
?>