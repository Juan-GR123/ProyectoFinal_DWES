<?php
//La función controllers_autoload servirá para cargar las clases del proyecto
function controllers_autoload($clase)
{
    //usa str_replace para asegurarse de que las rutas sean correctas reemplaza las \ por /
    $file = str_replace("\\", "/", __DIR__ . '/' . $clase . '.php');
    if (file_exists($file)) {
        require_once $file;
    } else {
        error_log("Autoload error: No se encontró la clase '$clase' en la ruta '$file'.");
    }
}
spl_autoload_register('controllers_autoload');

