 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion Usuarios</title>
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
<!-- Modal -->
<div class="modal fade" id="CreateUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Crear nuevo Usuario</h3>
          </div>
          <div class="card-body">
            <?php
            if(isset($_REQUEST['guardarUser'])){
              include_once "../../Models/BD_Repuestos.php";
              $connection = mysqli_connect($host,$user,$pass,$db);

              $Email=mysqli_real_escape_string($connection,$_REQUEST['Email']??'');
              $Last_Name=mysqli_real_escape_string($connection,$_REQUEST['LastName']??'');
              $Phone=mysqli_real_escape_string($connection,$_REQUEST['Phone']??'');
              $Password=md5(mysqli_real_escape_string($connection,$_REQUEST['Password']??''));
              $UserType_id=mysqli_real_escape_string($connection,$_REQUEST['UserType_id']??'');
              $query = "INSERT INTO user (id_User,Last_Name,Email,Password,UserType_id,Phone) 
              VALUES (NULL, '".$Last_Name."','".$Email."','".$Password."','".$UserType_id."', '".$Phone."');";
              $response = mysqli_query($connection,$query);
              if($response){
                ?>
                <div class="alert alert-success text-center">
                <span><i class="fas fa-times m-1"></i>Usuario creado</span>
                </div>
                <?php
              }
              else{
                ?>
                <div class="alert alert-danger text-center" role="alert">
                <span><i class="fas fa-check m-1"></i>Error al crear usuario</span><?php echo mysqli_error($connection); ?>
                </div>
           <?php
              }
            }
            ?>
            <form method="post">
            <div class="form-group">
                <label for="LastName">Tipo Usuario</label>
                <select class="form-control" name="UserType_id">
                <option value="2">Usuario tipo cliente</option>
                <option value="1">Usuario tipo administrador</option>
                </select>
              </div>
              <div class="form-group">
                <label for="LastName">Nombre Completo</label>
                <input name="LastName" type="text" class="form-control"require>
              </div>
              <div class="form-group">
                <label for="Email">Correo</label>
                <input name="Email" type="email" class="form-control"require>
              </div>
              <div class="form-group">
                <label for="Phone">Télefono</label>
                <input name="Phone" type="text" class="form-control"require>
              </div>
              <div class="form-group">
                <label for="">Ingrese una contraseña</label>
                <input name="Password" type="password" class="form-control"require>
              </div>
              <div class="form-group">
                <button type="submit" name="guardarUser" class="btn bg-gradient-danger float-right">Registrar</button>
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestión de Usuario <button type="button" class="btn bg-gradient-danger ml-2" data-toggle="modal" data-target="#CreateUser"><i class="fa-solid fa-user-plus fa-xs mr-2"></i>Agregar Usuario</button></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Borrar usuarios -->
    <?php
      include_once "../../Models/BD_Repuestos.php";
      $connection = mysqli_connect($host,$user,$pass,$db);
      if(isset($_REQUEST['idDelete'])){
        $id=mysqli_real_escape_string($connection,$_REQUEST['idDelete']??'');
        $query = "DELETE FROM user WHERE  id_User='$id' ";
        $response = mysqli_query($connection,$query);
      }           
      ?>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Administración y Configuración de Usuarios</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id Usuario</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    include_once "../../Models/BD_Repuestos.php";
                    $connection = mysqli_connect($host,$user,$pass,$db);
                    $query = "SELECT id_User,Last_Name,Email,Phone FROM user;";
                    $response = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($response)){
                    ?>
                  <tr>
                    <td><?php echo $row['id_User'] ?></td>
                    <td><?php echo $row['Last_Name'] ?></td>
                    <td><?php echo $row['Email'] ?></td>
                    <td><?php echo $row['Phone'] ?></td>
                    <td>
                      <a href="GestionUsuarios.php?idDelete=<?php echo $row['id_User']?>" class="text-danger borrar ml-2" title="Eliminar Usuario">Borrar<i class="fas fa-trash ml-2"></i></a>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id Usuario</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
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


