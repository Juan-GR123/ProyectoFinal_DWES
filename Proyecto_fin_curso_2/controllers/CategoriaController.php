<?php

namespace Controllers;

use Helpers\Utils;
use Models\Categoria;

class categoriaController
{
    public function index()
    {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();

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
}
