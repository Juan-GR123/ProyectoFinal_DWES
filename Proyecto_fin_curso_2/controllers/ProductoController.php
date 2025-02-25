<?php


namespace Controllers;

use Helpers\Utils;
use Models\Producto;


class productoController
{
    public function index()
    {
        require_once 'views/producto/destacados.php';
    }

    public function gestion()
    {
        Utils::isAdmin();

        $producto = new Producto();
        $productos = $producto->getProductos();

        require_once 'views/producto/gestion.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }


    //ESTO NO ESTA ACABADO!!!
    public function save()
    {
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
            $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : false;
            $precio = isset($_POST['precio']) ? trim($_POST['precio']) : false;
            $stock = isset($_POST['stock']) ? trim($_POST['stock']) : false;
            $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : false;
            // $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;


            if (!$nombre || !preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]{3,100}$/", $nombre)) {
                $_SESSION['error_producto'] = 'El nombre es inválido (mínimo 3 caracteres alfanuméricos).';
                header("Location:" . base_url . 'producto/crear');
                exit();
            }

            // Validar la descripción
            if (!$descripcion || strlen($descripcion) < 10) {
                $_SESSION['error_producto'] = 'La descripción debe tener al menos 10 caracteres.';
                header("Location:" . base_url . 'producto/crear');
                exit();
            }

            // Validar el precio (número positivo)

            if (!$precio || !filter_var($precio, FILTER_VALIDATE_FLOAT) || $precio <= 0) {
                $_SESSION['error_producto'] = 'El precio debe ser un número válido y mayor que 0.';
                header("Location:" . base_url . 'producto/crear');
                exit();
            }

            // Validar el stock (número entero positivo)
            // La función filter_var($variable, FILTER_VALIDATE_INT) en PHP se utiliza para validar si una variable es un número entero válido.
            if (!$stock || !filter_var($stock, FILTER_VALIDATE_INT) || $stock < 0) {
                $_SESSION['error_producto'] = 'El stock debe ser un número entero positivo.';
                header("Location:" . base_url . 'producto/crear');
                exit();
            }

            // Validar la categoría (número entero positivo)
            if (!$categoria || !filter_var($categoria, FILTER_VALIDATE_INT)) {
                $_SESSION['error_producto'] = 'La categoría seleccionada no es válida.';
                header("Location:" . base_url . 'producto/crear');
                exit();
            }

            // Validar la imagen si es requerida (opcional)
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
                $tipoImagen = $_FILES['imagen']['type'];
                if (!in_array($tipoImagen, ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'])) {
                    $_SESSION['error_producto'] = 'El formato de la imagen no es válido (solo JPG, PNG o GIF).';
                    header("Location:" . base_url . 'producto/crear');
                    exit();
                }
            }


            // Si todos los campos son válidos, guardar el producto
            $producto = new Producto();
            $producto->setNombre($nombre);
            $producto->setDescripcion($descripcion);
            $producto->setPrecio($precio);
            $producto->setStock($stock);

            // Guardar la imagen si se subió
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
                $nombreImagen = time() . '_' . $_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'], 'uploads/images/' . $nombreImagen);
                $producto->setImagen($nombreImagen);
            }

            $save = $producto->save();

            if ($save) {
                $_SESSION['producto'] = 'complete';
            } else {
                $_SESSION['producto'] = 'failed';
            }
        } else {
            $_SESSION['producto'] = 'failed';
        }

        header("Location:" . base_url . 'producto/crear');
        exit();
    }
}
