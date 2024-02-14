<?php
$productos = unserialize($_COOKIE['product']);

$id = $_POST['id'];
$name = $_POST['Name'];
$price = $_POST['Price'];
$files = $_POST['Files'];

$productos[] = array(
    "id" => $id,
    "Name" => $name,
    "Price" => $price,
    "Files" => $files
);

setcookie("product", serialize($productos));
echo json_encode($productos);
?>
