
<?php

class Idioma
{
    private static $instancia = null;

    public static $lit = array();


    private function __construct()
    {
        $idioma = explode('.', $_SERVER['HTTP_HOST'])[0];


        if ($idioma == 'www' || $idioma == 'lanzarote')
            $idioma = 'es';

        if ($idioma != 'en' && $idioma != 'es' && $idioma != 'de')
            $idioma = 'es';

        $ruta = dirname(__DIR__) . '/lang/' . $idioma . '.txt';

        $descriptor = fopen($ruta, 'r');


        if ($descriptor)
        {

            while ($linea = fgets($descriptor))
            {
                $linea = trim($linea);


                $partes_linea = explode(':', $linea, 2);


                if (count($partes_linea) == 2)
                    self::$lit[$partes_linea[0]] = $partes_linea[1];


            }

            fclose($descriptor);

        }
    }


    public static function getInstancia(): Idioma {

        if (self::$instancia == null){

            self::$instancia = new Idioma();
        }


        return self::$instancia;
    }


    public static function lit($campo)
    {
        self::getInstancia();


        return self::$lit[$campo] ?? $campo;

    }


    public function __clone(){}
}
