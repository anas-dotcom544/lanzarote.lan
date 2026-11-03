<?php

$textoOriginal = "¡Programar en PHP es divertidísimo, Ñandú!";
$texto = $textoOriginal;
$k = 2;

$alfabeto = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";

/*Sustituyo tildes minusculas*/
$texto = str_replace("á", "a", $texto);
$texto = str_replace("é", "e", $texto);
$texto = str_replace("í", "i", $texto);
$texto = str_replace("ó", "o", $texto);
$texto = str_replace("ú", "u", $texto);
$texto = str_replace("ü", "u", $texto);

/*Sustituyo tildes mayusculas*/
$texto = str_replace("Á", "A", $texto);
$texto = str_replace("É", "E", $texto);
$texto = str_replace("Í", "I", $texto);
$texto = str_replace("Ó", "O", $texto);
$texto = str_replace("Ú", "U", $texto);
$texto = str_replace("Ü", "U", $texto);


$caracter = "";
$resultado = "";
$nuevaLetra = "";

/*LOGICA PARA CIFRAR*/
for ($i = 0; $i < mb_strlen($texto, 'UTF-8'); $i++) {

    /*Saco la posicion del caracter del texto*/
    $caracter = mb_substr($texto, $i, 1, 'UTF-8');

    /*Convierto el caracter a mayuscula para comprobarlo*/
    $caracterMayuscula = mb_strtoupper($caracter, 'UTF-8');

    /*Si es letra entra*/
    if (mb_strpos($alfabeto, $caracterMayuscula, 0, 'UTF-8') !== false) {

        /*Si es mayuscula entra*/
        if (mb_strtoupper($caracter, 'UTF-8') == $caracter) {

            /*Encuentra la posicion del caracter respecto al alfabeto*/
            $posicion = mb_strpos($alfabeto, $caracter, 0, 'UTF-8');

            /*Suma el valor de k*/
            $nuevaPosicion = ($posicion + $k) % 27;

            /*Traduce la posicion del caracter a la letra correspondiente*/
            $nuevaLetra = mb_substr($alfabeto, $nuevaPosicion, 1, 'UTF-8');

        /*Si es minuscula entra /
        } else {

            /*La convertimos a mayuscula para comprobarla en el alfabeto*/
            $caracter = mb_strtoupper($caracter, 'UTF-8');

            /*Encuentra la posicion del caracter respecto al alfabeto*/
            $posicion = mb_strpos($alfabeto, $caracter, 0, 'UTF-8');

            /*Suma el valor de k*/
            $nuevaPosicion = ($posicion + $k) % 27;

            /*La volvemos a convertir en minuscula*/
            $nuevaLetra = mb_strtolower(
                mb_substr($alfabeto, $nuevaPosicion, 1, 'UTF-8'),
                'UTF-8'
            );
        }

        /*Guardamos la letra traducida*/
        $resultado = $resultado . $nuevaLetra;

    } else {

        /*Si no es letra, dejamos el caracter igual*/
        $resultado = $resultado . $caracter;
    }
}


$descifrado = "";


/*LOGICA PARA DESCIFRAR*/
for ($i = 0; $i < mb_strlen($resultado, 'UTF-8'); $i++) {

    /*Saco la posicion del caracter del texto cifrado*/
    $caracter = mb_substr($resultado, $i, 1, 'UTF-8');

    /*Convierto el caracter a mayuscula para comprobarlo*/
    $caracterMayuscula = mb_strtoupper($caracter, 'UTF-8');

    /*Si es letra entra*/
    if (mb_strpos($alfabeto, $caracterMayuscula, 0, 'UTF-8') !== false) {

        /* i es mayuscula entra*/
        if (mb_strtoupper($caracter, 'UTF-8') == $caracter) {

            /*Encuentra la posicion del caracter*/
            $posicion = mb_strpos($alfabeto, $caracter, 0, 'UTF-8');

            /*Resta el valor de k*/
            $nuevaPosicion = ($posicion - $k + 27) % 27;

            /*Traduce la posicion a la letra correspondiente*/
            $nuevaLetra = mb_substr($alfabeto, $nuevaPosicion, 1, 'UTF-8');

        /*Si es minuscula entra*/
        } else {

            /*La convertimos a mayuscula*/
            $caracter = mb_strtoupper($caracter, 'UTF-8');

            /*Encuentra la posicion del caracter*/
            $posicion = mb_strpos($alfabeto, $caracter, 0, 'UTF-8');

            /*Resta el valor de k*/
            $nuevaPosicion = ($posicion - $k + 27) % 27;

            /*La volvemos a convertir en minuscula*/
            $nuevaLetra = mb_strtolower(
                mb_substr($alfabeto, $nuevaPosicion, 1, 'UTF-8'),
                'UTF-8'
            );
        }

        /*Guardamos la letra traducida*/
        $descifrado = $descifrado . $nuevaLetra;

    } else {

        /*Si no es letra, dejamos el caracter igual*/
        $descifrado = $descifrado . $caracter;
    }
}


echo "Original: " . $textoOriginal . "<br>";
echo "Normalizado: " . $texto . "<br>";
echo "Cifrado (k = $k): " . $resultado . "<br>";
echo "Descifrado: " . $descifrado . "<br>";

if ($descifrado === $texto) {
    echo "Verificacion: OK";
} else {
    echo "Verificacion: NO OK";
}
