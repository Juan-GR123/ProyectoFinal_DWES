<?php

namespace Controllers;

use Helpers\Utils;
use Models\Pedido;

class pedidoController
{
    public function hacer()
    {
        require_once 'views/pedido/hacer.php';
    }

    public function add()
    {
        // var_dump($_POST);
        if (isset($_SESSION['identidad'])) {
            //Guardar datos en bd   
            $usuario_id = $_SESSION['identidad']->id;
            // var_dump($usuario_id);
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            $mostrar = Utils::Carrito_mostrar();
            $coste = $mostrar['total'];

            $errores = [];
            if (!is_numeric($usuario_id)) {
                $errores[] = "Error: usuario_id debe ser un número.<br>";
            }

            //validación de los valores
            if ($provincia && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $provincia)) {
                $errores[] = "Error: La provincia solo puede contener letras y espacios.<br>";
            }

            if ($localidad && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $localidad)) {
                echo "Error: La ciudad solo puede contener letras y espacios.<br>";
                return;
            }

            if ($direccion && !preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\.,º\-#]+$/", $direccion)) {
                $errores[] = "Error: La dirección solo puede contener letras, números, espacios, comas, puntos y guiones.<br>";
            }


            if (!is_numeric($coste)) {
                $errores[] = "Error: El coste debe ser un número.<br>";
            }

            if (empty($errores)) {

                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                // Guardamos el pedido y obtenemos el ID del pedido
                $pedido_id = $pedido->save();

                // Ahora que tenemos el ID del pedido, guardamos las líneas
                if ($pedido_id) {
                    $save_linea = $pedido->save_linea($pedido_id); // Pasamos el ID del pedido

                    if ($save_linea) {
                        $_SESSION['pedido'] = "complete";
                    } else {
                        $_SESSION['pedido'] = "failed";
                    }
                }

                //  var_dump($pedido);
            } else {
                $_SESSION['pedido'] = "failed";
            }
        } else {
            //Redirigir al index
            header("Location: " . base_url);
        }
        header("Location:" . base_url . 'pedido/confirmado');
    }

    public function confirmado()
    {
        if (isset($_SESSION['identidad'])) {
            $identidad = $_SESSION['identidad'];

            $pedido = new Pedido();
            $pedido->setUsuario_id($identidad->id);

            $pedido = $pedido->getPedidosByUser();

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->get_Productos_Pedido($pedido->id);
        }


        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos()
    {
        Utils::identidad_comprobar();


        $usuario_id = $_SESSION['identidad']->id;
        $pedido = new Pedido();

        //sacar los pedidos del usuario
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->get_todos_pedidos();

        require_once 'views/pedido/pedidos.php';
    }

    public function detalle()
    {
        Utils::identidad_comprobar();

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            //sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->get_id_pedidos();

            //sacar los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->get_Productos_Pedido($id);

            require_once 'views/pedido/detalle.php';
        } else {
            header('Location:' . base_url . 'pedido/pedidos');
        }
    }

    public function gestion()
    {
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getPedidos();

        require_once 'views/pedido/pedidos.php';
    }

    public function estado_pedidos()
    {
        Utils::isAdmin();
        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            //Recogo los datos del form
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            //update del pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();

            header("Location:" . base_url. "pedido/detalle&id=".$id);
        } else {
            header("Location:" . base_url);
        }
    }
}
