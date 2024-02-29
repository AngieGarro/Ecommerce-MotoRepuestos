<?php
    $productos=unserialize($_COOKIE['product']);
    foreach ($productos as $key => $value) {
        if($_REQUEST['id']==$value['id']){
            if($_REQUEST['type']=="mas")
                $productos[$key]['cant']++;
            else
                $productos[$key]['cant']--;
        }
    }
    setcookie("product",serialize($productos));
    echo json_encode($productos);
?>