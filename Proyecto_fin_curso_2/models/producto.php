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
     * Get the value of categoria_id
     */
    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    /**
     * Set the value of categoria_id
     *
     * @return  self
     */
    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;

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

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of oferta
     */
    public function getOferta()
    {
        return $this->oferta;
    }

    /**
     * Set the value of oferta
     *
     * @return  self
     */
    public function setOferta($oferta)
    {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getProductos()
    {
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt; // Devolver el objeto PDOStatement
    }

    public function getProductos_categoria()
    {
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos AS p  INNER JOIN categorias c ON c.id = p.categoria_id WHERE p.categoria_id = {$this->getCategoria_id()}  ORDER BY id DESC";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt; // Devolver el objeto PDOStatement
    }

    public function get_id_productos()
    {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ); //devuelve un objeto
    }

    public function getRandom($limit){
        $sql = "SELECT * FROM productos ORDER BY RAND() LIMIT $limit";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt; // Devolver el objeto PDOStatement
    }


    public function save()
    {
        $sql = "INSERT INTO productos (categoria_id,nombre, descripcion, precio, stock, oferta, fecha, imagen)
        VALUES (:categoria_id,:nombre, :descripcion, :precio, :stock, :oferta, CURDATE(), :imagen)";

        // Prepara la consulta
        $stmt = $this->db->getConnection()->prepare($sql);

        // Asigna los valores a los parámetros
        $stmt->bindValue(':categoria_id', $this->getCategoria_id());
        $stmt->bindValue(':nombre', $this->getNombre());
        $stmt->bindValue(':descripcion', $this->getDescripcion());
        $stmt->bindValue(':precio', $this->getPrecio());
        $stmt->bindValue(':stock', $this->getStock());
        $stmt->bindValue(':oferta', $this->getOferta() ?? 0); // Asigna 0 si es null
        // $stmt->bindValue(':oferta', $this->getOferta());
        // $stmt->bindValue(':fecha', $this->getFecha());
        $stmt->bindValue(':imagen', $this->getImagen());


        // bindValue() es más comúnmente usado cuando el valor no cambia y quieres un enlace simple y directo.
        // bindParam() es útil cuando el valor de la variable se puede modificar antes de ejecutar la consulta, o si estás ejecutando la misma consulta varias veces con diferentes valores para el parámetro.

        // Ejecuta la consulta
        $resultado = $stmt->execute();
        //si existe la consulta se asegura de que el id vaya por orden
        if ($resultado) {
            $this->id = $this->db->getConnection()->lastInsertId();
        }

        return $resultado;
    }

    public function edit()
    {
        $sql = "UPDATE productos SET 
                categoria_id = :categoria_id,
                nombre = :nombre,
                descripcion = :descripcion,
                precio = :precio,
                stock = :stock,
                oferta = :oferta";
        if ($this->getImagen() != null) {
            $sql .= ", imagen = :imagen";
        }

        $sql .=  " WHERE id = :id ";

        // Preparar la consulta
        $stmt = $this->db->getConnection()->prepare($sql);

        // Asignar los valores a los parámetros
        $stmt->bindValue(':categoria_id', $this->getCategoria_id());
        $stmt->bindValue(':nombre', $this->getNombre());
        $stmt->bindValue(':descripcion', $this->getDescripcion());
        $stmt->bindValue(':precio', $this->getPrecio());
        $stmt->bindValue(':stock', $this->getStock());
        $stmt->bindValue(':oferta', $this->getOferta() ?? 0); // Si es null, lo establece en 0
        if ($this->getImagen() != null) {
            $stmt->bindValue(':imagen', $this->getImagen());
        }
        $stmt->bindValue(':id', $this->getId()); // Condición para editar solo el producto correcto

        // Ejecutar la consulta y devolver el resultado
        return $stmt->execute();
    }

    public function delete()
    {
        $sql = "DELETE FROM productos WHERE id= :id";

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindValue(':id', $this->getId()); // Asociar el nombre con el parámetro en la consulta

        return $stmt->execute(); // Ejecutar la consulta

    }
}
