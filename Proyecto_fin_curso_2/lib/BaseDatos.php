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
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //si pilla algún error se va al catch
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // PDO::ATTR_ERRMODE: Configura cómo PDO maneja los errores.
    // PDO::ERRMODE_EXCEPTION: Hace que PDO lance excepciones (PDOException) cuando ocurre un error.

    public function getConnection()
    {
        return $this->connection;
    }

    /* Cierre de la conexión con la base de datos: Esto se hace en todas las funciones 
    para que no haya fugas de datos */

    public function cerrarConexion(): void
    {
        $this->connection = null;
    }

    public function __destruct()
    {
        $this->cerrarConexion();
    }
}
