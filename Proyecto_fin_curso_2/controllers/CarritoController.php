<?php


namespace Controllers;

use Models\Producto;
use PDO;

class carritoController
{
    public function index()
    {
        if (($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) {
            $carrito = $_SESSION['carrito'];
        } else {
            $carrito = [];
        }

        require_once 'views/carrito/index.php';
        // echo "Controlador Carrito, Acción index";
    }

    public function add()
    {

        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            header('Location:' . base_url);
        }

        // if (!isset($_SESSION['carrito'])) {
        //     $_SESSION['carrito'] = array();
        // }

        if (isset($_SESSION['carrito'])) {
            $counter = 0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $producto_id) {
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $counter++;
                }
            }
        }

        if (!isset($counter) || $counter == 0) {
            //Conseguir producto
            $producto = new Producto();
            $producto->setId($producto_id);
            $stmt = $producto->getProductos();

            // Obtener el producto con el id especificado
            $producto = $producto->get_id_productos();  // Usamos get_id_productos para obtener un solo producto

            //Añadir al carrito
            if ($producto) {
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            } else {
                // Si el producto no existe, redirige al inicio o muestra un error
                header('Location: ' . base_url);
            }
        }


        header("Location: " . base_url . "carrito/index");
    }

    public function delete()
    {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header("Location: " . base_url . "carrito/index");
    }

    public function aumentar()
    {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        header("Location: " . base_url . "carrito/index");
    }

    public function disminuir()
    {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            if ($_SESSION['carrito'][$index]['unidades'] == 0) {
                unset($_SESSION['carrito'][$index]);
            }
        }
        header("Location: " . base_url . "carrito/index");
    }

    public function delete_toditos()
    {
        if (isset($_SESSION['carrito'])) {
            unset($_SESSION['carrito']);
        }
        header("Location: " . base_url . "carrito/index");
    }
}
