<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MotoRepuestosRG</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Styles/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Styles/css/adminlte.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="JS/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="JS/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="JS/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="JS/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="JS/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="JS/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="JS/plugins/summernote/summernote-bs4.min.css">
</head>
<?php
session_start();
        include_once 'Menu.php';
        include_once 'Models/User.php';
        include_once 'Controllers/User_Session.php';
        if(isset($_GET['Id_Client'])) {
            // Conectar a la base de datos
            include_once "Models/BD_Repuestos.php";
            $connection = mysqli_connect($host, $user, $pass, $db);
        
            // Obtener el ID del producto a editar
            $id_Order = mysqli_real_escape_string($connection, $_GET['Id_Client']);
        
            // Obtener los datos del producto a editar
            $query = "SELECT `Id_Client`, `Client_Name`, `Client_Phone`, `Client_Email`, `Client_Address`, `AmountTotal`, `OrderDate` 
            FROM `order_detail` WHERE Id_Client = '$id_Order'";
            $response = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($response);
             // Obtener el ID de la orden recién insertada
             //$id_Order = mysqli_insert_id($connection);
             $_SESSION['idVenta'] = $id_Order;
?>

<h2 class="ml-3">Factura Orden de Compra</h2>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
            <p><label for="">Compra realizada por: <?php echo  $row['Client_Name']; ?></label></p>
            <p><label for="">Fecha de la compra: <?php echo  $row['OrderDate']; ?></label></p>
            <h5>Detalles de productos</h5>
            <div class="table-responsive">
                    <table class="table table-striped table-inverse mt-2" id="tableCartOrder">
                        <thead class="thead-inverse">
                        <tr>
                          <th>Imagen</th>
                          <th>Nombre</th>
                          <th>Cantidad</th>
                          <th>Precio</th>
                          <th>Total</th>                   
                        </tr>
                        </thead>
                    <tbody> 
                    </tbody>
                    </table>
                </div>
                  <h5>Medio de Contacto</h5>
                  <div class="form-group">
                  <p><label for="">Telefono: <?php echo  $row['Client_Phone']; ?></label></p>
                  <p><label for="">Correo: <?php echo  $row['Client_Email']; ?></label></p>
                  <p><label for="">Dirección: <?php echo  $row['Client_Address']; ?></label></p>
                  </div>
                  <h5 class="ml-2"><strong>Total a pagar: ₡ <?php echo  $row['AmountTotal']; ?></strong></h5>
<!-- Formulario que va a enviar los datos al reporte de ventas -->
<?php
if(isset($_REQUEST['guardarOrder'])){
  include_once "Models/BD_Repuestos.php";
  $connection = mysqli_connect($host, $user, $pass, $db);

  $OrderId =  mysqli_real_escape_string($connection, $_POST['idOrderHidden'] ?? '');
  $product =  mysqli_real_escape_string($connection, $_POST['NameProductHidden'] ?? '');
  $total = mysqli_real_escape_string($connection, $_POST['TotalPagarHidden'] ?? '');
  $NameClient = mysqli_real_escape_string($connection, $_POST['NameClient'] ?? '');
  $dateOrder = mysqli_real_escape_string($connection, $_POST['OrderDateHidden'] ?? '');
  $contact = mysqli_real_escape_string($connection, $_POST['ClientContactHidden'] ?? '');
  $cant = mysqli_real_escape_string($connection, $_POST['CantidadHidden'] ?? '');
  $queryGuardar = "INSERT INTO `sale`(`id_Sale`, `User_idOrder`, `Date_Time`, `NameProducts`, `Total`, `Client_Name`, `Contact`,`Cant`) 
  VALUES (NULL,'$OrderId','$dateOrder','$product','$total','$NameClient','$contact','$cant')";
  $response = mysqli_query($connection, $queryGuardar);
  if($response){
  ?>
   <div class="alert alert-danger mt-2" id="alerta" role="alert">
          <strong>Enviada</strong>
      </div>
  <?php
  }
  else{
      ?>
      <div class="alert alert-danger" id="alerta" role="alert">
          <strong>Error</strong>
      </div>
      <?php
  }
}
?>
<form method="post">

<input type="hidden" id="idOrderHidden" name="idOrderHidden" value="<?php echo $id_Order ?>">
<input type="hidden" id="NameClient" name="NameClient" value="<?php echo  $row['Client_Name']; ?>">
<input type="hidden" id="OrderDateHidden" name="OrderDateHidden" value="<?php echo  $row['OrderDate']; ?>">
<input type="hidden" id="NameProductHidden" name="NameProductHidden" value="">
<input type="hidden" id="CantidadHidden" name="CantidadHidden" value="">
<input type="hidden" id="TotalPagarHidden" name="TotalPagarHidden" value="<?php echo  $row['AmountTotal']; ?>">
<input type="hidden" id="ClientContactHidden" name="ClientContactHidden" value="<?php echo 'Telefono: ', $row['Client_Phone'], ' Correo: ',$row['Client_Email'], ' Direccion: ',$row['Client_Address']; ?>">

<button type="submit" name="guardarOrder" class="btn btn-danger mt-3 mb-3">Enviar Orden</button>
<small class="text-muted">Envianos la orden a nuestro correo para que nosotros te contactemos.</small><br/>
</form>

<a target="_blank" href="ImprimirFactura.php?idVenta=<?php echo $id_Order ?>" class="btn btn-warning"><i class="fas fa-file-pdf"></i>Imprimir Comprobante</a>
<small class="text-muted">Descargue el comprobante de Compra</small><br/>
</div>
</div>
<?php
  }
  ?>
</div>
</div>
</div>


<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
    <strong>Copyright &copy; 2023 - Moto Repuestos RG</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="JS/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="JS/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="JS/adminlte.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="JS/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- ChartJS -->
<script src="JS/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="JS/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="JS/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="JS/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="JS/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="JS/plugins/moment/moment.min.js"></script>
<script src="JS/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="JS/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="JS/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="JS/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Functions -->
<script src="JS/dashboard.js"></script>
<script src="JS/Carrito.js"></script>
<script>
    // Espera 5 segundos y luego oculta la alerta
    setTimeout(function() {
        document.getElementById('alerta').style.display = 'none';
    }, 5000); // 5000 milisegundos = 5 segundos
</script>
</html>