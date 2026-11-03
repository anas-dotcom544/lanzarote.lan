<?php

$videojuegos = [
    [
        "titulo" => "Minecraft",
        "plataforma" => "PC",
        "genero" => "Sandbox",
        "precio" => 25.99,
        "stock" => 10
    ],
    [
        "titulo" => "Elden Ring",
        "plataforma" => "PS5",
        "genero" => "RPG",
        "precio" => 59.99,
        "stock" => 5
    ],
    [
        "titulo" => "Forza Horizon 6",
        "plataforma" => "PS5",
        "genero" => "Carreras",
        "precio" => 79.99,
        "stock" => 8
    ],
    [
        "titulo" => "Black Ops 2",
        "plataforma" => "PS4",
        "genero" => "Accion",
        "precio" => 14.99,
        "stock" => 12
    ],
    [
        "titulo" => "Marvel: Lobezno",
        "plataforma" => "PS5",
        "genero" => "Accion",
        "precio" => 74.99,
        "stock" => 3
    ],
    [
        "titulo" => "Battefield 6",
        "plataforma" => "PS5",
        "genero" => "Accion",
        "precio" => 28.99,
        "stock" => 7
    ]
];

/*Creamos el array economicos y usamos foreach
para filtrar solamente los videojuegso con precios
menores a 30*/
$economicos = [];

