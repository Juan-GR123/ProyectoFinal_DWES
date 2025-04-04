<?php

namespace Models;

use Lib\BaseDatos;

use PDO;


class Pedido
{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;

    private $db;

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
     * Get the value of usuaio_id
     */
    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    /**
     * Set the value of usuaio_id
     *
     * @return  self
     */
    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    /**
     * Get the value of provincia
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set the value of provincia
     *
     * @return  self
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get the value of localidad
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set the value of localidad
     *
     * @return  self
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of coste
     */
    public function getCoste()
    {
        return $this->coste;
    }

    /**
     * Set the value of coste
     *
     * @return  self
     */
    public function setCoste($coste)
    {
        $this->coste = $coste;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

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
     * Get the value of hora
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    public function __construct()
    {
        // $this->db = new BaseDatos();
        // $this->db->conectar_datos();  // Estableces la conexión
    }


    public function getPedidos()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

        $sql = "SELECT * FROM pedidos ORDER BY id DESC";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();

        $this->db->cerrarConexion();

        return $stmt->fetchAll(PDO::FETCH_OBJ); // Devolver el array de pedidos como un objeto 
    }

    public function get_id_pedidos()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

        $sql = "SELECT * FROM pedidos WHERE id=:id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        $this->db->cerrarConexion(); //se cierra la conexión para que no haya fugas

        return $stmt->fetch(PDO::FETCH_OBJ); //devuelve un objeto
    }

    public function getPedidosByUser()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

        //te localiza si hay un usuario con el id requerido y su existe que muestres el coste y
        // el id de sus pedidos 

        $sql = "SELECT p.id, p.coste  FROM pedidos p    WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();

        $this->db->cerrarConexion();

        return $stmt->fetch(PDO::FETCH_OBJ); // Devolver el array como objeto
    }

    public function get_todos_pedidos()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

        //coge en la consulta todos los pedidos pertenecientes a un usuario
        $sql = "SELECT p.* FROM pedidos p WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();

        $this->db->cerrarConexion();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
        //// fetch() -> Devuelve solo una fila (el primer pedido del usuario)

        /// Devuelve todas las filas (todos los pedidos del usuario)
    }

    public function get_Productos_Pedido($id)
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

        // $sql = "SELECT * FROM productos WHERE id IN (SELECT producto_id FROM lineas_pedidos WHERE pedido_id={$id})";

        //muestra todos los productos de un pedido donde el id del pedido sea igual al id que se pasa
        $sql = "SELECT pr.*, lp.unidades FROM productos pr INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id WHERE lp.pedido_id = {$id}";

        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();

        // Obtener todos los productos como un array de objetos
        $productos = $stmt->fetchAll(PDO::FETCH_OBJ);

        $this->db->cerrarConexion();

        return $productos; // Devolver un array de objetos
    }


    public function save()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

        $sql = "INSERT INTO pedidos (usuario_id,provincia, localidad, direccion, coste, estado, fecha, hora)
        VALUES (:usuario_id,:provincia, :localidad, :direccion, :coste, 'confirm', CURDATE(), CURTIME())";

        // Prepara la consulta
        $stmt = $this->db->getConnection()->prepare($sql);

        // Asigna los valores a los parámetros
        $stmt->bindValue(':usuario_id', $this->getUsuario_id());
        $stmt->bindValue(':provincia', $this->getProvincia());
        $stmt->bindValue(':localidad', $this->getLocalidad());
        $stmt->bindValue(':direccion', $this->getDireccion());
        $stmt->bindValue(':coste', $this->getCoste());


        // bindValue() es más comúnmente usado cuando el valor no cambia y quieres un enlace simple y directo.
        // bindParam() es útil cuando el valor de la variable se puede modificar antes de ejecutar la consulta, o si estás ejecutando la misma consulta varias veces con diferentes valores para el parámetro.

        // Ejecuta la consulta
        $resultado = $stmt->execute();
        //si existe la consulta se asegura de que el id vaya por orden
        if ($resultado) {
            $pedido_id = $this->id = $this->db->getConnection()->lastInsertId();
            $this->db->cerrarConexion();
            return $pedido_id; // Devolvemos el ID para usarlo en las líneas de pedido
        }

        $this->db->cerrarConexion();
    }

    public function save_linea($pedido_id)
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Establecer la conexión

        // Insertamos las líneas del pedido en la tabla 'lineas_pedidos'
        $save = false;
        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];

            // Preparamos la inserción en la tabla 'lineas_pedidos'
            $insert = "INSERT INTO lineas_pedidos (pedido_id, producto_id, unidades) VALUES (:pedido_id, :producto_id, :unidades)";
            $save = $this->db->getConnection()->prepare($insert);

            // Vinculamos los parámetros
            $save->bindValue(':pedido_id', $pedido_id);
            $save->bindValue(':producto_id', $producto->id);
            $save->bindValue(':unidades', $elemento['unidades']);

            // Ejecutamos la inserción
            $save = $save->execute();
        }

        $this->db->cerrarConexion();
        return $save;  // Devolvemos el resultado de la inserción de las líneas
    }

    public function edit()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

        $sql = "UPDATE pedidos SET estado=:estado WHERE id=:id";

        // Preparar la consulta
        $stmt = $this->db->getConnection()->prepare($sql);

        // Asignar los valores a los parámetros
        $stmt->bindValue(':estado', $this->getEstado());

        $stmt->bindValue(':id', $this->getId()); // Condición para editar solo el producto correcto

        $this->db->cerrarConexion();

        // Ejecutar la consulta y devolver el resultado
        return $stmt->execute();
    }

    public function delete()
    {
        $this->db = new BaseDatos();
        $this->db->conectar_datos();  // Estableces la conexión

        // Eliminar primero las líneas del pedido
        $sql = "DELETE FROM lineas_pedidos WHERE pedido_id = :pedido_id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':pedido_id', $this->id, PDO::PARAM_INT);

        // Ejecutamos la eliminación de las líneas del pedido
        $lineas_eliminadas = $stmt->execute();


        // Ahora eliminar el pedido
        $sql = "DELETE FROM pedidos WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        // Ejecutamos la eliminación del pedido
        $resultado = $stmt->execute();


        $this->db->cerrarConexion();

        return $resultado; //devuelve un objeto

    }
}
