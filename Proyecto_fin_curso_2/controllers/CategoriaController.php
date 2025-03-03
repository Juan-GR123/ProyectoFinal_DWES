<?php

namespace Controllers;

use Helpers\Utils;
use Models\Categoria;
use Models\Producto;

class categoriaController
{
    //me muestra la lista de categorias
    public function index()
    {
        //comprueba que el usuario es administrador
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias(); //coge una lista de todas las categorias y las muestra

        require_once 'views/categoria/index.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function eliminar()
    {
        Utils::isAdmin();
        require_once 'views/categoria/eliminar.php';
    }

    public function save()
    {
        Utils::isAdmin();

        if (isset($_POST) && isset($_POST['nombre'])) {
            //Guardar la categoria en bd
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $save = $categoria->save();
        }
        header("Location:" . base_url . "categoria/index");
    }

    public function delete()
    {
        Utils::isAdmin();

        if (isset($_POST) && isset($_POST['nombre'])) {
            //Guardar la categoria en bd
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $delete = $categoria->delete();
        }

        header("Location:" . base_url . "categoria/index");
    }

    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //conseguir categoria
            $categoria = new Categoria();
            $categoria->setid($id);
            $categoria = $categoria->get_id_categorias();
            // var_dump($categoria);
        
            //conseguir productos
            $producto = new Producto();
            $producto -> setCategoria_id($id);
            $productos = $producto->getProductos_categoria();
        }
        

        require_once 'views/categoria/ver.php';
    }
}
