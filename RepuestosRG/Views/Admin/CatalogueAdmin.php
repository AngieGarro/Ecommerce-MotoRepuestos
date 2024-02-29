<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion Productos</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../Styles/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../Styles/css/adminlte.min.css">
   <!-- DataTables -->
   <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Gestión de Producto <button type="button" class="btn bg-gradient-danger ml-2" data-toggle="modal" data-target="#CreateProduct"><i class="fa-solid fa-file-circle-plus fa-xs mr-2"></i>Agregar Producto</button></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Gestión y configuración de productos</h3>
              </div>
               <!-- Borrar productos -->
                <?php
                  include_once "../../Models/BD_Repuestos.php";
                  $connection = mysqli_connect($host,$user,$pass,$db);
                  if(isset($_REQUEST['idDelete'])){
                    $id=mysqli_real_escape_string($connection,$_REQUEST['idDelete']??'');
                    $query = "DELETE FROM product WHERE  id='$id' ";
                    $response = mysqli_query($connection,$query);
                    ?>
                    <meta http-equiv="refresh" content="1;url=http://localhost/RepuestosRG/Views/Admin/CatalogueAdmin.php">
                    <?php
                  }
                   
                  ?>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Identificador</th>
                    <th>Nombre</th>
                    <th>Detalle</th>
                    <th>Precio</th>
                    <th>Código</th>
                    <th>Existencia</th>
                    <th>Imagen(es)</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    include_once "../../Models/BD_Repuestos.php";
                    $connection = mysqli_connect($host,$user,$pass,$db);
                    $query = "SELECT * FROM product;";
                    $response = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($response)){
                    ?>
                  <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['Name']?></td>
                    <td><?php echo $row['Detail']?></td>
                    <td><?php echo $row['Price']?></td>
                    <td><?php echo $row['Code_Product']?></td>
                    <td><?php echo $row['Stock']?></td>
                    <td><?php echo $row['Files']?></td>
                    <td>
                      <a href="CatalogueAdmin.php?idDelete=<?php echo $row['id']?>" class="text-danger borrar ml-2" title="Eliminar Producto">Borrar<i class="fas fa-trash ml-2"></i></a>
                      <a href="EditProduct.php?idEdit=<?php echo $row['id']?>" type="button" class="btn bg-gradient-secondary ml-2">
                        <i class="fas fa-edit ml-2"></i> Editar
                      </a>
                    </td>
                  </tr>
                  </tbody>
                  <?php
                  }
                  ?>
                  <tfoot>
                  <tr>
                    <th>Identificador</th>
                    <th>Nombre</th>
                    <th>Detalle</th>
                    <th>Precio</th>
                    <th>Código</th>
                    <th>Existencia</th>
                    <th>Imagen(es)</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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

<?php
if(isset($_POST['guardar'])){
    include_once "../../Models/BD_Repuestos.php";
    $connection = mysqli_connect($host, $user, $pass, $db);

    // Obtener datos del formulario
    $name = mysqli_real_escape_string($connection, $_POST['Name'] ?? '');
    $detail = mysqli_real_escape_string($connection, $_POST['Detail'] ?? '');
    $price = mysqli_real_escape_string($connection, $_POST['Price'] ?? '');
    $code = mysqli_real_escape_string($connection, $_POST['Code_Product'] ?? '');
    $stock = mysqli_real_escape_string($connection, $_POST['Stock'] ?? '');
    // Procesar la imagen
    $file_name = $_FILES["Files"]["name"];
    $file_tmp_name = $_FILES["Files"]["tmp_name"];
    $file_type = $_FILES["Files"]["type"];
    $file_error = $_FILES["Files"]["error"];

    // Verificar si se cargó la imagen correctamente
    if ($file_error === UPLOAD_ERR_OK) {
        // Directorio donde se guardará la imagen
        $upload_directory = "../../uploads/";

        // Nuevo nombre de la imagen para evitar colisiones de nombres
        $new_name = uniqid() . "_" . $file_name;

        // Ruta completa de la imagen
        $upload_path = $upload_directory . $new_name;

        // Mover la imagen al directorio de subida
        move_uploaded_file($file_tmp_name, $upload_path);

        // Insertar datos en la tabla de productos
        $query = "INSERT INTO `product`(`Name`, `Detail`, `Price`, `Code_Product`, `Files`,`Stock`) 
                  VALUES ('$name', '$detail', '$price', '$code', '$new_name', '$stock')";
        $response = mysqli_query($connection, $query);
        if($response){
          ?>
          <meta http-equiv="refresh" content="1;url=http://localhost/RepuestosRG/Views/Admin/CatalogueAdmin.php">
          <?php
        }
    }
}
?>
<!-- Modal Agregar Producto -->
<div class="modal fade" id="CreateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h2 class="card-title">Agregar Producto</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-danger">
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Name">Nombre:</label>
                <input name="Name" type="text" class="form-control"require>
              </div>
              <div class="form-group">
                <label for="Detail">Detalle:</label>
                <input name="Detail" type="text" class="form-control"require>
              </div>
              <div class="form-group">
                <label for="Price">Precio:</label>
                <input name="Price" type="text" class="form-control"require>
              </div>
              <div class="form-group">
                <label for="Code_Product">Código Producto:</label>
                <input name="Code_Product" type="text" class="form-control"require>
              </div>
              <div class="form-group">
                <label for="Stock">Existencia:</label>
                <input name="Stock" type="number" class="form-control"require>
              </div>
              <div class="form-group">
              <div class="row mb-3">
                <label class="form-label">Cargar Imagen:</label>
                <div class="text-danger">
                  <input type="file" class="image form-control ml-2" name="Files" accept="Image/*">
                  <span class="fs-4 fw-2 ml-2">Formato PNG/JPG...</span>
              </div>
              </div>
              <div class="form-group">
                <button type="submit" name="guardar" class="btn bg-gradient-danger float-right">Crear</button>
              </div>
            </form>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- Footer -->
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

