<?php
// Modificamos config.php para que cargue las variables desde .env:
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'tienda');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');

    define("base_url", "http://localhost/ProyectoFinal_DWES_JuanGR/Proyecto_fin_curso_2/");
    define("controller_default", "productoController");
    define("action_default", "index");

?>