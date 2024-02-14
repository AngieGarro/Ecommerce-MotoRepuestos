<?php
// Desactivar las advertencias de PHP
error_reporting(0);
session_start();

    // Conectar a la base de datos
    include_once "Models/BD_Repuestos.php";
    $connection = mysqli_connect($host, $user, $pass, $db);
    $id_Order = mysqli_real_escape_string($connection, $_GET['idVenta']);
     // Obtener los datos del producto a editar
     $query = "SELECT `Id_Client`, `Client_Name`, `Client_Phone`, `Client_Email`, `Client_Address`, `AmountTotal`, `OrderDate` 
     FROM `order_detail` WHERE Id_Client = '".$id_Order."'";
     $response = mysqli_query($connection, $query);
     $row = mysqli_fetch_assoc($response);


?>
<?php
ob_start();
?>
<div>
  <h1 style="color: red; text-align: center;">Moto Repuestos RG</h1>
</div>
<h2>Comprobante de Compra</h2>
</br>
<p><strong>Id compra: </strong> <?php echo $row['Id_Client'] ?></p>
<p><strong>Cliente: </strong> <?php echo $row['Client_Name'] ?></p>
<p><strong> Fecha de Orden: </strong> <?php echo $row['OrderDate'] ?></p>
<p style="color: gray;">_________________________________________________________________________________________</p>
</br>
<h3>Contacto</h3>
<p><strong>Telefono: </strong> <?php echo $row['Client_Phone'] ?></p>
<p><strong>Correo Electronico: </strong><?php echo $row['Client_Email'] ?></p>
<p><strong>Direccion: </strong><?php echo $row['Client_Address'] ?></p>
</br>
<p style="color: gray;">_________________________________________________________________________________________</p>
</br>
<p style="text-align: right; font-size:1.2rem;"><strong>Total: </strong><?php echo $row['AmountTotal'] ?> colones</p>

<?php $htmlP = ob_get_clean(); ?>
<?php
    include_once "dompdf/autoload.inc.php";
    use Dompdf\Dompdf;
    $pdf=new Dompdf();
    $pdf->load_html($htmlP);
    $pdf->setPaper('A4', 'landingscape');
    $pdf->render();
    $pdf->stream();
?>
<!-- jQuery -->
<script src="JS/jquery.min.js"></script>
<script src="JS/Carrito.js"></script>