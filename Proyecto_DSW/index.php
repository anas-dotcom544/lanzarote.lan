<?php

require_once __DIR__ . '/includes/general.php';

$seccion = $_GET['seccion'] ?? '';
$esListadoUsuarios = ($seccion === 'usuarios');

echo Template::header(
    $esListadoUsuarios ? 'Usuarios - Lanzarote' : 'Lanzarote',
    '',
    $esListadoUsuarios
);

switch ($seccion) {
    case 'usuarios':
        $modeloUsuario = new Usuario();

        switch ($_GET['oper'] ?? '') {
            case 'alta':
                $base = Template::baseUrl();
                $boton_alta = '<input type="submit" class="btn btn-primary btn-xl text-uppercase" value="Alta de usuario" />';
                $errores = false;
                $disabled = '';
                $mensajes_errores = '';
                $mensaje_exito = '';
                $_error_nombre = '';
                $_error_apellido1 = '';
                $_error_apellido2 = '';
                $_error_fecha_nacimiento = '';
                $_error_email = '';

                if (($_POST['paso'] ?? '') == '1') {
                    $_texto_errores = '';

                    if (strlen($_POST['nombre']) < 3) {
                        $_error_nombre = 'error';
                        $_texto_errores = '<p>- El nombre debe tener al menos 3 caracteres.</p>';
                        $errores = true;
                    }

                    if (strlen($_POST['apellido1']) < 3) {
                        $_error_apellido1 = 'error';
                        $_texto_errores .= '<p>- El primer apellido debe tener al menos 3 caracteres.</p>';
                        $errores = true;
                    }

                    if (strlen($_POST['apellido2']) < 3) {
                        $_error_apellido2 = 'error';
                        $_texto_errores .= '<p>- El segundo apellido debe tener al menos 3 caracteres.</p>';
                        $errores = true;
                    }

                    if (!fecha_valida($_POST['fecha_nacimiento'])) {
                        $_error_fecha_nacimiento = 'error';
                        $_texto_errores .= '<p>- La fecha de nacimiento no tiene un formato válido.</p>';
                        $errores = true;
                    }

                    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        $_error_email = 'error';
                        $_texto_errores .= '<p>- El E-mail no tiene un formato válido.</p>';
                        $errores = true;
                    }

                    if ($errores) {
                        $mensajes_errores = "
                            <div class=\"info_errores mb-5 mt-5\" role=\"alert\">
                                {$_texto_errores}
                            </div>
                        ";
                    } else {
                        $mensaje_exito = '
                            <div class="alert alert-success mb-5 mt-5" role="alert">
                                <p>Operación realizada con éxito</p>
                            </div>
                        ';
                        $boton_alta = '';
                        $disabled = ' disabled="disabled" ';

                        $modeloUsuario->insertar($_POST);
                    }
                }

                $nombre = $_POST['nombre'] ?? '';
                $apellido1 = $_POST['apellido1'] ?? '';
                $apellido2 = $_POST['apellido2'] ?? '';
                $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
                $email = $_POST['email'] ?? '';

                echo "
                    <main class=\"page-section\">
                        <div class=\"container pt-5\">
                            <a href=\"{$base}/usuarios/listado/0\" class=\"btn btn-secondary mb-5\">Volver</a>
                            <h1 class=\"text-center text-uppercase mb-4\">Alta de usuarios</h1>
                            {$mensajes_errores}
                            {$mensaje_exito}
                            <form action=\"{$base}/usuarios/alta\" method=\"POST\">
                                <input type=\"hidden\" name=\"paso\" value=\"1\" />

                                <div class=\"mb-4 {$_error_nombre}\">
                                    <label for=\"nombreID\" class=\"form-label\">Nombre</label>
                                    <input {$disabled} type=\"text\" name=\"nombre\" class=\"form-control\" id=\"nombreID\" value=\"{$nombre}\" placeholder=\"Introduce tu nombre\">
                                </div>

                                <div class=\"mb-4 {$_error_apellido1}\">
                                    <label for=\"apellido1ID\" class=\"form-label\">Primer apellido</label>
                                    <input {$disabled} type=\"text\" name=\"apellido1\" class=\"form-control\" id=\"apellido1ID\" value=\"{$apellido1}\" placeholder=\"Introduce tu primer apellido\">
                                </div>

                                <div class=\"mb-4 {$_error_apellido2}\">
                                    <label for=\"apellido2ID\" class=\"form-label\">Segundo apellido</label>
                                    <input {$disabled} type=\"text\" name=\"apellido2\" class=\"form-control\" id=\"apellido2ID\" value=\"{$apellido2}\" placeholder=\"Introduce tu segundo apellido\">
                                </div>

                                <div class=\"mb-4 {$_error_fecha_nacimiento}\">
                                    <label for=\"fecha_nacimientoID\" class=\"form-label\">Fecha nacimiento</label>
                                    <input {$disabled} type=\"date\" name=\"fecha_nacimiento\" class=\"form-control\" id=\"fecha_nacimientoID\" value=\"{$fecha_nacimiento}\">
                                </div>

                                <div class=\"mb-4 {$_error_email}\">
                                    <label for=\"emailID\" class=\"form-label\">Email</label>
                                    <input {$disabled} type=\"email\" name=\"email\" class=\"form-control\" id=\"emailID\" value=\"{$email}\" placeholder=\"nombre@dominio.com\">
                                </div>

                                {$boton_alta}
                            </form>
                        </div>
                    </main>
                ";
                break;

            case 'editar':
                $base = Template::baseUrl();
                $id = (int) ($_GET['id'] ?? 0);

                $usuario = $modeloUsuario->recuperar($id);

                if (!$usuario) {
                    echo "
                        <main class=\"page-section\">
                            <div class=\"container pt-5\">
                                <a href=\"{$base}/usuarios/listado/0\" class=\"btn btn-secondary mb-5\">Volver</a>
                                <p>Usuario no encontrado.</p>
                            </div>
                        </main>
                    ";
                    break;
                }

                $boton_editar = '<input type="submit" class="btn btn-primary btn-xl text-uppercase" value="Guardar cambios" />';
                $errores = false;
                $disabled = '';
                $mensajes_errores = '';
                $mensaje_exito = '';
                $_error_nombre = '';
                $_error_apellido1 = '';
                $_error_apellido2 = '';
                $_error_fecha_nacimiento = '';
                $_error_email = '';

                if (($_POST['paso'] ?? '') == '1') {
                    $nombre = $_POST['nombre'];
                    $apellido1 = $_POST['apellido1'];
                    $apellido2 = $_POST['apellido2'];
                    $fecha_nacimiento = $_POST['fecha_nacimiento'];
                    $email = $_POST['email'];
                    $_texto_errores = '';

                    if (strlen($_POST['nombre']) < 3) {
                        $_error_nombre = 'error';
                        $_texto_errores = '<p>- El nombre debe tener al menos 3 caracteres.</p>';
                        $errores = true;
                    }

                    if (strlen($_POST['apellido1']) < 3) {
                        $_error_apellido1 = 'error';
                        $_texto_errores .= '<p>- El primer apellido debe tener al menos 3 caracteres.</p>';
                        $errores = true;
                    }

                    if (strlen($_POST['apellido2']) < 3) {
                        $_error_apellido2 = 'error';
                        $_texto_errores .= '<p>- El segundo apellido debe tener al menos 3 caracteres.</p>';
                        $errores = true;
                    }

                    if (!fecha_valida($_POST['fecha_nacimiento'])) {
                        $_error_fecha_nacimiento = 'error';
                        $_texto_errores .= '<p>- La fecha de nacimiento no tiene un formato válido.</p>';
                        $errores = true;
                    }

                    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        $_error_email = 'error';
                        $_texto_errores .= '<p>- El E-mail no tiene un formato válido.</p>';
                        $errores = true;
                    }

                    if ($errores) {
                        $mensajes_errores = "
                            <div class=\"info_errores mb-5 mt-5\" role=\"alert\">
                                {$_texto_errores}
                            </div>
                        ";
                    } else {
                        $datosUsuario = $_POST;
                        $datosUsuario['id'] = $id;
                        $modeloUsuario->modificar($datosUsuario);

                        $mensaje_exito = '
                            <div class="alert alert-success mb-5 mt-5" role="alert">
                                <p>Operación realizada con éxito</p>
                            </div>
                        ';
                        $boton_editar = '';
                        $disabled = ' disabled="disabled" ';
                    }
                } else {
                    $nombre = $usuario['nombre'];
                    $apellido1 = $usuario['apellido1'];
                    $apellido2 = $usuario['apellido2'];
                    $fecha_nacimiento = $usuario['fecha_nacimiento'];
                    $email = $usuario['email'];
                }

                // Mostramos los valores en los campos del formulario.
                $nombre_form = htmlspecialchars((string) $nombre, ENT_QUOTES, 'UTF-8');
                $apellido1_form = htmlspecialchars((string) $apellido1, ENT_QUOTES, 'UTF-8');
                $apellido2_form = htmlspecialchars((string) $apellido2, ENT_QUOTES, 'UTF-8');
                $fecha_nacimiento_form = htmlspecialchars((string) $fecha_nacimiento, ENT_QUOTES, 'UTF-8');
                $email_form = htmlspecialchars((string) $email, ENT_QUOTES, 'UTF-8');

                echo "
                    <main class=\"page-section\">
                        <div class=\"container pt-5\">
                            <a href=\"{$base}/usuarios/listado/0\" class=\"btn btn-secondary mb-5\">Volver</a>
                            <h1 class=\"text-center text-uppercase mb-4\">Modificar usuario</h1>
                            {$mensajes_errores}
                            {$mensaje_exito}
                            <form action=\"{$base}/usuarios/editar/{$id}\" method=\"POST\">
                                <input type=\"hidden\" name=\"paso\" value=\"1\" />
                                <input type=\"hidden\" name=\"id\" value=\"{$id}\" />

                                <div class=\"mb-4 {$_error_nombre}\">
                                    <label for=\"nombreID\" class=\"form-label\">Nombre</label>
                                    <input {$disabled} type=\"text\" name=\"nombre\" class=\"form-control\" id=\"nombreID\" value=\"{$nombre_form}\" placeholder=\"Introduce tu nombre\">
                                </div>

                                <div class=\"mb-4 {$_error_apellido1}\">
                                    <label for=\"apellido1ID\" class=\"form-label\">Primer apellido</label>
                                    <input {$disabled} type=\"text\" name=\"apellido1\" class=\"form-control\" id=\"apellido1ID\" value=\"{$apellido1_form}\" placeholder=\"Introduce tu primer apellido\">
                                </div>

                                <div class=\"mb-4 {$_error_apellido2}\">
                                    <label for=\"apellido2ID\" class=\"form-label\">Segundo apellido</label>
                                    <input {$disabled} type=\"text\" name=\"apellido2\" class=\"form-control\" id=\"apellido2ID\" value=\"{$apellido2_form}\" placeholder=\"Introduce tu segundo apellido\">
                                </div>

                                <div class=\"mb-4 {$_error_fecha_nacimiento}\">
                                    <label for=\"fecha_nacimientoID\" class=\"form-label\">Fecha nacimiento</label>
                                    <input {$disabled} type=\"date\" name=\"fecha_nacimiento\" class=\"form-control\" id=\"fecha_nacimientoID\" value=\"{$fecha_nacimiento_form}\">
                                </div>

                                <div class=\"mb-4 {$_error_email}\">
                                    <label for=\"emailID\" class=\"form-label\">Email</label>
                                    <input {$disabled} type=\"email\" name=\"email\" class=\"form-control\" id=\"emailID\" value=\"{$email_form}\" placeholder=\"nombre@dominio.com\">
                                </div>

                                {$boton_editar}
                            </form>
                        </div>
                    </main>
                ";
                break;

            
            case 'eliminar':
                $base = Template::baseUrl();
                $id = (int) ($_GET['id'] ?? 0);
            
                // Buscamos el usuario que queremos eliminar
                $usuario = $modeloUsuario->recuperar($id);
            
                if (!$usuario) {
                    echo "
                        <main class=\"page-section\">
                            <div class=\"container pt-5\">
                                <a href=\"{$base}/usuarios/listado/0\" class=\"btn btn-secondary mb-5\">Volver</a>
                                <p>Usuario no encontrado.</p>
                            </div>
                        </main>
                    ";
                    break;
                }
            
                // Si esta confirmado la eliminacion, borramos al usuario de la bbdd
                if (($_POST['paso'] ?? '') == '1') {
                    $modeloUsuario->eliminar($id);
            
                    echo "
                        <main class=\"page-section\">
                            <div class=\"container pt-5\">
                                <div class=\"alert alert-success mb-5\" role=\"alert\">
                                    Usuario eliminado correctamente.
                                </div>
                                <a href=\"{$base}/usuarios/listado/0\" class=\"btn btn-primary\">
                                    Volver al listado.
                                </a>
                            </div>
                        </main>
                    ";
                } else {
                    // Mostramos los datos del usuario antes de confirmar la eliminacion
            
                    $nombre = htmlspecialchars($usuario['nombre'], ENT_QUOTES, 'UTF-8');
                    $apellido1 = htmlspecialchars($usuario['apellido1'], ENT_QUOTES, 'UTF-8');
                    $apellido2 = htmlspecialchars($usuario['apellido2'], ENT_QUOTES, 'UTF-8');
                    $email = htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8');
            
                    echo "
                        <main class=\"page-section\">
                            <div class=\"container pt-5\">
                                <h1 class=\"text-center text-uppercase mb-4\">Eliminar usuario</h1>
            
                                <div class=\"alert alert-warning\" role=\"alert\">
                                    ¿Estas seguro de que quieres eliminar este usuario?
                                </div>
            
                                <p><strong>ID:</strong> {$id}</p>
                                <p><strong>Nombre:</strong> {$nombre}</p>
                                <p><strong>Primer apellido:</strong> {$apellido1}</p>
                                <p><strong>Segundo apellido:</strong> {$apellido2}</p>
                                <p><strong>Email:</strong> {$email}</p>
            
                                <form action=\"{$base}/usuarios/eliminar/{$id}\" method=\"POST\">
                                    <input type=\"hidden\" name=\"paso\" value=\"1\" />
                                    <input type=\"submit\" class=\"btn btn-danger\" value=\"Eliminar usuario\" />
                                    <a href=\"{$base}/usuarios/listado/0\" class=\"btn btn-secondary\">
                                        Cancelar
                                    </a>
                                </form>
                            </div>
                        </main>
                    ";
                }
            
                break;
            
            
            default:

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

        $consultaTotal = new Query('SELECT COUNT(*) AS total FROM usuarios');
        $registroTotal = $consultaTotal->recuperar();
        $totalUsuarios = (int) ($registroTotal['total'] ?? 0);
        $totalPaginas = (int) ceil($totalUsuarios / $porPagina);

        
        if ($totalPaginas === 0) {
            $pagina = 0;
        } elseif ($pagina >= $totalPaginas) {
            $pagina = $totalPaginas - 1;
        }
        $offset = $pagina * $porPagina;

        $usuarios = [];
        if ($totalUsuarios > 0) {

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
                    <a href="' . $base . '/usuarios/alta" class="btn btn-primary mb-4">Alta de Usuario</a>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido 1</th>
                                    <th scope="col">Apellido 2</th>
                                    <th scope="col">Fecha de nacimiento</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
        ';

        if (empty($usuarios)) {
            echo '<tr><td colspan="7" class="text-center py-4">No hay usuarios en esta página.</td></tr>';
        } else {
            foreach ($usuarios as $indice => $registro) {
                echo '<tr>';

                foreach (['id', 'nombre', 'apellido1', 'apellido2', 'fecha_nacimiento', 'email'] as $campo) {
                    echo '<td>' . htmlspecialchars(
                        (string) ($registro[$campo] ?? ''),
                        ENT_QUOTES | ENT_SUBSTITUTE,
                        'UTF-8'
                        
                    ) . '</td>';
                }
                $idUsuario = (int) $registro['id'];
                echo '<td>
                          <a class="btn btn-outline-primary btn-sm me-1 d-inline-flex align-items-center justify-content-center"
                             style="width: 36px; height: 36px;"
                             href="' . $base . '/usuarios/editar/' . $idUsuario . '"
                             title="Modificar usuario">
                              <i class="bi bi-pencil-square fs-5"></i>
                          </a>

                          <a class="btn btn-outline-danger btn-sm d-inline-flex align-items-center justify-content-center"
                             style="width: 36px; height: 36px;"
                             href="' . $base . '/usuarios/eliminar/' . $idUsuario . '"
                             title="Eliminar usuario">
                              <i class="bi bi-trash fs-5"></i>
                          </a>
                     </td>';

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
        }
        break;

    default:
        
        echo '
            <header class="masthead">
                <div class="container">
                    <div class="masthead-subheading">¡Bienvenido!</div>
                    <div class="masthead-heading text-uppercase">Un placer tenerte aqui</div>
                    <a class="btn btn-primary btn-xl text-uppercase" href="'
                    . Template::baseUrl() . '/usuarios/listado/0">Ver usuarios</a>
                </div>
            </header>
        ';
        break;
}

echo Template::footer();