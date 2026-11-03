<?php

$cadena = "Tengo una cita el 14/10/2026 en Arrecife";

/*
0[1-9]      → 01 - 09
[12][0-9]   → 10 - 29
3[01]       → 30 - 31
*/
$patronFecha = "/(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/([0-9]{4})/";

if (preg_match($patronFecha, $cadena, $coincidencia)) {

    echo "La fecha es correcta: " . $coincidencia[0] . "<br>";

    echo "Día: " . $coincidencia[1] . "<br>";
    echo "Mes: " . $coincidencia[2] . "<br>";
    echo "Año: " . $coincidencia[3] . "<br>";

} else {

    echo "No se encontró ninguna fecha con el formato correcto" . "<br>";
}


// Buscar palabras que empiezan por mayúscula

$patronMayusculas = "/[A-ZÁÉÍÓÚÑ][a-zA-ZáéíóúÁÉÍÓÚñÑ]*/u";

preg_match_all($patronMayusculas, $cadena, $palabras);

echo "Palabras que empiezan por mayúscula: ";
print_r($palabras[0]);

?>