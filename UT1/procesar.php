<?php

$nombre = $_POST['nombre'] ?? '';
$edad = $_POST['edad'] ?? '';
$email = $_POST['email'] ?? '';
 
function validarCampo($texto) {
    return trim($texto) !== '';
}

if (
    !validarCampo($nombre) ||
    !validarCampo($edad) ||
    !validarCampo($email)
) {
    if (!validarCampo($nombre)) {
        echo "Falta el nombre.<br>";
    }

    if (!validarCampo($edad)) {
        echo "Falta la edad.<br>";
    }

    if (!validarCampo($email)) {
        echo "Falta el correo electrónico.<br>";
    }
} else {
    echo "¡Hola, " . htmlspecialchars($nombre) .
         "! Tienes " . htmlspecialchars($edad) .
         " años y tu correo electrónico es " .
         htmlspecialchars($email) . ".";
}

?>