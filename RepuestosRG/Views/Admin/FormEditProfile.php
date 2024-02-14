<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Datos</title>
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

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Datos</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
<?php
include_once "../../Models/BD_Repuestos.php";
// Verificar si se ha enviado el formulario de edición
if(isset($_POST['editar'])){
    // Conectar a la base de datos
    $connection = mysqli_connect($host, $user, $pass, $db);

    // Obtener el ID del producto a editar
    $id_edit = mysqli_real_escape_string($connection, $_REQUEST['id_user'] ?? '');

    // Obtener los datos del formulario
    $name = mysqli_real_escape_string($connection, $_POST['Last_Name'] ?? '');
    $phone = mysqli_real_escape_string($connection, $_POST['Phone'] ?? '');
    $email = mysqli_real_escape_string($connection, $_POST['Email'] ?? '');
    $pwd = mysqli_real_escape_string($connection, $_POST['Password']);

    // Actualizar los datos en la tabla de productos
    $query = "UPDATE user SET `Last_Name`='$name', `Email`='$email', 
    `Phone`='$phone',`Password`='$pwd' WHERE id_User ='$id_edit' ";
    $response = mysqli_query($connection, $query);

    // Verificar si la actualización se realizó correctamente
    if($response){
        // Redireccionar a la página anterior
       header('Location: EditUser.php');
    }
}

// Verificar si se ha proporcionado un ID de producto para editar
if(isset($_GET['idEdit'])) {
    // Conectar a la base de datos
    $connection = mysqli_connect($host, $user, $pass, $db);

    // Obtener el ID del producto a editar
    $id_edit = mysqli_real_escape_string($connection, $_GET['idEdit']);

    // Obtener los datos del producto a editar
    $query = "SELECT id_User, Last_Name, Email, Phone, Password FROM user WHERE id_User = '$id_edit'";
    $response = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($response);
?>

<!-- Formulario de edición de producto -->
<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_user" value="<?php echo $row['id_User']; ?>">
    <div class="form-group">
        <label for="Last_Name">Nombre:</label>
        <input name="Last_Name" type="text" class="form-control" value="<?php echo $row['Last_Name']; ?>">
    </div>
    <div class="form-group">
        <label for="Phone">Telefono:</label>
        <input name="Phone" type="text" class="form-control" value="<?php echo $row['Phone']; ?>">
    </div>
    <div class="form-group">
        <label for="Email">Correo:</label>
        <input name="Email" type="text" class="form-control" value="<?php echo $row['Email']; ?>">
    </div>
    <div class="form-group">
        <label for="Password">Actualizar Contraseña:</label>
        <span class="m-2 text-danger">Debe contener 12 caracteres</span>
        <input name="Password" type="Password" class="form-control" value="<?php echo $row['Password']; ?>">
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
