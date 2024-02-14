<?php
$productos = unserialize($_COOKIE['product']);
foreach ($productos as $key => $value) {
    if ($_REQUEST['id'] == $value['id']) {
        unset($productos[$key]);
    }
}
$productos = array_values($productos); // Reinicia el array a partir de cero para que los índices estén correctamente numerados.
setcookie("product", serialize($productos));
echo json_encode($productos);
?>