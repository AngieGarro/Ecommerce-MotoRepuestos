<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Producto</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../Styles/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../Styles/css/adminlte.min.css">
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
    <a href="../Views/Admin.php" class="brand-link">
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Producto</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <?php
// Incluir archivo de conexión a la base de datos
include_once "../../Models/BD_Repuestos.php";

// Verificar si se ha enviado el formulario de edición
if(isset($_POST['editar'])){
    // Conectar a la base de datos
    $connection = mysqli_connect($host, $user, $pass, $db);

    // Obtener el ID del producto a editar
    $id_edit = mysqli_real_escape_string($connection, $_REQUEST['id'] ?? '');

    // Obtener los datos del formulario
    $name = mysqli_real_escape_string($connection, $_POST['Name'] ?? '');
    $detail = mysqli_real_escape_string($connection, $_POST['Detail'] ?? '');
    $price = mysqli_real_escape_string($connection, $_POST['Price'] ?? '');
    $stock = mysqli_real_escape_string($connection, $_POST['Stock'] ?? '');
    // Actualizar los datos en la tabla de productos
    $update_query = "UPDATE product SET `Name`='$name', `Detail`='$detail', `Price`='$price',`Stock`='$stock'  WHERE id ='$id_edit' ";
    $update_response = mysqli_query($connection, $update_query);

    // Verificar si la actualización se realizó correctamente
    if($update_response){
        // Redireccionar a la página anterior
        ?>
        <meta http-equiv="refresh" content="0;url=http://localhost/RepuestosRG/Views/Admin/CatalogueAdmin.php">
        <?php
    }
}

// Verificar si se ha proporcionado un ID de producto para editar
if(isset($_GET['idEdit'])) {
    // Conectar a la base de datos
    $connection = mysqli_connect($host, $user, $pass, $db);

    // Obtener el ID del producto a editar
    $id_edit = mysqli_real_escape_string($connection, $_GET['idEdit']);

    // Obtener los datos del producto a editar
    $query = "SELECT id, Name, Detail, Price, Stock FROM product WHERE id = '$id_edit'";
    $response = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($response);
?>

<!-- Formulario de edición de producto -->
<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="form-group">
        <label for="Name">Nombre:</label>
        <input name="Name" type="text" class="form-control" value="<?php echo $row['Name']; ?>">
    </div>
    <div class="form-group">
        <label for="Detail">Detalle:</label>
        <input name="Detail" type="text" class="form-control" value="<?php echo $row['Detail']; ?>">
    </div>
    <div class="form-group">
        <label for="Price">Precio:</label>
        <input name="Price" type="text" class="form-control" value="<?php echo $row['Price']; ?>">
    </div>
    <div class="form-group">
        <label for="Stock">Existencia:</label>
        <input name="Stock" type="text" class="form-control" value="<?php echo $row['Stock']; ?>">
    </div>
    <div class="form-group">
        <button type="submit" name="editar" class="btn bg-gradient-danger float-right">Guardar Cambios</button>
    </div>
</form>

<?php
} // Cierre del bloque de verificación del ID de edición
?>
                        
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["csv", "excel", "pdf"]
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


