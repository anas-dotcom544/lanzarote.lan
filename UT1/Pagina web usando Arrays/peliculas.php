<?php
$apiKey = '249a6fe69b2b2b9dc31af4b751047fd7';

$url = 'https://api.themoviedb.org/3/movie/popular'
     . '?api_key=' . $apiKey
     . '&language=es-ES';

// Realizar petición HTTP
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$respuesta = curl_exec($ch);

if ($respuesta === false) {
    die('Error de conexión: ' . curl_error($ch));
}

$codigoHttp = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($codigoHttp !== 200) {
    die('Error HTTP: ' . $codigoHttp);
}

// Convertir JSON a array PHP
$datos = json_decode($respuesta, true);

if (!isset($datos['results'])) {
    die('Error al obtener películas');
}

$peliculas = $datos['results'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="estilosPelis.css">

    <title>Películas populares</title>
</head>

<body>
    <h1>Películas populares</h1>

    <div class="contenedor-peliculas">

        <?php foreach ($peliculas as $pelicula): ?>

            <?php if ($pelicula['vote_average'] >= 7): ?>

                <article class="tarjeta">

                    <?php if (!empty($pelicula['poster_path'])): ?>
                        <img
                            src="https://image.tmdb.org/t/p/w342<?= htmlspecialchars($pelicula['poster_path']) ?>"
                            alt="Carátula de <?= htmlspecialchars($pelicula['title']) ?>"
                        >
                    <?php endif; ?>

                    <div class="contenido-tarjeta">

                        <h2>
                            <?= htmlspecialchars($pelicula['title']) ?>
                        </h2>

                        <p>
                            <strong>Estreno:</strong>
                            <?= htmlspecialchars($pelicula['release_date'] ?? 'Sin fecha') ?>
                        </p>

                        <p class="valoracion">
                            ⭐ <?= round($pelicula['vote_average'], 1) ?>/10
                        </p>

                        <p class="sinopsis">
                            <?= htmlspecialchars($pelicula['overview'] ?? 'Sin sinopsis disponible') ?>
                        </p>

                    </div>

                </article>

            <?php endif; ?>

        <?php endforeach; ?>

    </div>
</body>

</html>