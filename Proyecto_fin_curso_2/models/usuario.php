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
        // $this->db = new BaseDatos();
        // $this->db->conectar_datos();  

        // Antes establecia la conexión pero como daba error ahora establezco la conexión al 
        //principio de cada funcion y la cierro respectivamente
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
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

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
        $resultado = $stmt->execute();
        //si existe la consulta se asegura de que el id vaya por orden
        if ($resultado) {
            $this->id = $this->db->getConnection()->lastInsertId();
        }

        $this->db->cerrarConexion();

        return $resultado;
    }


    // Verifica si existe un usuario con el email proporcionado, compara la contraseña ingresada con la almacenada 
    // y devuelve el objeto del usuario si la autenticación es correcta, o false si falla.
    public function login()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

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
            $usuario = $stmt->fetch(PDO::FETCH_OBJ); //devuelve un objeto

            // Verificar la contraseña
            $verify = password_verify($password, $usuario->password);

            if ($verify) {
                $result = $usuario;  // Si la autenticación es correcta, devolvemos el usuario
            }
        }

        $this->db->cerrarConexion();

        return $result;
    }

    public function getUsuarios()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

        $sql = "SELECT * FROM usuarios ORDER BY id ASC";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute(); // Devuelve true o false

        $this->db->cerrarConexion();

        return $stmt->fetchAll(PDO::FETCH_OBJ); // Devuelve un array de objetos
    }

    // El método get_id_editar() se utiliza generalmente para recuperar un único registro de la base de datos, 
    // en este caso, un usuario específico, utilizando el ID de ese usuario
    public function get_id_editar()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        //  Se usa el método bindValue para asegurar que el parámetro :id en la consulta se 
        // reemplace por el ID real del usuario.
        $stmt->execute();

        $this->db->cerrarConexion();

        return $stmt->fetch(PDO::FETCH_OBJ); //devuelve un objeto
    }

    public function delete()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

        // Eliminar las líneas de pedido asociadas a los pedidos del usuario
        $sqlLineasPedidos = "DELETE FROM lineas_pedidos WHERE pedido_id IN (SELECT id FROM pedidos WHERE usuario_id = :id)";
        $stmtLineasPedidos = $this->db->getConnection()->prepare($sqlLineasPedidos);
        $stmtLineasPedidos->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmtLineasPedidos->execute();

        // Eliminar pedidos relacionados con el usuario
        $sqlPedidos = "DELETE FROM pedidos WHERE usuario_id = :id";
        $stmtPedidos = $this->db->getConnection()->prepare($sqlPedidos);
        $stmtPedidos->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmtPedidos->execute();

        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $resultado = $stmt->execute();  // Ejecutar correctamente

        $this->db->cerrarConexion();

        return $resultado; //devuelve o true o false
    }

    public function update()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email, password = :password, rol = :rol WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindValue(':nombre', $this->nombre);
        $stmt->bindValue(':apellidos', $this->apellidos);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':password', $this->password);
        $stmt->bindValue(':rol', $this->rol);
        $stmt->bindValue(':id', $this->id);

        $this->db->cerrarConexion();

        return $stmt->execute();
    }
}
