<?php


class Usuario
{
    private $tabla;

    public $nombre;
    public $apellido1;
    public $apellido2;
    public $fecha_nacimiento;
    public $email;
    public $fecha_alta;
    public $ip_alta;
    public $fecha_modi;
    public $ip_modi;


    function __construct()
    {
        $this->tabla = 'usuarios';
    }


    // Recupera un usuario por su ID.
    function recuperar($id)
    {
        $id = (int) $id;

        $query = new Query("
            SELECT *
            FROM {$this->tabla}
            WHERE id = '{$id}';
        ");

        $registro = $query->recuperar();

        if ($registro) {
            $this->nombre            = $registro['nombre'];
            $this->apellido1         = $registro['apellido1'];
            $this->apellido2         = $registro['apellido2'];
            $this->fecha_nacimiento  = $registro['fecha_nacimiento'];
            $this->email             = $registro['email'];
            $this->fecha_alta        = $registro['fecha_alta'];
            $this->ip_alta           = $registro['ip_alta'];
            $this->fecha_modi        = $registro['fecha_modi'];
            $this->ip_modi           = $registro['ip_modi'];
        }

        return $registro;
    }


    // Escapa los valores de texto antes de construir la consulta SQL.
    private function escapar($valor)
    {
        return BBDD::getInstancia()->getConexion()->real_escape_string((string) $valor);
    }


    function insertar($registro)
    {
        $ip = $this->escapar($_SERVER['SERVER_ADDR'] ?? '');

        $query = new Query("
            INSERT INTO {$this->tabla}
            (
                 nombre
                ,apellido1
                ,apellido2
                ,fecha_nacimiento
                ,email
                ,fecha_alta
                ,ip_alta
                ,fecha_modi
                ,ip_modi
            )
            VALUES
            (
                '" . $this->escapar($registro['nombre'] ?? '') . "'
                ,'" . $this->escapar($registro['apellido1'] ?? '') . "'
                ,'" . $this->escapar($registro['apellido2'] ?? '') . "'
                ,'" . $this->escapar($registro['fecha_nacimiento'] ?? '') . "'
                ,'" . $this->escapar($registro['email'] ?? '') . "'
                ,now()
                ,'{$ip}'
                ,now()
                ,'{$ip}'
            )
        ");

        return $query->total;
    }


    function eliminar($id)
    {
        $id = (int) $id;

        $query = new Query("
            DELETE FROM {$this->tabla}
            WHERE id = '{$id}';
        ");

        return $query->total;
    }


    function modificar($registro)
    {
        $id = (int) ($registro['id'] ?? 0);
        $ip = $this->escapar($_SERVER['SERVER_ADDR'] ?? '');

        if ($id <= 0) {
            return 0;
        }

        $query = new Query("
            UPDATE {$this->tabla}
            SET
                 nombre             = '" . $this->escapar($registro['nombre'] ?? '') . "'
                ,apellido1          = '" . $this->escapar($registro['apellido1'] ?? '') . "'
                ,apellido2          = '" . $this->escapar($registro['apellido2'] ?? '') . "'
                ,fecha_nacimiento   = '" . $this->escapar($registro['fecha_nacimiento'] ?? '') . "'
                ,email              = '" . $this->escapar($registro['email'] ?? '') . "'
                ,fecha_modi         = now()
                ,ip_modi            = '{$ip}'
            WHERE id = '{$id}'
        ");

        return $query->total;
    }

}