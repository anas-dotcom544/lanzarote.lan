<?php

$actividades = [
    [
        "nombre" => "CrossFit",
        "monitor" => "Carlos",
        "plazas" => 15,
        "reservas" => 12,
        "precio" => 8
    ],
    [
        "nombre" => "Yoga",
        "monitor" => "Laura",
        "plazas" => 20,
        "reservas" => 20,
        "precio" => 6
    ],
    [
        "nombre" => "Pilates",
        "monitor" => "Ana",
        "plazas" => 12,
        "reservas" => 7,
        "precio" => 7
    ],
    [
        "nombre" => "Spinning",
        "monitor" => "Pedro",
        "plazas" => 18,
        "reservas" => 10,
        "precio" => 5
    ],
    [
        "nombre" => "Boxeo",
        "monitor" => "Lucía",
        "plazas" => 10,
        "reservas" => 10,
        "precio" => 9
    ],
    [
        "nombre" => "Natación",
        "monitor" => "Miguel",
        "plazas" => 16,
        "reservas" => 6,
        "precio" => 7
    ]
];


//EJERCICIO 2

//Añadir nueva actividad al array
array_push($actividades, [
    "nombre" => "Funcional",
    "monitor" => "David",
    "plazas" => 14,
    "reservas" => 4,
    "precio" => 6
]);

//Incrementar en 2 las reservas de Crossfit
foreach ($actividades as $indice => $actividad) {
    if ($actividad["nombre"] == "CrossFit") {
        $actividades[$indice]["reservas"] = $actividades[$indice]["reservas"] + 2;
    }
}

//Modificar precio Pilates a 8 euros
foreach ($actividades as $indice => $actividad) {
    if ($actividad["nombre"] == "Pilates") {
        $actividades[$indice]["precio"] = 8;
    }
}

//Eliminar la ultima actividad del array
array_pop($actividades)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="estilos.css">

    <title>Reservas Deportivas</title>


</head>
<body>

<h1>Gestion de reservas deportivas</h1>

<!--EJERCICIO 1-->

<h2>Catalogo de actividades</h2>

<table border="1">
    <tr>
        <th>Actividad</th>
        <th>Monitor</th>
        <th>Plazas totales</th>
        <th>Reservas</th>
        <th>Plazas disponibles</th>
        <th>Precio por persona</th>
    </tr>

    <?php

    //Recorrer array y mostrar las actividades
    foreach ($actividades as $actividad) {
        echo "<tr>";

        echo "<td>" . $actividad["nombre"] . "</td>";
        echo "<td>" . $actividad["monitor"] . "</td>";
        echo "<td>" . $actividad["plazas"] . "</td>";
        echo "<td>" . $actividad["reservas"] . "</td>";

    //Calcular plazas disponibles
        $disponibles = $actividad["plazas"] - $actividad["reservas"];

        echo "<td>" . $disponibles . "</td>";
        echo "<td>" . $actividad["precio"] . "€</td>";

        echo "</tr>";
    }
    ?>

</table>

<!--EJERCICIO 3-->

<h2>Estadisticas del centro</h2>

<?php

//Inicializamos variables para calculas las estadisticas
$totalActividades = count($actividades);
$totalReservas = 0;
$totalDisponibles = 0;
$recaudacion = 0;

//Recorrer array para sumar reservas, plazas disponibles y recaudacion
foreach ($actividades as $actividad) {

    $totalReservas = $totalReservas + $actividad["reservas"];

    $totalDisponibles = $totalDisponibles + $actividad["plazas"] - $actividad["reservas"];

    $recaudacion = $recaudacion + $actividad["reservas"] * $actividad["precio"];

}
?>

<!--Imprimimos los resultados-->
<p>Numero total de actividades: 
<?php echo $totalActividades; ?>
</p>

<p>Numero total de reservas: 
<?php echo $totalReservas; ?>
</p>

<p>Numero total de plazas disponibles: 
<?php echo $totalDisponibles; ?>
</p>

<p>Recaudacion prevista: 
<?php echo $recaudacion; ?>€
</p>

<!--EJERCICIO 4-->

<h2>Actividades con plazas disponibles</h2>

<?php
//Creamos un array para guardar las actividades con plazas libres
$disponibles = [];

//Recorremos el array actividades y miramos si tienen plazas disponibles
foreach ($actividades as $actividad) {
    if ($actividad["reservas"] < $actividad["plazas"]) {

    //Añadimos al array disponibles las actividades 
    //que cumplan la condicion (tengan plazas disponibles)
        array_push($disponibles, $actividad);
    }
}
?>

<table border="1">
    <tr>
        <th>Actividad</th>
        <th>Plazas disponibles</th>
    </tr>

    <?php
    //Mostramos las actvidades que todavia tienen plazas libres
    foreach ($disponibles as $actividad) {
        echo "<tr>";
        echo "<td>" . $actividad["nombre"] . "</td>";

    //Calcular plazas libres
        $plazasLibres = $actividad["plazas"] - $actividad["reservas"];

        echo "<td>" . $plazasLibres . "</td>";
        echo "</tr>";
    }
    ?>
</table>


<!--EJERCICIO 5-->

<h2>Actividades ordenadas por precio</h2>

<?php
//Creamos un array asociativo con nombre de cada actividad y su precio
$precios = [];

foreach ($actividades as $actividad) {
    $precios[$actividad["nombre"]] = $actividad["precio"];
}

//Ordenar precios de menor a mayor
asort($precios);
?>

<table border="1">
    <tr>
        <th>Actividad</th>
        <th>Precio</th>
    </tr>

    <?php
    //Mostramos actividades ordenadas por precio
    foreach ($precios as $nombre => $precio) {
        echo "<tr>";
        echo "<td>" . $nombre . "</td>";
        echo "<td>" . $precio . "€</td>";
        echo "</tr>";
    }
    ?>
</table>


<h2>Actividades ordenadas alfabeticamente</h2>

<?php
//Ordenar el array asociativo por el nombre
ksort($precios);
?>

<table border="1">
    <tr>
        <th>Actividad</th>
        <th>Precio</th>
    </tr>

    <?php
    //Mostrar actividades ordenadas alfabeticamente
    foreach ($precios as $nombre => $precio) {
        echo "<tr>";
        echo "<td>" . $nombre . "</td>";
        echo "<td>" . $precio . "€</td>";
        echo "</tr>";
    }
    ?>
</table>

<!--EJERCICIO 6-->

<h2>Actidades completas</h2>

<?php
//Creamos un array indexado para guardar 
//los nombres de las actividades completas
$completas = [];

//Recorremos el array actividades y comprobamos 
//si las reservas igualan las plazas maximas
foreach($actividades as $actividad) {
    if ($actividad["reservas"] == $actividad["plazas"]) {
    //Añadimos la actividad al array completas

        array_push($completas, $actividad["nombre"]);
    }
}
?>

<ul>
    <?php
    //Mostrar las activides completas en una lista
    foreach($completas as $nombre) {
        echo "<li>" . $nombre . "</li>";
    }
    ?>
</ul>

    
</body>
</html>