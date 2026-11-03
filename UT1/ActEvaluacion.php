<?php

$usuario = "";
$telefono = "";
$email = "";

$patronEmail = "/^[\w\-\.]+@([\w\-]+\.)+[a-zA-Z]{2,7}$/";
$patronUsuario = "/^[a-zA-Z][a-zA-Z0-9_-]{4,19}$/";
$patronTelefono = "/^[0-9]{9,15}$/";


if ($_POST) {

    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $telefono = $_POST['telefono'];

    if (preg_match($patronEmail, $email, $coincidencia)) {

        echo "Email valido <br>";
    }
    else echo "Email invalido <br>";

    if (preg_match($patronUsuario, $usuario, $coincidencia)) {

        echo "Usuario valido <br>";
    }
    else echo "Usuario invalido <br>";

    if (preg_match($patronTelefono, $telefono, $coincidencia)) {

        echo "Telefono valido <br>";
    }
    else echo "Telefono invalido <br>";

    if (
        preg_match($patronEmail, $email) &&
        preg_match($patronUsuario, $usuario) &&
        preg_match($patronTelefono, $telefono) 
        ) 
        {

            $usuario = preg_replace("/[a-z]/", strtoupper("$0"), $usuario);
            echo "Todos los datos son validos <br><br>";
            echo "Nombre de usuario: " . $usuario;
        } else echo "Los datos son invalidos<br><br>";

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="" method="POST">

    <label>Usuario:  <input type="text" name="usuario"></label><br>

    <label>Telefono:  <input type="text" name="telefono"></label><br>

    <label>Email:  <input type="email" name="email"></label><br>

    <input type="submit" value="Enviar">

</form>
    
</body>
</html>