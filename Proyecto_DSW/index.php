<?php

require_once __DIR__ . '/includes/general.php';

// Las URL /usuarios/listado/0 y ?seccion=usuarios&pagina=0 llevan al mismo caso.
$seccion = $_GET['seccion'] ?? '';
$esListadoUsuarios = ($seccion === 'usuarios');

echo Template::header(
    $esListadoUsuarios ? 'Usuarios - Lanzarote' : 'Lanzarote',
    '',
    $esListadoUsuarios
);

switch ($seccion) {
    case 'usuarios':
        // Igual que en el proyecto del profesor: 10 registros por página.
        // Validamos "pagina" antes de utilizarla para calcular el OFFSET de SQL.
        $valorPagina = $_GET['pagina'] ?? 0;
        $pagina = filter_var(
            $valorPagina,
            FILTER_VALIDATE_INT,
            ['options' => [
                'min_range' => 0,
                'max_range' => intdiv(PHP_INT_MAX, TOTAL_PAGINAS_LISTADO),
            ]]
        );
        if ($pagina === false) {
            $pagina = 0;
        }

        $porPagina = TOTAL_PAGINAS_LISTADO;

        // Conocer cuántos usuarios existen permite mostrar 1, 2, 3... hasta
        // la última página real y ocultar "Siguiente" al llegar a ella.
        $consultaTotal = new Query('SELECT COUNT(*) AS total FROM usuarios');
        $registroTotal = $consultaTotal->recuperar();
        $totalUsuarios = (int) ($registroTotal['total'] ?? 0);
        $totalPaginas = (int) ceil($totalUsuarios / $porPagina);

        // Si piden una página fuera del rango, mostrar la última disponible.
        if ($totalPaginas === 0) {
            $pagina = 0;
        } elseif ($pagina >= $totalPaginas) {
            $pagina = $totalPaginas - 1;
        }
        $offset = $pagina * $porPagina;

        $usuarios = [];
        if ($totalUsuarios > 0) {
            // ORDER BY garantiza que los usuarios mantienen el mismo orden.
            $query = new Query(
                'SELECT id, nombre, apellido1, apellido2, fecha_nacimiento, email '
                . 'FROM usuarios ORDER BY id ASC '
                . 'LIMIT ' . $porPagina . ' OFFSET ' . $offset
            );

            while ($registro = $query->recuperar()) {
                $usuarios[] = $registro;
            }
        }

        $base = Template::baseUrl();

        echo '
            <main class="page-section">
                <div class="container pt-5">
                    <h1 class="text-center text-uppercase mb-4">Listado de usuarios</h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido 1</th>
                                    <th scope="col">Apellido 2</th>
                                    <th scope="col">Fecha de nacimiento</th>
                                    <th scope="col">E-mail</th>
                                </tr>
                            </thead>
                            <tbody>
        ';

        if (empty($usuarios)) {
            echo '<tr><td colspan="7" class="text-center py-4">No hay usuarios en esta página.</td></tr>';
        } else {
            foreach ($usuarios as $indice => $registro) {
                echo '<tr><th scope="row">' . ($offset + $indice + 1) . '</th>';

                // Escapamos lo que viene de la base de datos antes de imprimir HTML.
                foreach (['id', 'nombre', 'apellido1', 'apellido2', 'fecha_nacimiento', 'email'] as $campo) {
                    echo '<td>' . htmlspecialchars(
                        (string) ($registro[$campo] ?? ''),
                        ENT_QUOTES | ENT_SUBSTITUTE,
                        'UTF-8'
                        
                    ) . '</td>';
                }
                echo '</tr>';
            }
        }

        echo '
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Paginación de usuarios">
                        <ul class="pagination justify-content-center">
        ';

        if ($pagina > 0) {
            $paginaAnterior = $pagina - 1;
            echo '<li class="page-item"><a class="page-link" href="' . $base . '/usuarios/listado/'
                . $paginaAnterior . '">Anterior</a></li>';
        }

        // Números visibles (1, 2, 3...) con el actual resaltado.
        // En la URL las páginas comienzan en 0; en pantalla, en 1.
        for ($numeroPagina = 0; $numeroPagina < $totalPaginas; $numeroPagina++) {
            if ($numeroPagina === $pagina) {
                echo '<li class="page-item active" aria-current="page">'
                    . '<span class="page-link">' . ($numeroPagina + 1) . '</span></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="' . $base
                    . '/usuarios/listado/' . $numeroPagina . '">'
                    . ($numeroPagina + 1) . '</a></li>';
            }
        }

        // Ocultamos "Siguiente" en la última página.
        if ($pagina < $totalPaginas - 1) {
            $paginaSiguiente = $pagina + 1;
            echo '<li class="page-item"><a class="page-link" href="' . $base . '/usuarios/listado/'
                . $paginaSiguiente . '">Siguiente</a></li>';
        }

        echo '
                        </ul>
                    </nav>
                </div>
            </main>
        ';
        break;

    default:
        // Conservamos la portada original del proyecto Agency.
        echo '
            <header class="masthead">
                <div class="container">
                    <div class="masthead-subheading">Bienvenido!</div>
                    <div class="masthead-heading text-uppercase">Un placer tenerte aqui</div>
                    <a class="btn btn-primary btn-xl text-uppercase" href="'
                    . Template::baseUrl() . '/usuarios/listado/0">Ver usuarios</a>
                </div>
            </header>
        ';
        break;
}

echo Template::footer();