foreach ($videojuegos as $videojuego) {

    if ($videojuego["precio"] < 30) {
        $economicos[] = $videojuego;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videojuegos</title>
</head>
<body>

<h1>Catalogo Juegos</h1>

<?php

/*EJERCICIO 1*/
echo "<h2> Catalogo Principal </h2>";

/*Creamos la tabla*/
echo "<table border='1'>";

echo "<tr>";
echo "<th>Titulo</th>";
echo "<th>Plataforma</th>";
echo "<th>Genero</th>";
echo "<th>Precio</th>";
echo "<th>Stock</th>";
echo "</tr>";

/*Recorremos la tabla con un foreach 
para imprimir los valores del array videojuegos*/
foreach($videojuegos as $videojuego) {
    
    echo "<tr>";

    echo "<td>" . $videojuego["titulo"] . "</td>";
    echo "<td>" . $videojuego["plataforma"] . "</td>";
    echo "<td>" . $videojuego["genero"] . "</td>";
    echo "<td>" . round($videojuego["precio"], 2) . "€</td>";
    echo "<td>" . $videojuego["stock"] . "</td>";

    echo "</tr>";
}

echo "</table>";

/*EJERCICIO 2*/

/*Añadimos un videojuego con push que va al final*/
array_push($videojuegos, [
    "titulo" => "Silent Hill",
    "plataforma" => "PS5",
    "genero" => "Terror",
    "precio" => 62.99,
    "stock" => 14
]);

/*Modificamos el precio del segundo videojuego*/
$videojuegos[1]["precio"] = 47.99;

/*Eliminamos el ultimo videojuego del array*/
array_pop($videojuegos);

echo "<h2> Catalogo Actualizado </h2>";

/*Creamos otra tabla actualizada con 
los nuevos datos modificados*/
echo "<table border='1'>";

echo "<tr>";
echo "<th>Titulo</th>";
echo "<th>Plataforma</th>";
echo "<th>Genero</th>";
echo "<th>Precio</th>";
echo "<th>Stock</th>";
echo "</tr>";

/*Recorremos nuevamente el array para imprimir sus valores*/
foreach($videojuegos as $videojuego) {
    
    echo "<tr>";

    echo "<td>" . $videojuego["titulo"] . "</td>";
    echo "<td>" . $videojuego["plataforma"] . "</td>";
    echo "<td>" . $videojuego["genero"] . "</td>";
    echo "<td>" . round($videojuego["precio"], 2) . "€</td>";
    echo "<td>" . $videojuego["stock"] . "</td>";

    echo "</tr>";
}

echo "</table>";

/*EJERCICIO 3*/
echo "<h2> Estadisticas del Catalogo </h2>";

/*Numero total de videojuegos con count*/
$totalVideojuegos = count($videojuegos);
echo "Numero total de videojuegos: " . $totalVideojuegos . "<br>";

/*Creamos variables que nos ayudaran para sacar las estadisticas*/
$totalStock = 0;
$totalPrecios = 0;

$precioMayor = $videojuegos[0]["precio"];
$precioMenor = $videojuegos[0]["precio"];

$videojuegoCaro = $videojuegos[0]["titulo"];
$videojuegoBarato = $videojuegos[0]["titulo"];

/*Recorremos el foreach para sacar el videojuego mas caro 
y mas barato comparando cada videojuego del array entre si
y sacamos el titulo del videojuego mas caro y barato con su precio al lado*/
foreach ($videojuegos as $videojuego) {

    $totalStock = $totalStock + $videojuego["stock"];
    $totalPrecios = $totalPrecios + $videojuego["precio"];

    if ($videojuego["precio"] > $precioMayor) {
        
        $precioMayor = $videojuego["precio"];
        $videojuegoCaro = $videojuego["titulo"];
    }

    if ($videojuego["precio"] < $precioMenor) {
        
        $precioMenor = $videojuego["precio"];
        $videojuegoBarato = $videojuego["titulo"];
    }
}

echo "Unidades totales en stock: " . $totalStock . "<br>";

/*Sacamos la media*/
$precioMedio = $totalPrecios / $totalVideojuegos;
echo "Precio medio: " . round($precioMedio, 2) . " €<br>";

echo "Videojuego mas caro: " . $videojuegoCaro . " (" . $precioMayor . " €)<br>";

echo "Videojuego mas barato: " . $videojuegoBarato . " (" . $precioMenor . " €)<br>";

/*EJERCICIO 4*/
echo "<h2> Videojuegos Economicos </h2>";

/*Creamos otra tabla pero esta vez del array economicos*/
echo "<table border = '1'>";

echo "<tr>";
echo "<th>Titulo</th>";
echo "<th>Plataforma</th>";
echo "<th>Genero</th>";
echo "<th>Precio</th>";
echo "<th>Stock</th>";
echo "</tr>";

foreach($economicos as $videojuego) {
    
    echo "<tr>";

    echo "<td>" . $videojuego["titulo"] . "</td>";
    echo "<td>" . $videojuego["plataforma"] . "</td>";
    echo "<td>" . $videojuego["genero"] . "</td>";
    echo "<td>" . round($videojuego["precio"], 2) . "€</td>";
    echo "<td>" . $videojuego["stock"] . "</td>";

    echo "</tr>";
}

echo "</table>";

/*EJERCICIO 5*/
echo "<h2> Videojuegos ordenados por precio </h2>";

/*Creamos un array donde iran guardados los videojuegos 
donde ordenamos por clave sera titulo y valor sera precio*/
$precios = [];

foreach ($videojuegos as $videojuego) {

    $precios[$videojuego["titulo"]] = $videojuego["precio"];
}

/*Ordenamos el array de menor a mayor*/
asort($precios);

/*Un forea*/
foreach ($precios as $titulo => $precio) {

    echo $titulo . " - " . $precio . " €<br>";
}

echo "<h2> Videojuegos ordenador alfabeticamente </h2>";

/*Mostramos los videojueos por orden alfabetico*/
ksort($precios);

foreach ($precios as $titulo => $precio) {

    echo $titulo . " - " . $precio . " €<br>";
}

/*EJERCICIO 6*/
/*Creamos un array donde solo guardamos 
las plataformas de los videojuegos*/
$plataformas = [];

/*El foreach recorre el array de videojuegos 
y filtra solo las plataformas y no coge repetidos*/
foreach ($videojuegos as $videojuego) {

    if (!in_array($videojuego["plataforma"], $plataformas)) {
        $plataformas[] = $videojuego["plataforma"];
    }
}

echo "<h2>Plataformas disponibles </h2>";

/*Imprimimos las plataformas mediante una lista */
echo "<ul>";

/*Recorremos cada plataforma del array*/
foreach ($plataformas as $plataforma) {
    
    echo "<li>" . $plataforma . "</li>";
}

echo "</ul>";
?>
    
</body>
</html>