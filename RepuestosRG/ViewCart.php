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

<div class="row">
<table class="table table-striped table-inverse m-5" id="tableCart">
<thead class="thead-inverse">
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Total</th>
        <th></th>
    </tr>
</thead>
  <tbody> 
  </tbody>
</table>
<div id="alertaExistencia" class="alert alert-danger" style="display: none;">
  La cantidad seleccionada supera la existencia del producto.
</div>
<div class="dropdown-divider"></div>
<div class="row">
    <h4 class="m-5"><strong>Total a pagar:</strong></h4><h4 class="mt-5" id="Total"></h4>
</div>
</div>
<div class="dropdown-divider"></div>
<a href="DatosCompra.php" class="btn btn-danger ml-5 mb-3" role="button">Datos de Compra</a>

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
    <strong>Copyright &copy; 2023 - Moto Repuestos RG</strong> All rights reserved.
  </footer>
</div>

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
</html>