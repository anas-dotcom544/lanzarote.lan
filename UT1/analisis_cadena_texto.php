<?php

$texto = "Programar en PHP es divertido";
$texto = trim($texto);
$caracteres = strlen($texto);

echo "Caractares totales: $caracteres <br>";

$palabras = str_word_count($texto);

echo "Palabras totales: $palabras <br>";

$primeraLetra = substr($texto,0,1);

echo "Primera letra: $primeraLetra <br>";

$ultimaLetra = substr($texto,-1);
$ultimaLetra = strtoupper($ultimaLetra);

echo "Ultima letra: $ultimaLetra <br>";

$fraseInvertida = strrev($texto);

echo "Cadena invertida: $fraseInvertida";

