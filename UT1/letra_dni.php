<?php

$dni = "78768606";
$dni = ltrim($dni);

if (ctype_digit($dni) === true && strlen($dni) == 8) {

    echo "DNI introducido valido: $dni <br>";

    $indice = $dni % 23;
    echo "Indice DNI: $indice <br>";

    $letras = "TRWAGMYFPDXBNJZSQVHLCKE";

    echo "Letra correspondiente al DNI: $letras[$indice] <br>";

    $nif = $dni . $letras[$indice];

    echo "Su NIF es: $nif";

} else echo "DNI introducido invalido: deben de ser 8 digitos";



