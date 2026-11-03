<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="bienvenida.php" method="post">
        <label>Nombre: <input type="text" name="usuario"></label><br>
        <button type="submit">Enviar</button>
    </form>

</body>
</html>

<?php

session_start();
$_SESSION['usuario'] = "$usuario";
echo "Usuario en sesión: " . $_SESSION['usuario']; 

$usuario = $_POST['usuario'] ?? 'No definido';


?>