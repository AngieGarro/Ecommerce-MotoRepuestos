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
  <?php
  session_start();
  include_once 'Models/User.php';
  include_once 'Controllers/User_Session.php';
  ?>
</head>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
<?php
include_once "Menu.php";
?>
  <div class="row">
    <?php
    include_once "Models/BD_Repuestos.php";
    $connection = mysqli_connect($host,$user,$pass,$db);
    //Buscador
    $where = "where 1=1";
    $name = mysqli_real_escape_string($connection,$_REQUEST[ 'Name']??'');
    if(empty($name)==false){
      $where .= " AND Name like '%".$name."%'";
    }
    //Paginancion
    $queryCount = "SELECT COUNT(*) as cuenta FROM product $where";
    $resultCount = mysqli_query($connection, $queryCount);
    $rowCount=mysqli_fetch_assoc($resultCount);
    $CountReg = $rowCount['cuenta'];
    $Element =6;
    $Npaginas=ceil($CountReg/$Element);
    $paginaSel=$_REQUEST[ 'pagina']??false;
    if($paginaSel==false){
      $inicioLimit=0;
      $paginaSel = 1;
    }
    else{
      $inicioLimit = ($paginaSel -1)*$Element;
    }
    $limit = " LIMIT $inicioLimit, $Element";
    //Mostrar Datos
    $query = "SELECT * FROM product $where ORDER BY id ASC $limit";

    $result = mysqli_query($connection, $query);
    while($row=mysqli_fetch_assoc($result)){
    ?>
      <div class="col-lg-4">
        <div class="card border-primary">
          <img class="card-img-top img-thumbnail ml-3" src="uploads/<?php  echo $row['Files']?>" alt="product" style="width: 390px; height: 360px;">
          <div class="card-body">
            <h3 class="card-title"><strong><?php echo $row['Name'] ?></strong></h3>
            <p class="card-text"><?php echo $row['Detail'] ?></p>
            <p class="card-text"><strong>Precio: </strong>₡ <?php echo $row['Price'] ?></p>
            <a href="DetailProduct.php?id=<?php echo $row['id']?>" class="btn btn-danger">Ver</a>
          </div>
        </div>
      </div>
    <?php  
    }
    ?>
  </div>
  <?php
if ($Npaginas > 0) {
?>
  <nav aria-label="Page navigation" class="mr-5">
    <ul class="pagination pagination-lg justify-content-end">
      <?php
      if ($paginaSel != 1) {
      ?>
        <li class="page-item">
          <a class="page-link" href="index.php?modulo=product&pagina=<?php echo $paginaSel - 1 ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Anterior</span>
          </a>
        </li>
      <?php
      }
      ?>
      <?php
      for ($i = 1; $i <= $Npaginas; $i++) {
      ?>
        <li class="page-item <?php echo ($paginaSel == $i) ? " active" : " "; ?>">
          <a href="index.php?modulo=product&pagina=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
        </li>
      <?php
      }
      ?>
      <?php
      if (($paginaSel) != $Npaginas) {
      ?>
        <li class="page-item">
          <a href="index.php?modulo=product&pagina=<?php echo $paginaSel + 1 ?>" class="page-link" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Siguiente</span>
          </a>
        </li>
      <?php
      }
      ?>
    </ul>
  </nav>
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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="JS/dashboard.js"></script>
<script src="JS/Carrito.js"></script>
</body>
</html>

