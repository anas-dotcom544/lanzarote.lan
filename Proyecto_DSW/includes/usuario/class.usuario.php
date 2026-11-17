<?php

class Usuario
{
    private $modelo;

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
        $this->modelo = new Modelo();
    }


    // Recupera un usuario y carga sus datos en el objeto
    function recuperar($id)
    {
        $registro = $this->modelo->recuperarUsuario($id);

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


    // Delega la inserción del usuario en la clase Modelo
    function insertar($registro)
    {
        return $this->modelo->insertarUsuario($registro);
    }


    // Delega la eliminación del usuario en la clase Modelo
    function eliminar($id)
    {
        return $this->modelo->eliminarUsuario($id);
    }


    // Delega la modificación del usuario en la clase Modelo
    function modificar($registro)
    {
        return $this->modelo->modificarUsuario($registro);
    }


    // Devuelve el número total de usuarios
    function contar()
    {
        return $this->modelo->contarUsuarios();
    }


    // Devuelve los usuarios correspondientes a una página del listado
    function listar($limite, $offset)
    {
        return $this->modelo->listarUsuarios($limite, $offset);
    }
}
