<?php
class Database
{
    public static function conectar_datos()
    {
        $db = new mysqli('localhost', 'root', '', 'tienda');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}
