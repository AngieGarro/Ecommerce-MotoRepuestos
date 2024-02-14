<?php
include "../Models/BD_Repuestos.php";

// insert data to database
if ($_GET["action"] === "insertData") {
	if (!empty($_POST["Name"]) && !empty($_POST["Detail"]) && !empty($_POST["Price"]) && !empty($_POST["Code_Product"]) && $_FILES["Files"]["size"] != 0) {
	  $product_name = mysqli_real_escape_string($conn, $_POST["Name"]);
	  $detail = mysqli_real_escape_string($conn, $_POST["Detail"]);
	  $price = mysqli_real_escape_string($conn, $_POST["Price"]);
	  $code = mysqli_real_escape_string($conn, $_POST["Code_Product"]);
  
	  // rename the image before saving to database
	  $original_name = $_FILES["Files"]["name"];
	  $new_name = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
	  move_uploaded_file($_FILES["Files"]["tmp_name"], "uploads/" . $new_name);
  
	  $query = "INSERT INTO `product`(`id`, `Name`, `Detail`, `Price`, `Code_Product`, `Files`) VALUES (NULL,'$product_name','$detail','$price','$code','$new_name')";
  
	  if (mysqli_query($conn, $query)) {
		echo json_encode([
		  "statusCode" => 200,
		  "message" => "Producto creado exitosamente 😀"
		]);
	  } else {
		echo json_encode([
		  "statusCode" => 500,
		  "message" => "Fallo registro 😓"
		]);
	  }
	} else {
	  echo json_encode([
		"statusCode" => 400,
		"message" => "Por favor, complete los campos requeridos 🙏"
	  ]);
	}
  }
?>