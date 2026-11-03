#!/usr/bin/php
<?php

$mensaje = PHP_EOL . "Se está realizando {$argv[1]}:" . PHP_EOL;

switch ($argv[1]) {

    // 1. Saludar
    case 'saludar':

        echo $mensaje;

        if (empty($argv[2]))
            saludar("invitado");
        else
            saludar($argv[2]);

        break;


    // 2. Sumar
    case 'sumar':

        echo $mensaje;

        if (empty($argv[2]) || empty($argv[3])) {
            echo "Hay que indicar los dos sumandos" . PHP_EOL;
        } else {
            echo "El resultado de la suma es: " . suma($argv[2], $argv[3]);
        }

        break;


    // 3. Sumar todos
    case 'sumar-todos':

        echo $mensaje;

        unset($argv[0]);
        unset($argv[1]);

        echo "El resultado de la suma es: " . sumarTodos($argv);

        break;


    // 4. Es primo
    case 'es-primo':

        echo $mensaje;

        if (empty($argv[2])) {

            echo "Debes indicar al menos un valor para comprobar si es primo " . PHP_EOL;

        } else {

            echo "El número {$argv[2]} " .
                (esPrimo($argv[2]) ? '' : 'NO ') .
                "es primo.";
        }

        break;


    // 5. Palabra más larga
    case 'palabra-mas-larga':

        echo $mensaje;

        if (empty($argv[2]))
            echo "Debes indicar al menos una frase " . PHP_EOL;

        $palabra_mas_larga = '';
        $longitud_palabra_mas_larga = 0;

        foreach (explode(' ', $argv[2]) as $palabra) {

            $longitud_candidata_a_palabra_mas_larga = strlen($palabra);

            if ($longitud_candidata_a_palabra_mas_larga > $longitud_palabra_mas_larga) {

                $palabra_mas_larga = $palabra;
                $longitud_palabra_mas_larga = $longitud_candidata_a_palabra_mas_larga;
            }
        }

        echo "La palabra más larga en la frase \"{$argv[2]}\" es {$palabra_mas_larga}";

        break;


    // 6. Estadísticas
    case 'estadisticas':

        // $argc el número total de parámetros cargados
        // $argv todos los parámetros

        $min = 99999999999;
        $max = 0;
        $media = 0;

        for ($i = 2; $i < $argc; $i++) {

            echo "Valor a tratar {$argv[$i]}";

            $media += $argv[$i];

            if ($argv[$i] < $min)
                $min = $argv[$i];

            if ($argv[$i] > $max)
                $max = $argv[$i];
        }

        echo PHP_EOL . "La media es: " . round($media / ($argc - 2), 2);
        echo PHP_EOL . "El máximo es: " . $max;
        echo PHP_EOL . "El mínimo es: " . $min;

        echo $mensaje;

        break;


    default:

        echo "No se ha cargado una opción válida";

        break;
}


echo PHP_EOL . PHP_EOL;


// ---------------------
// FUNCIONES
// ---------------------

// 1. Saludar
function saludar(string $nombre)
{
    echo "Hola $nombre";
}


// 2. Sumar
function suma(int $a, int $b)
{
    return $a + $b;
}


// 3. Sumar todos
function sumarTodos($numeros)
{
    $suma = 0;

    foreach ($numeros as $n) {
        $suma += $n;
    }

    return $suma;
}


// 4. Es primo
function esPrimo(int $n)
{
    if ($n < 2) {
        return false;
    }

    for ($i = 2; $i < $n; $i++) {

        if ($n % $i == 0) {
            return false;
        }
    }

    return true;
}