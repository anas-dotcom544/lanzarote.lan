<?php

class Template {

    function __construct($idioma = 'ES')
    {
        $this->idioma = $idioma;
    }

    // XAMPP sirve la web desde una subcarpeta; en Linux puede servirse desde /.
    // Así los CSS, JS e imágenes funcionan también con URLs reescritas.
    public static function baseUrl()
    {
        $ruta = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php'));
        return ($ruta === '/' || $ruta === '.') ? '' : rtrim($ruta, '/');
    }

    static function header($titulo, $descripcion = '', $paginaInterior = false)
    {
        $base = self::baseUrl();
        $titulo = htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8');
        $claseBody = $paginaInterior ? ' class="pagina-interior"' : '';

        return '
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                <meta name="description" content="' . $descripcion . '" />
                <meta name="author" content="" />
                <title>' . $titulo . '</title>
                <link rel="icon" type="image/x-icon" href="' . $base . '/assets/favicon.ico" />
                <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
                <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
                <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
                <link href="' . $base . '/assets/css/styles.css" rel="stylesheet" />
            </head>
            <body id="page-top"' . $claseBody . '>
        ' . self::navegacion();
    }

    static function navegacion()
    {
        $base = self::baseUrl();

        return '
            <!-- Navigation: navegación original de index.html -->
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
                <div class="container">
                    <a class="navbar-brand" href="' . $base . '/index.php#page-top"><img src="' . $base . '/img/navbar-logo.svg" alt="..." /></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        Menu
                        <i class="fas fa-bars ms-1"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                            <li class="nav-item"><a class="nav-link" href="' . $base . '/index.php">Inicio</a></li>
                            <li class="nav-item"><a class="nav-link" href="' . $base . '/usuarios/listado/0">Usuarios</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        ';
    }

    static function footer()
    {
        $base = self::baseUrl();

        return '
            <!-- Footer: pie original de index.html -->
            <footer class="footer py-4">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2023</div>
                        <div class="col-lg-4 my-3 my-lg-0">
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                            <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                        </div>
                    </div>
                </div>
            </footer>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="' . $base . '/assets/js/scripts.js"></script>
            <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
            </body>
            </html>
        ';
    }
}
