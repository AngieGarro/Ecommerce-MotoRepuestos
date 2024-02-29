<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Administrador</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../Styles/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../Styles/css/adminlte.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="../../JS/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../JS/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../JS/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <a href="../../Controllers/Logout.php">Cerrar Sesión</a>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../Images/LogotipoRG.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Inicio</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">
           Administrador
          </a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Opciones</li>
          <li class="nav-item">
            <a href="../Admin/EditUser.php" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Perfil 
              </p>
            </a>
            <li class="nav-item">
            <a href="../Admin/AdminDash.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Dashboard
              </p>
            </a>
            <li class="nav-item">
            <a href="../Admin/GestionUsuarios.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Gestión de Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../Admin/CatalogueAdmin.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Gestión de Productos
              </p>
            </a>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<?php
include_once "../../Models/BD_Repuestos.php";
$connection = mysqli_connect($host, $user, $pass, $db);

$queryNumVentas = "SELECT COUNT(id_Sale) AS num_ventas FROM `sale` 
                   WHERE Date_Time BETWEEN DATE(DATE_SUB(NOW(),INTERVAL 7 DAY)) AND NOW();";
$resultQueryNumVentas = mysqli_query($connection, $queryNumVentas);
$rowNumVentas = mysqli_fetch_assoc($resultQueryNumVentas);

$numVentas = $rowNumVentas['num_ventas'];


$queryNumUsers = "SELECT COUNT(id_User) AS num_user FROM `user`;";
$resultQueryNumUsers = mysqli_query($connection, $queryNumUsers);
$rowNumUser = mysqli_fetch_assoc($resultQueryNumUsers);

$numUsers = $rowNumUser['num_user'];
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $numVentas?></h3>

                <p>Ventas Semanales</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $numUsers?></h3>

                <p>Usuarios Registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-12 connectedSortable">
            <!-- Table Ventas -->
            <div class="col-12">
            <div class="card  bg-gradient-secondary">
              <div class="card-header">
                <h3 class="card-title">Reporte Ordenes de Compra</h3>
              </div>
              <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id Orden</th>
                    <th>Fecha</th>
                    <th>Detalle Productos</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Cliente</th>
                    <th>Contacto</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    include_once "../../Models/BD_Repuestos.php";
                    $connection = mysqli_connect($host,$user,$pass,$db);
                    $query = "SELECT * FROM sale;";
                    $response = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($response)){
                    ?>
                  <tr>
                    <td><?php echo $row['User_idOrder']?></td>
                    <td><?php echo $row['Date_Time']?></td>
                    <td><?php echo $row['NameProducts']?></td>
                    <td><?php echo $row['Cant']?></td>
                    <td>₡<?php echo $row['Total']?></td>
                    <td><?php echo $row['Client_Name']?></td>
                    <td><?php echo $row['Contact']?></td>
                  </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                </table>
        <!-- /.card-body -->
       </div>
    </div>
        <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
    <strong>Copyright &copy; 2023 - Moto Repuestos RG</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../JS/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../JS/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../JS/adminlte.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="../../JS/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- ChartJS -->
<script src="../../JS/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../JS/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../JS/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../JS/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../JS/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../JS/plugins/moment/moment.min.js"></script>
<script src="../../JS/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../JS/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../JS/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../JS/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../JS/dashboard.js"></script>

<!-- DataTables  & Plugins -->
<script src="../../JS/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../JS/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../JS/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../JS/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../JS/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../JS/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../JS/plugins/jszip/jszip.min.js"></script>
<script src="../../JS/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../JS/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../JS/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../JS/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../JS/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>

