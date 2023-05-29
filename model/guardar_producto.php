<?php

require_once '../../librery/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $db = new Connection();
    $db->guardarProducto($name, $price, $description);
    $db->cerrarConexion();
}


?>