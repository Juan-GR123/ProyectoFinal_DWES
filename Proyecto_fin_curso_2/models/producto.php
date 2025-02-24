<?php 
namespace Models;

use Lib\BaseDatos;

use PDO;


class Producto
{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;


    public function __construct()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión
    }
}

?>