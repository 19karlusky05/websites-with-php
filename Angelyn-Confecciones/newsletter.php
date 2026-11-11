<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, ingresa un correo electrónico válido.";
        exit();
    }

    $sql = "INSERT INTO Angelyn_email (email_user) VALUES ('$email')";

    if ($con -> query($sql)) {
        echo "¡Gracias por suscribirte! Pronto recibirás las mejores novedades y ofertas de Angelyn Confecciones.";
        echo "<a href='index.php'>Volver a la página principal</a>";
        } else { 
            echo "Error";
    }

    $con -> close();
}
?>