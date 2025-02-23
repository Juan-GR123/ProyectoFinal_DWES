<?php

namespace Models;

use Lib\BaseDatos;

use PDO;


class Usuario
{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
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
     * Get the value of apellidos
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

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

    // Inserta un nuevo usuario en la base de datos con los datos del objeto actual 
    // y devuelve true si la inserción fue exitosa, o false si falló.
    public function save()
    {

        $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, rol, imagen)
            VALUES (:nombre, :apellidos, :email, :password, 'user', NULL)";

        // Prepara la consulta
        $stmt = $this->db->getConnection()->prepare($sql);

        // Asigna los valores a los parámetros
        $stmt->bindValue(':nombre', $this->nombre);
        $stmt->bindValue(':apellidos', $this->apellidos);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':password', password_hash($this->getPassword(), PASSWORD_BCRYPT, ['cost' => 4]));

        // bindValue() es más comúnmente usado cuando el valor no cambia y quieres un enlace simple y directo.
        // bindParam() es útil cuando el valor de la variable se puede modificar antes de ejecutar la consulta, o si estás ejecutando la misma consulta varias veces con diferentes valores para el parámetro.

        // Ejecuta la consulta
        return $stmt->execute();
    }


    // Verifica si existe un usuario con el email proporcionado, compara la contraseña ingresada con la almacenada 
    // y devuelve el objeto del usuario si la autenticación es correcta, o false si falla.
    public function login()
    {
        $result = false;
        $email = $this->email;
        $password = $this->password;

        // Consulta SQL usando prepared statements
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->db->getConnection()->prepare($sql); // Usamos getConnection() para obtener la conexión PDO

        // Vinculamos el parámetro :email
        $stmt->bindValue(':email', $email);

        // Ejecutamos la consulta
        $stmt->execute();

        // Verificamos si encontramos un usuario
        if ($stmt->rowCount() == 1) {
            $usuario = $stmt->fetch(PDO::FETCH_OBJ);

            // Verificar la contraseña
            $verify = password_verify($password, $usuario->password);

            if ($verify) {
                $result = $usuario;  // Si la autenticación es correcta, devolvemos el usuario
            }
        }

        return $result;
    }
}
