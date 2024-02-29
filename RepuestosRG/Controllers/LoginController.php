<?php
include_once '../Models/User.php';
include_once 'User_Session.php';

// Instanciamiento del Model User:
$user = new User();
$userSession = new UserSession();

// Verificar si se enviaron datos de inicio de sesión
if (isset($_POST['user']) && isset($_POST['Pwrd'])) {
    // Variables de ingreso al Login:
    $userForm = $_POST['user'];
    $pwrdForm = $_POST['Pwrd'];
    $rol = $user->getRol($userForm, $pwrdForm);
    $idUsuario = $user->userExists($_POST['user'], $_POST['Pwrd']);
    // Verificar si las credenciales son correctas
    if ($user->userExists($userForm, $pwrdForm)) {
        // Establecer la sesión del usuario
        $userSession->setCurrentUser($userForm);

        // Redireccionar según el rol del usuario
        switch ($rol) {
            case '1':
                header('Location: ../Views/Admin/AdminDash.php');
                break;
            case '2':
                header('Location: ../index.php?mensaje=Ingreso éxitoso');
                break;
            default:
                echo "Error";
                break;
        }
    } else {
        // Mostrar mensaje de usuario incorrecto
        echo "Usuario incorrecto";
    }
} else {
    // Si no se enviaron datos de inicio de sesión, redireccionar a la página principal
    header("Location: ../index.php");
}
?>
