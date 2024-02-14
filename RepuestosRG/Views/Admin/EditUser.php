<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mi Cuenta</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../Styles/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../Styles/css/adminlte.min.css">
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
  <?php
      include_once "../../Models/BD_Repuestos.php";
      $connection = mysqli_connect($host,$user,$pass,$db);
      $query = "SELECT id_User,Last_Name,Email,Phone FROM user;";
      $response = mysqli_query($connection,$query);

      if($row = mysqli_fetch_assoc($response)){
      ?>

<!-------------------------------------VISTA DE DATOS----------------------------------------------->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mi Cuenta</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-white card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <h3 class="profile-username text-center text-sucess"><?php echo $row['Last_Name'] ?></h3>
                                    <p class="text-muted">Usuario Activo</p>
                                </div>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Tipo Usuario</b><span id="id_UserType" class="float-right badge badge-primary">Administrador</span>
                                        </li>
                                    </ul>
                                <form method="post" id="action-editar" class="form-horizontal">
                                  <div class="form-group row">
                                    <strong>
                                    <i class="fas fa-phone mr-1"></i>Telefono
                                    </strong>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php echo $row['Phone'] ?>">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <strong>
                                        <i class="fas fa-at mr-1"></i>Correo
                                    </strong>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php echo $row['Email'] ?>">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10 float-right">
                                        <input type="hidden" class="form-control" value="<?php echo $row['id_User'] ?>">
                                        <a href="FormEditProfile.php?idEdit=<?php echo $row['id_User']?>" type="button" class="btn bg-gradient-secondary ml-2">
                                        <i class="fas fa-edit ml-2"></i> Editar Datos
                                        </a>
                                        </div>
                                    </div>
                               </form>
                        </div>
                  </div>
            </div>
        </div>
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

</body>
</html>

<?php
}
?>
