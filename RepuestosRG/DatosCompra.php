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
        include_once 'Models/User.php';
        include_once 'Controllers/User_Session.php';

        if(empty($_SESSION['user'])) {
            ?>
             <div class="mt-5 text-center">
                Debe <a href="Views/Login.php">Ingresar a su cuenta</a> o <a href="Views/Register.php">Registrarse</a>
             </div>
            
        <?php
        } else {
            ?>
                <?php
                if(isset($_REQUEST['guardar'])){
                    include_once "Models/BD_Repuestos.php";
                    $connection = mysqli_connect($host, $user, $pass, $db);
                
                    $total = mysqli_real_escape_string($connection, $_POST['totalHidden'] ?? '');
                    $NameClient = mysqli_real_escape_string($connection, $_POST['nombreCliente'] ?? '');
                    $PhoneClient = mysqli_real_escape_string($connection, $_POST['CelCliente'] ?? '');
                    $EmailClient = mysqli_real_escape_string($connection, $_POST['EmailCliente'] ?? '');
                    $AddressClient =  mysqli_real_escape_string($connection, $_POST['DirCliente'] ?? '');
                    $queryGuardar = "INSERT INTO `order_detail`(`Id_Client`, `Client_Name`, `Client_Phone`, `Client_Email`, `Client_Address`,`AmountTotal`,`OrderDate` ) 
                    VALUES (NULL,'$NameClient','$PhoneClient','$EmailClient','$AddressClient','$total', NOW())";
                    $response = mysqli_query($connection, $queryGuardar);
                    // Obtener el ID de la orden recién insertada
                    $id_Order = mysqli_insert_id($connection);
                    $_SESSION['idVenta'] = $id_Order;
                    if($response){
                    ?>
                    <meta http-equiv="refresh" content="0;url=http://localhost/RepuestosRG/OrderCliente.php?Id_Client=<?php echo $id_Order; ?>">
                    <?php
                    }
                    else{
                        ?>
                        <div class="alert alert-danger text-danger" id="alerta" role="alert">
                            <strong>Error</strong>
                        </div>
                        <?php
                    }
                }
            ?>
            <div class="container mt-3">
            <div class="row">
            <div class="col-6">
                <form method="post">
                    <h3>Datos para Orden de Compra</h3>
                    <div class="form-group">
                        <label for="">Ingrese su nombre:</label>
                        <input type="text" name="nombreCliente" id="nombreCliente" class="form-control">
                        <small class="text-muted">La orden de compra se crea bajo este nombre</small>
                    </div>
                    <div class="form-group">
                        <label for="">Telefono:</label>
                        <input type="text" name="CelCliente" id="CelCliente" class="form-control">
                        <small class="text-muted">Ingrese un número valido ya que es el medio por el cual lo contactaremos</small>
                    </div>
                    <div class="form-group">
                        <label for="">Correo:</label>
                        <input type="email" name="EmailCliente" id="EmailCliente" class="form-control">
                        <small class="text-muted">Ingrese el correo con el que Inicia Sesión</small>
                    </div>
                    <div class="form-group">
                        <label for="">Ubicación Exacta</label>
                        <textarea  class="form-control" name="DirCliente" id="DirCliente"></textarea>
                        <small class="text-muted mb-3">En caso de que requiera servicio express ponga la ubicación más exacta</small>
                    </div>
                </div>
                <div class="col-6">
                    <h4>Detalles de productos</h4>
                    <div class="row">
                    <table class="table table-striped table-inverse m-5" id="tableCart">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody> 
                    </tbody>
                    </table>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <input type="hidden" id="totalHidden" name="totalHidden" value="">
                        <h4 class="m-5"><strong>Total a pagar:</strong></h4><h4 name="totalHidden" class="mt-5" id="Total"></h4>
                    </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="form-group">
                        <button type="submit" name="guardar" class="btn btn-danger">Generar Datos</button>
                    </div>
                </div>
             </div>
           </div>
        <?php
        }
        ?>
</form>
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
</html>