<?php

/*Creamos el array de peliculas*/
$peliculas = [ 
    [
        "titulo" => "El Señor de los Anillos: La Comunidad del Anillo",
        "director" => "Peter Jackson",
        "anio" => 2001,
        "genero" => "Fantasía",
        "poster" => "imagenes/anillos.png"
    ],
    [
        "titulo" => "Inception",
        "director" => "Christopher Nolan",
        "anio" => 2010,
        "genero" => "Ciencia Ficción",
        "poster" => "imagenes/inception.png"
    ],
    [
        "titulo" => "Fast & Furious 10",
        "director" => "Louis Leterrier",
        "anio" => 2023,
        "genero" => "Acción",
        "poster" => "imagenes/fast.png"
    ],
    [
        "titulo" => "Spider-Man: Brand New Day",
        "director" => "Destin Daniel Cretton",
        "anio" => 2026,
        "genero" => "Ciencia Ficción",
        "poster" => "imagenes/spidey.png"
    ],
    [
        "titulo" => "La Odisea",
        "director" => "Christopher Nolan",
        "anio" => 2026,
        "genero" => "Acción",
        "poster" => "imagenes/odisea.png"
    ],
    [
        "titulo" => "Los Pecadores",
        "director" => "Ryan Coogler",
        "anio" => 2025,
        "genero" => "Terror",
        "poster" => "imagenes/sinners.png"
    ],
];

/*Creamos el array de generos*/
/*Este procedimiento crea una lista de géneros sin duplicados que podrás utilizar para generar las opciones del desplegable.*/
$generos = [];

foreach ($peliculas as $pelicula) { if (!in_array($pelicula['genero'], $generos, true)) { $generos[] = $pelicula['genero']; } } ?>


<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">

    <!--CSS-->
    <link rel="stylesheet" href="estilosCatalogo.css">
    
    <title>Peliculas</title>
</head>
<body>

<h1 class="text-center my-4">Catalogo</h1>

<!--Declaramos la variable mediante GET para usarlo 
en el formulario y el usuaro pueda seleccionar el genero-->
<?php
$generoSeleccionado = $_GET["genero"] ?? "";
?>

<div class="d-flex justify-content-center my-4">
    <!--Creamos el formulario con metodo GET-->
    <form method="get" action="catalogo.php" class="d-flex align-items-center gap-2">
        <label for="genero">Filtrar por género:</label>
        <select name="genero" id="genero" class="form-control w-auto">
            <option value="">Todos</option>
            <?php foreach ($generos as $genero): ?> 
                <option value="<?php echo $genero; ?>" <?php if ($genero == $generoSeleccionado) echo 'selected'; ?>>
                    <?php echo $genero; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Filtrar" class="btn-solid theme-primary">
    </form>
</div>


<div class="container mt-4">
    <div class="row">

        <!--Usamos un foreach para recorrer el array de 
        peliculas y que aparezca una por una-->
        <?php

        foreach ($peliculas as $pelicula) {

            /*Si el filtrado es vacio o si ha seleccionado algun genero*/
            if ($generoSeleccionado == "" || $pelicula["genero"] == $generoSeleccionado) {

                echo '<div class="col-4 mb-4">';

                    echo '<div class="card h-100">';

                        echo "<img class='card-img-top poster' src='" . $pelicula["poster"] . "'>";

                        echo '<div class="card-body">';

                            echo "<h2>" . $pelicula["titulo"] . "</h2>";
                            echo "<p>Director: " . $pelicula["director"] . "</p>";
                            echo "<p>Año: " . $pelicula["anio"] . "</p>";
                            echo "<p>Género: " . $pelicula["genero"] . "</p>";

                        echo '</div>';

                    echo '</div>';

                echo '</div>';

            }
        }
        ?>

    </div>
</div>
    
</body>
</html>