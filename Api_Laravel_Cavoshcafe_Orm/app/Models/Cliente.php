<?php

namespace App\Models;

class Cliente
{
    public static $db = []; 
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $codigo;

    public function __construct($nombre, $email, $password)
    {
        $this->id = count(self::$db) + 1;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->codigo = null;
    }

    public function save()
    {
        self::$db[] = $this;
    }

    public function generarCodigo()
    {
        $this->codigo = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public static function all()
    {
        return self::$db;
    }

    public static function findByEmail($email)
    {
        foreach (self::$db as $cliente) {
            if ($cliente->email === $email) return $cliente;
        }
        return null;
    }
}