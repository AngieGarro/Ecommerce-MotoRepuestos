<?php
$productos = unserialize($_COOKIE['product'] ??'');
echo json_encode($productos);
?>