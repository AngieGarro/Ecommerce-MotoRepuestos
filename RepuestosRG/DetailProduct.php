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
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Selección de Producto</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php
if(isset($_GET['id'])) {
    // Conectar a la base de datos
    include_once "Models/BD_Repuestos.php";
    $connection = mysqli_connect($host, $user, $pass, $db);

    // Obtener el ID del producto a editar
    $id = mysqli_real_escape_string($connection, $_GET['id']);

    // Obtener los datos del producto a editar
    $query = "SELECT * FROM product WHERE id = '$id'";
    $response = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($response);
?>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3 class="d-inline-block d-sm-none"><?php echo $row['Name'] ?? ''; ?></h3>
          <div class="col-12">
            <img src="uploads/<?php echo $row['Files'] ?? ''; ?>" class="product-image" alt="Product Image">
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <h3 class="my-3"><?php echo $row['Name'] ?? ''; ?></h3>
          <p><?php echo $row['Detail'] ?? ''; ?></p>
          <hr>
          <div class="bg-gray py-2 px-3 mt-4">
            <h2 class="mb-0">
              ₡ <?php echo $row['Price'] ?? ''; ?>
            </h2>
          </div>
          <div class="mt-4">
            <div class="btn btn-dark btn-lg btn-flat">
              <a href="#" class="btn btn-dark addToCart" 
                  data-id="<?php echo $row['id'] ?? ''; ?>"
                  data-name="<?php echo $row['Name'] ?? ''; ?>"
                  data-price="<?php echo $row['Price'] ?? ''; ?>"
                  data-files="<?php echo $row['Files'] ?? ''; ?>"
                  data-stock="<?php echo $row['Stock'] ?? ''; ?>">
                  <i class="fa fa-shopping-cart"></i> Agregar al carrito
              </a>
            </div>
          </div>

              <div class="mt-4 product-share">
              <div class="form-group">
                <strong><p>Existencia: <?php echo $row['Stock'] ?? ''; ?></p></strong>
                
                <div class="alert alert-danger" id="stockAlert" style="display: none;">
                    La cantidad solicitada supera la existencia disponible del producto.
                </div>
                    <label for="Cant_Product">Cantidad a Seleccionar:</label>
                    <input name="Cant_Product" type="number" id="Cant_Product"  class="form-control" value="1">
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
}
?>
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