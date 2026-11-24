
<?php

class Template
{
    private $templateDir;

    public function __construct($templateDir = 'tpl')
    {
        $this->templateDir = rtrim($templateDir, '/');
    }

    public static function baseUrl()
    {
        $ruta = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php'));
        return ($ruta === '/' || $ruta === '.') ? '' : rtrim($ruta, '/');
    }

    public function render($file, $vars = [])
    {
        $path = __DIR__ . '/../' . $this->templateDir . '/' . $file . '.tpl';

        if (!file_exists($path))
            throw new Exception("La plantilla {$file} no existe en {$this->templateDir}");

        $contenido = file_get_contents($path);

        foreach ($vars as $key => $valor)
        {
            $contenido = str_replace('{' . $key . '}', $valor, $contenido);
        }

        return $contenido;
    }

    static function header($titulo, $descripcion = '', $paginaInterior = false)
    {
        $template = new Template();
        $base = self::baseUrl();
        $idioma = explode('.', $_SERVER['HTTP_HOST'] ?? 'www')[0];

        if ($idioma == 'www' || $idioma == 'lanzarote')
            $idioma = 'es';

        if ($idioma != 'en' && $idioma != 'es' && $idioma != 'de')
            $idioma = 'es';

        $html = $template->render('header', [
            'titulo' => htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8'),
            'descripcion' => htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8'),
            'base' => $base,
            'idioma' => $idioma,
            'claseBody' => $paginaInterior ? ' class="pagina-interior"' : ''
        ]);

        return $html . $template->render('nav', [
            'base' => $base,
            'usuarios' => htmlspecialchars(Idioma::lit('usuarios'), ENT_QUOTES, 'UTF-8'),
            'urlEspanol' => 'http://www.lanzarote.lan' . $base . '/',
            'urlIngles' => 'http://en.lanzarote.lan' . $base . '/',
            'urlAleman' => 'http://de.lanzarote.lan' . $base . '/'
        ]);
    }

    static function footer()
    {
        $template = new Template();

        return $template->render('footer', [
            'base' => self::baseUrl(),
            'anio' => date('Y')
        ]);
    }
}
