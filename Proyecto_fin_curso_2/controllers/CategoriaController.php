<?php

namespace Controllers;

require_once 'models/categoria.php';

class categoriaController
{
    public function index()
    {
       require_once 'views/categoria/index.php';
    }
}