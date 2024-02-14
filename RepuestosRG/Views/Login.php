<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Roboto:ital,wght@0,100;0,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type= "text/css" href="../Styles/Style.css"> 
    <link rel="stylesheet" type= "text/css" href="../Styles/css/all.min.css"> 
    <title>Login</title>
</head>
<?php
session_start();
?>
<body>
    <div class="Container">
        <div class="Img-container">
            <img src="../Images/undraw_add_to_cart_re_wrdo.svg" alt="">
        </div>
        <div class="Login-container">
            <form action="../Controllers/LoginController.php" method="post">
                <img src="../Images/LogotipoRG.png" alt="">
                <h2>Inicio de Sesión</h2>
                <div class="input-div user">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input type="text" name="user" class="input">
                    </div>
                </div>
                <div class="input-div pwd">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" name="Pwrd" class="input">
                    </div>
                </div>
                <a href="../Views/RegisterClient.php">Registrarme</a>
                <input type="submit" class="btn" name="Login" value="Iniciar">
            </form>
        </div>
</div>  
</body>
<script src="../JS/Login.js"></script>
</html>
