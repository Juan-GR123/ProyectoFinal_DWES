<?php
function controllers_autoload($clase)
{
    $file = str_replace("\\", "/", __DIR__ . '/' . $clase . '.php');
    if (file_exists($file)) {
        require_once $file;
    } else {
        error_log("Autoload error: No se encontró la clase '$clase' en la ruta '$file'.");
    }
}
spl_autoload_register('controllers_autoload');

