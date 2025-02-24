<?php

namespace Controllers;

use Models\Categoria;

class categoriaController
{
    public function index()
    {
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();

        require_once 'views/categoria/index.php';
    }

    public function crear(){
        require_once 'views/categoria/crear.php';
    }

    public function save(){
        
    }
}
