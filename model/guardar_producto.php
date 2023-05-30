<?php

require_once '../controller/librery/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $db = new Connection();
    $db->guardarProducto($name, $price, $description);
  
}



?>