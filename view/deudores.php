<?php
require_once '../model/login.php';
session_start();
if (isset($_SESSION['correo'])) {
    $correo = $_SESSION['correo'];
    $nombre = $_SESSION['nombre'];
    $id = $_SESSION['id'];

 //  echo "Bienvenido, $nombre ($correo)($id)";
}  else {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>deudores</title>
    <?php include '../controller/librery/librery.php';?>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css"0>
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="../controller/table.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css"0>
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
</head>
<body>
<?php  
        include '../view/nav/nav.php'; 
        require_once '../model/guardar_producto.php';
        // Crear una instancia de la clase Database
        $database = new Connection;
?>

<div class="container mx-auto">
                <!--Barra De INFORMACION DE ENTORNO  -->
                    <div class="col-span-3 md:col-span-1 bg-gray-800 p-4 flex flex-col items-center">
                        <h2 class="text-white mb-4">Modulo de Deudores</h2>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg" onclick="openModal()">Agregar Deuda</button>
                    </div>
                <!--Barra Final De INFORMACION DE ENTORNO  -->

</div>



</body>
</html>