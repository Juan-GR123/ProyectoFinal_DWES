<?php

namespace Controllers;

use Helpers\Utils;
use Models\Categoria;

class categoriaController
{
    public function index()
    {
        Utils::Admin_Correc();
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();

        require_once 'views/categoria/index.php';
    }

    public function crear()
    {
        Utils::Admin_Correc();
        require_once 'views/categoria/crear.php';
    }

    public function save()
    {
        Utils::Admin_Correc();

        if (isset($_POST) && isset($_POST['nombre'])) {
            //Guardar la categoria en bd
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $save = $categoria->save();
        
        }
        header("Location:" . base_url . "categoria/index");
    }
}
