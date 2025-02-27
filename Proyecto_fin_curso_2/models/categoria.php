<?php

namespace Models;

use Lib\BaseDatos;
use PDO;

class Categoria
{
    private $id;
    private $nombre;
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
        $sql = "SELECT * FROM categorias ORDER BY id DESC";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt; // Devolver true o false
    }

    public function get_id_categorias()
    {
        $sql = "SELECT * FROM categorias WHERE id=:id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ); //devuelve un objeto
    }

    public function save()
    {
        $sql = "INSERT INTO categorias (id,nombre)
        VALUES (NULL,:nombre)";

        //el valos que corresponde a :nombre se asigna mas adelante

        // Prepara la consulta
        $stmt = $this->db->getConnection()->prepare($sql);

        // Asigna los valores a los parámetros
        //En este caso :nombre
        $stmt->bindValue(':nombre', $this->getNombre());

        // bindValue() es más comúnmente usado cuando el valor no cambia y quieres un enlace simple y directo.
        // bindParam() es útil cuando el valor de la variable se puede modificar antes de ejecutar la consulta, o si estás ejecutando la misma consulta varias veces con diferentes valores para el parámetro.

        // Ejecuta la consulta
        $resultado = $stmt->execute();
        //si existe la consulta se asegura de que su el id sea el que va por orden
        if ($resultado) {
            $this->id = $this->db->getConnection()->lastInsertId();
        }

        return $resultado;
    }

    public function delete()
    {
        $sql = "DELETE FROM categorias WHERE nombre = :nombre"; // Consulta SQL para eliminar por nombre

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindValue(':nombre', $this->getNombre()); // Asociar el nombre con el parámetro en la consulta

        return $stmt->execute(); // Ejecutar la consulta
    }
}
