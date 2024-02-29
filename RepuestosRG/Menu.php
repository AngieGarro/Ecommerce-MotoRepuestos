  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <img src="Images/LogotipoRG.png" class="image img-circle m-2" style: width="120px"; height="90px;">
      </li>
      <li class="nav-item d-none d-sm-inline-block mt-3">
        <a href="index.php" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block mt-3">
        <a href="Contact.php" class="nav-link">Contacto</a>
      </li>
      <li class="nav-item d-sm-inline-block mt-3">
      <form class="d-flex flex-wrap justify-content-between align-items-center" action="index.php">
        <div class="input-group">
            <input class="form-control" type="search" placeholder="Search" name="Name" value="<?php echo $_REQUEST['Name']??''?>">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
      <input type="hidden" name="modulo" value="product">
    </form>
    </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Functions Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" id="iconCart">
          <i class="fa fa-cart-plus"></i>
          <span class="badge badge-danger navbar-badge" id="badgeCart"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="CartList">
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
        <?php
        include_once 'Models/User.php';
        include_once 'Controllers/User_Session.php';

        if(empty($_SESSION['user'])) {
            ?>
                <a href="Views/Login.php" class="dropdown-item text-secondary">
                <i class="fas fa-door-open mr-2"></i>Ingresar
            </a>
            <div class="dropdown-divider"></div>
            <a href="Views/RegisterClient.php" class="dropdown-item text-danger">
                <i class="fas fa-sign-in-alt mr-2"></i>Registrarse
            </a>
        <?php
        } else {
            ?>
             <a href="index.php?mensaje=Ingreso%20éxitoso" class="dropdown-item text-secondary">
             <i class="fas fa-user mr-2"></i>Hola, Bienvenido a su cuenta!
            </a>
            <div class="dropdown-divider"></div>
            <a href="Controllers/Logout.php" class="dropdown-item text-danger">
                <i class="fas fa-door-closed mr-2"></i>Cerrar Sesión
            </a>
        <?php
        }
        ?>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Mensaje Usuario Logueado -->
  <?php
    $message = $_REQUEST['mensaje'] ??'';
    if($message){
?>
<div class="alert alert-danger alert-dismissible fade show text-light" role="alert">
    <button type="button" class="close text-light" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
        <?php echo $message; ?>
  </div>
<?php
    }
?>