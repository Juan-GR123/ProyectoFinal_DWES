<?php
// models/BaseDatos.php

namespace Lib;

use PDO;
use PDOException;
use PDOStatement;

require_once 'config.php';

class BaseDatos
{
    private $host;
    private $dbname;
    private $user;
    private $pass;

    private $connection;

    public function __construct()
    {
        $this->host = DB_HOST;
        $this->dbname = DB_NAME;
        $this->user = DB_USER;
        $this->pass = DB_PASSWORD;
    }

    public function conectar_datos()
    {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->pass
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
    
}
