<?php

class Modelo
{
    private $tabla;

    function __construct()
    {
        $this->tabla = 'usuarios';
    }


    // Escapa los valores de texto antes de construir la consulta SQL
    private function escapar($valor)
    {
        return BBDD::getInstancia()->getConexion()->real_escape_string((string) $valor);
    }


    // Recupera un usuario por su ID
    function recuperarUsuario($id)
    {
        $id = (int) $id;

        if ($id <= 0) {
            return null;
        }

        $query = new Query("
            SELECT *
            FROM {$this->tabla}
            WHERE id = '{$id}';
        ");

        return $query->recuperar();
    }


    function insertarUsuario($registro)
    {
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
                '". $registro['nombre'] ."'
                ,'". $registro['apellido1'] ."'
                ,'". $registro['apellido2'] ."'
                ,'". $registro['fecha_nacimiento'] ."'
                ,'". $registro['email'] ."'
                ,now()
                ,'". $_SERVER['SERVER_ADDR'] ."'
                ,now()
                ,'". $_SERVER['SERVER_ADDR'] ."'
            )
        ");
    
        return $query->total;
    }


    // Elimina un usuario por su ID
    function eliminarUsuario($id)
    {
        $id = (int) $id;

        if ($id <= 0) {
            return 0;
        }

        $query = new Query("
            DELETE FROM {$this->tabla}
            WHERE id = '{$id}';
        ");

        return $query->total;
    }


    function modificarUsuario($registro)
    {
        $id = (int) ($registro['id'] ?? 0);

        if ($id <= 0) {
            return 0;
        }

        $query = new Query("
            UPDATE {$this->tabla}
            SET
                 nombre             = '". $registro['nombre'] ."'
                ,apellido1          = '". $registro['apellido1'] ."'
                ,apellido2          = '". $registro['apellido2'] ."'
                ,fecha_nacimiento   = '". $registro['fecha_nacimiento'] ."'
                ,email              = '". $registro['email'] ."'
                ,fecha_modi         = now()
                ,ip_modi            = '". $_SERVER['SERVER_ADDR'] ."'
            WHERE id = '{$id}'
        ");

        return $query->total;
    }


    // Devuelve el número total de usuarios
    function contarUsuarios()
    {
        $query = new Query("SELECT COUNT(*) AS total FROM {$this->tabla}");
        $registro = $query->recuperar();

        return (int) ($registro['total'] ?? 0);
    }


    // Recupera los usuarios correspondientes a una página del listado
    function listarUsuarios($limite, $offset)
    {
        $query = new Query("
            SELECT *
            FROM {$this->tabla}
            ORDER BY fecha_alta DESC
            LIMIT {$limite}
            OFFSET {$offset}
        ");

        $usuarios = [];

        while ($registro = $query->recuperar())
        {
            $usuarios[] = $registro;
        }

        return $usuarios;
    }
}