<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Roboto:ital,wght@0,100;0,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type= "text/css" href="../Styles/Style.css"> 
    <link rel="stylesheet" type= "text/css" href="../Styles/css/all.min.css"> 
    <title>Registro</title>
</head>
<?php
session_start();
?>
<body>
    <div class="Container">
        <div class="Img-container">
            <img src="../Images/undraw_bookmarks_re_mq1u.svg" alt="">
        </div>
        <div class="Login-container">
        <?php
            if(isset($_POST['Register'])){
                include_once "../Models/BD_Repuestos.php";
                $connection = mysqli_connect($host, $user, $pass, $db);

                // Obtener datos del formulario
                $name = mysqli_real_escape_string($connection, $_POST['nameUser'] ?? '');
                $email = mysqli_real_escape_string($connection, $_POST['emailUser'] ?? '');
                $phone = mysqli_real_escape_string($connection, $_POST['PhoneUser'] ?? '');
                $pwd = mysqli_real_escape_string($connection, $_POST['PwrdUser'] ?? '');

                    // Insertar datos en la tabla de productos
                    $query = "INSERT INTO `user`(`id_User`,`Last_Name`, `Email`, `Password`, `UserType_id`, `Phone`) 
                            VALUES (NULL,'$name', '$email', '$pwd', '2', '$phone')";
                    $response = mysqli_query($connection, $query);
                    if($response){
                        ?>
                        <div class="alert alert-danger mt-2" id="alerta" role="alert">
                               <strong>Registrado</strong>
                           </div>
                       <?php
                    }
                    else{
                        ?>
                        <div class="alert alert-danger text-danger" id="alerta" role="alert">
                            <strong>Error: Usuario ya existe</strong>
                        </div>
                        <?php
                    }
                }
            ?>
            <form method="post">
                <img src="../Images/LogotipoRG.png" alt="">
                <h2>Registro</h2>
                <div class="input-div user">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Nombre Completo</h5>
                        <input type="text" name="nameUser" class="input">
                    </div>
                </div>
                <div class="input-div user">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Telefono</h5>
                        <input type="text" name="PhoneUser" class="input">
                    </div>
                </div>
                <div class="input-div user">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Correo </h5>
                        <input type="text" name="emailUser" class="input">
                    </div>
                </div>
                <div class="input-div pwd">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Crear Contraseña</h5>
                        <input type="password" name="PwrdUser" class="input">
                    </div>
                </div>
                <input type="submit" class="btn" name="Register" value="Registrarme">
                <a href="Login.php">Ingresar</a>
            </form>
        </div>
</div>  
</body>
<script>
    // Espera 5 segundos y luego oculta la alerta
    setTimeout(function() {
        document.getElementById('alerta').style.display = 'none';
    }, 5000); // 5000 milisegundos = 5 segundos
</script>
<script src="../JS/Login.js"></script>
</html>