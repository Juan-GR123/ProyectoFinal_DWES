<?php
class Database
{
    public static function conectar_datos()
    {//Creo una función con la cual me pueda conectar a la base de datos de tienda
        $db = new mysqli('localhost', 'root', '', 'tienda');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}
