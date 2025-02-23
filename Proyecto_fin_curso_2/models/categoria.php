<?php 
namespace Models;

use Lib\BaseDatos;
use PDO;

class Categoria extends BaseDatos{
    private $id;
    private $nombre;
    

    public function __construct()
    {
        parent::__construct();
        $this->conectar_datos();
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    // public function getCategorias(){
    //     $categorias = $this->db->query("SELECT * FROM categorias");
    //     return $categorias;
    // }

    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias";
        $stmt = $this->getConnection()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>