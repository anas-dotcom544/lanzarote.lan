<?php

$cadena = "Programar en PHP es divertido";
$vocales = 0;

$cadena = strtolower($cadena);

for ($i = 0; $i < strlen($cadena); $i++) {

    if ($cadena[$i] == "a" ||
        $cadena[$i] == "e" ||
        $cadena[$i] == "i" ||
        $cadena[$i] == "o" ||
        $cadena[$i] == "u" ) 
    {

        $vocales++;
    }
}
 
echo "Total vocales: $vocales\n";

