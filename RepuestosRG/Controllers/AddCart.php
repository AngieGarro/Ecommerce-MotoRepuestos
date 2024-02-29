<?php
$productos = unserialize($_COOKIE['product'] ?? '');
if (!is_array($productos)) $productos = array();
$IsExistProduct = false;
foreach ($productos as $key => $value) {
    if ($value['id'] == $_REQUEST['id']) {
        $productos[$key]['cant'] = $productos[$key]['cant'] + $_REQUEST['cant'];
        $IsExistProduct = true;
    }
}
if (!$IsExistProduct) {
    $new = array(
        "id" => $_REQUEST['id'],
        "Name" => $_REQUEST['Name'], // Utilizar 'Name' en lugar de 'name'
        "Price" => $_REQUEST['Price'], // Utilizar 'Price' en lugar de 'price'
        "Files" => $_REQUEST['Files'], // Utilizar 'Files' en lugar de 'files'
        "cant" => $_REQUEST['cant']
    );
    array_push($productos, $new);
}
setcookie("product", serialize($productos));
echo json_encode($productos);
?>