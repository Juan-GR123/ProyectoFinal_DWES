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



    public function save()
    {
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
            $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : false;
            $precio = isset($_POST['precio']) ? trim($_POST['precio']) : false;
            $stock = isset($_POST['stock']) ? trim($_POST['stock']) : false;
            $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : false;
            $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;


            if (!$nombre || !preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]{3,100}$/", $nombre)) {
                $_SESSION['error_producto'] = 'El nombre es inválido (mínimo 3 caracteres alfanuméricos).';
                header("Location:" . base_url . 'producto/gestion');
                exit();
            }

            // Validar la descripción
            if (!$descripcion || strlen($descripcion) < 10) {
                $_SESSION['error_producto'] = 'La descripción debe tener al menos 10 caracteres.';
                header("Location:" . base_url . 'producto/gestion');
                exit();
            }

            // Validar el precio (número positivo)

            if (!$precio || !filter_var($precio, FILTER_VALIDATE_FLOAT) || $precio <= 0) {
                $_SESSION['error_producto'] = 'El precio debe ser un número válido y mayor que 0.';
                header("Location:" . base_url . 'producto/gestion');
                exit();
            }

            // Validar el stock (número entero positivo)
            // La función filter_var($variable, FILTER_VALIDATE_INT) en PHP se utiliza para validar si una variable es un número entero válido.
            if (!$stock || !filter_var($stock, FILTER_VALIDATE_INT) || $stock < 0) {
                $_SESSION['error_producto'] = 'El stock debe ser un número entero positivo.';
                header("Location:" . base_url . 'producto/gestion');
                exit();
            }

            // Validar la categoría (número entero positivo)
            if (!$categoria || !filter_var($categoria, FILTER_VALIDATE_INT)) {
                $_SESSION['error_producto'] = 'La categoría seleccionada no es válida.';
                header("Location:" . base_url . 'producto/gestion');
                exit();
            }


            // Si todos los campos son válidos, guardar el producto
            $producto = new Producto();
            $producto->setNombre($nombre);
            $producto->setDescripcion($descripcion);
            $producto->setPrecio($precio);
            $producto->setStock($stock);
            $producto->setCategoria_id($categoria);
            // $producto->setImagen($imagen);


            //Guardar una imagen´
            $file = $_FILES['imagen'];
            $filename = $file['name'];
            $mimetype = $file['type'];

            if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){

                if(!is_dir('assets/img/uploads')){
                    mkdir('assets/img/uploads', 0777, true); //los numeros son permisos
                }

                move_uploaded_file($file['tmp_name'], 'assets/img/uploads/' . $filename);
                 //tmp_name == nombre temporal del archivo
                $producto->setImagen($filename);
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

        header("Location:" . base_url . 'producto/gestion');
        exit();
    }

    public function editar(){
        var_dump($_GET);
    }

    public function eliminar(){
        var_dump($_GET);
    }


}
